<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Employee;
use App\models\Conge;
use App\models\Absense;
use Carbon\Carbon;



class GraphController extends Controller
{
    public function Chart(Request $request)
    {
        $typeData = $request->input('typedata');
        $typeGraph = $request->input('typegraph');
        $year = $request->input('year');
        $Id_empl = $request->input('emply');

    $frmt = Employee::select('mat','nom','prenom')->where('fonction','formateur')->get();
    $chartData = [];

        if($typeGraph == "G1"){
            if($typeData== "C"){
                foreach($frmt as $f){
                    $conges = Conge::where('mat_emp', $f->mat)
                    ->whereYear('dateDebut', $year)
                    ->whereYear('dateFin', $year)
                    ->where('statue','accepte')
                    ->get();
                    $daysoff = 0 ;
                    foreach ($conges as $conge) {
                        // count days of conge
                        $startDate = new \DateTime($conge->dateDebut);
                        $endDate = new \DateTime($conge->dateFin);
                        $duration = $endDate->diff($startDate)->format('%a');
                        $daysoff = $daysoff + $duration;
                    };
                    $chartData[] = [
                        'formateur' => $f->nom .'-'. $f->prenom,
                        'Abs_Cong_days' => $daysoff,
                    ];
                }
                return view('graphs.graph_type1', compact('chartData'))
                ->with('typeData', 'de Congé')->with('year',$year);;

            }elseif($typeData== "A"){
                foreach($frmt as $f){
                    $absence = Absense::where('mat_emp', $f->mat)
                    ->whereYear('dateDebeut', $year)
                    ->whereYear('dateFin', $year)
                    ->get();
                    $daysAbs = 0 ;
                    foreach($absence as $a){
                        // count days of Abs
                        $daysAbs = $daysAbs+ $a->dureeJours ;
                    }
                    $chartData[] = [
                        'formateur' => $f->nom .'-'. $f->prenom,
                        'Abs_Cong_days' => $daysAbs,
                    ];
                }
                return view('graphs.graph_type1', compact('chartData'))
                ->with('typeData', 'd’Absence')->with('year',$year);;
            }
        }elseif($typeGraph == "G2"){
            if($typeData== "C"){
                foreach($frmt as $f){
                    $conges = Conge::where('mat_emp', $f->mat)
                    ->whereYear('dateDebut', $year)
                    ->whereYear('dateFin', $year)
                    ->where('statue','accepte')
                    ->count();

                    $chartData[] = [
                        'formateur' => $f->nom .'-'. $f->prenom,
                        'Nbr_Abs_Cong_days' => $conges,
                    ];
                } 
                return view('graphs.graph_type2', compact('chartData'))
                ->with('typeData', 'de Congé')->with('year',$year);;

            }elseif($typeData== "A"){ 
                foreach($frmt as $f){
                    $absence = Absense::where('mat_emp', $f->mat)
                    ->whereYear('dateDebeut', $year)
                    ->whereYear('dateFin', $year)
                    ->count();

                    $chartData[] = [
                        'formateur' => $f->nom .'-'. $f->prenom,
                        'Nbr_Abs_Cong_days' => $absence,
                    ];
                } 
                return view('graphs.graph_type2', compact('chartData'))
                ->with('typeData', 'd’Absence')->with('year',$year);

            }
        }elseif($typeGraph == "G3" && !empty($Id_empl)){
           
            $emply = Employee::find($Id_empl, ['mat', 'nom', 'prenom']);

            if($typeData== "C"){
                $monthlyData = [];
                for ($month = 1; $month <= 12; $month++) {
                    // count cong in a month : 
                    $conges = Conge::where('mat_emp', $emply->mat)
                    ->where('statue','accepte')
                    ->whereYear('dateDebut', $year)
                    ->where(function ($query) use ($month) {
                        $query->whereMonth('dateDebut', $month)
                                ->orWhereMonth('dateFin', $month);
                    })->get();
                        $daysOffInMonth = 0 ;
                    foreach ($conges as $conge) {
                        // count days of conge
                        $startDate = new \DateTime($conge->dateDebut);
                        $endDate = new \DateTime($conge->dateFin);
                        $duration = $endDate->diff($startDate)->format('%a');
                        $daysOffInMonth = $daysOffInMonth + $duration;
                    };
                    

                    $monthlyData[] = $daysOffInMonth;
                }
                return view('graphs.graph_type3', compact('monthlyData'))
                ->with('typeData', ' de Congé')
                ->with('year',$year)
                ->with('emply',$emply);

            }elseif($typeData== "A"){
                $monthlyData = [];
                for ($month = 1; $month <= 12; $month++) {
                    // count abs in a month : 
                    $absence = Absense::where('mat_emp', $emply->mat)
                    ->whereYear('dateDebeut', $year)
                    ->where(function ($query) use ($month) {
                        $query->whereMonth('dateDebeut', $month)
                                ->orWhereMonth('dateFin', $month);
                    })->get();

                    $daysAbs = 0 ;
                    foreach($absence as $a){
                        // count days of Abs
                        $daysAbs = $daysAbs+ $a->dureeJours ;
                    }
                    $monthlyData[] = $daysAbs;
                }
                return view('graphs.graph_type3', compact('monthlyData'))
                ->with('typeData', ' d’Absence')
                ->with('year',$year)
                ->with('emply',$emply);
            }
        }else{
            abort(404) ;
        }
    
   
    }

    public function index()
    {
        $emplys = Employee::select('mat','nom','prenom')->get();
        return  view('graphs.graph_layout' ,['emplydata'=>$emplys]) ;
    }
    
}
