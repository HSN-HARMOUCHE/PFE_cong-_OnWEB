<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\models\Conge;
use App\models\TypeConge;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;


class CongeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Gate::allows('Admin-user')){
            $conges = Conge::with(['employee', 'typeConge'])
            ->select('id', 'mat_emp', 'id_type', 'dateDebut', 'dateFin','statue')
            ->orderByRaw("CASE WHEN statue = 'en attendant' THEN 0 ELSE 1 END") // Sort 'en attendant' first
            ->orderBy('statue', 'desc')
            ->get();
        return view('conge.conge',['conges'=>$conges]);

        }else{
            $id=Auth::user()->mat;
            $conges_emply = Conge::with(['employee', 'typeConge'])
            ->select('id', 'mat_emp', 'id_type', 'dateDebut', 'dateFin','statue')
            ->where('mat_emp', $id) 
            ->get();
        return view('conge.conge',['conges_emply'=>$conges_emply]);
        } 

    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types= TypeConge::all();
        return view('conge.add_conge',['types'=>$types]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $typeId = $request->input('conge-type');
        $duree = TypeConge::find($typeId)->duree;

        $startDate = Carbon::parse($request->input('start-date')); 
        
        if($request->input('end-date') ){

            $endDate = $request->input('end-date');

        }else{
            $endDate = date('Y-m-d', strtotime($startDate . ' + ' . $duree . ' days'));
        };

        $CongesA = Conge::where('mat_emp', Auth::user()->mat)
        ->whereBetween('statue', ['accepte', 'en attendant'])
        ->get();
    
    $alreadyHaveCong = false ;

    foreach($CongesA as $x){
        
        $congeStartDate = Carbon::parse($x->dateDebut);
        $congeEndDate = Carbon::parse($x->dateFin);

        if ($congeStartDate->year !== $congeEndDate->year) {
            return redirect()->back()->with('ERR', 'Les dates de congé doivent être dans la même année.');
        }

        if($startDate->between($congeStartDate, $congeEndDate, true)){
            $alreadyHaveCong = true ;
            break ;
        }

    }
    if($alreadyHaveCong){
        return redirect()->back()->with('ERR', 'Vous avez déjà un congé à la date que vous avez sélectionnée.');
    }else{
        
        $conge = new Conge;
        
        $conge->dateDebut =$startDate;
        $conge->dateFin = $endDate ;
        $conge->mat_emp = Auth::user()->mat;
        $conge->id_type = $typeId;
        $conge->save() ;
        return back() ; 
    }


        
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        //
    }
    public function getDurée($id)
    {

        $congeType = TypeConge::find($id);

        $Durée = $congeType->duree;

        return response()->json(['Durée' => $Durée]);
    }


    public function congeTaken($id)
    {
        $currentYear = Carbon::now()->year;

        $conges = Conge::where('mat_emp', $id)
            ->where('statue', 'accepte')
            ->whereYear('dateDebut', $currentYear)
            ->get();
        $congetaken = 0 ;

        foreach ($conges as $conge) {
            $startDate = new \DateTime($conge->dateDebut);
            $endDate = new \DateTime($conge->dateFin);
            $duration = $endDate->diff($startDate)->format('%a');
            $congetaken = $congetaken + $duration;
        };

        return response()->json(['congetaken' => $congetaken]);
    }
}
