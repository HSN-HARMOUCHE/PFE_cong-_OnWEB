<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Employee;
use App\Models\Absense;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class AbsenceController extends Controller
{
    public function index()
     {
        if (Gate::allows('Admin-user')) {
            $absences = Absense::with('employee')
                ->select('idAbs', 'mat_emp', 'raisons', 'dateDebeut', 'dateFin', 'dureeJours', 'Jusifications')
                ->orderBy('dateDebeut', 'asc') // Change 'asc' to 'desc' for descending order
                ->get();

        } else {
            $id = Auth::user()->mat;
            $absences = Absense::with('employee')
                ->where('mat_emp',$id)
                ->select('idAbs', 'mat_emp', 'raisons', 'dateDebeut', 'dateFin', 'dureeJours', 'Jusifications')
                ->orderBy('dateDebeut', 'asc') // Change 'asc' to 'desc' for descending order
                ->get();
           
        }
        return view('absence.absence', ['absences' => $absences]);
    }



    public function store(Request $request)
    {
        $request->validate([
            'raisons' => 'required',
            'dateDebeut' => ['required', 'date', 'after_or_equal:today'],
            'dateFin' => 'required|date|after_or_equal:dateDebeut',
            'justification' => 'mimes:pdf|max:3048', 
        ]);
        
        $datedebut = Carbon::parse($request->dateDebeut);
        $datefin = Carbon::parse($request->dateFin);
        $dureeJours = $datedebut->diffInDays($datefin);
        
        $Oldabsences= Absense::where('mat_emp', Auth::user()->mat)->get();

        $alreadyHaveAbs = false ;

        foreach($Oldabsences as $x){

            $AbsStartDate = Carbon::parse($x->dateDebeut);
            $AbsEndDate = Carbon::parse($x->dateFin);

            if($datedebut->between($AbsStartDate, $AbsEndDate, true)){
                $alreadyHaveAbs = true ;
                break ;
            }
        }
if($alreadyHaveAbs){
    return redirect()->back()->with('ERR', 'Vous avez déjà un absence à la date que vous avez sélectionnée.');
}else{

        $absence = new Absense([
            'raisons' => $request->raisons,
            'dateDebeut' => $request->dateDebeut,
            'dateFin' => $request->dateFin,
            'dureeJours' => $dureeJours,
            'mat_emp' => Auth::user()->mat,
        ]);
   
    
        // Move the uploaded file to the desired location
if($request->file('justification')){
        $directory = 'justifications';
    
        $file = $request->file('justification');
        $extension = 'pdf'; // Assuming the files are in PDF format
        
        $filename = Str::random(40) . '.' . $extension;
        $filePath = public_path($directory . '/' . $filename);
        
        // Move the uploaded file to the desired location
        $file->move(public_path($directory), $filename);
        
        $absence->Jusifications = 'public/' . $directory . '/' . $filename;
        
        $absence->save();
    }else{
        $absence->Jusifications = null ;
        $absence->save();
    }

// send notif for all managers

$emply = \App\Models\Employee::find(Auth::user()->mat);

$managers = \App\Models\Employee::where('fonction','Directeur')->orWhere('fonction','directeur complexe')->get();

$absNotificationData = [
    'mat' => $absence->mat_emp ,
    'emply' => Auth::user()->nom." ".Auth::user()->prenom,
    'startDate' => $absence->dateDebeut,
    'endDate' => $absence->dateFin ,
    'raisons' => $absence->raisons ,
    'durée' => $absence->dureeJours ,
    'empEmail' => $emply->email ,
];

foreach($managers as $m){
    $m->notify(new \App\Notifications\AbsNotification($absNotificationData));
}
        return redirect()->route('absences');
    }

    }

 
    public function create()
    {
        return view('absence.add_Abs');
    }


  
}
