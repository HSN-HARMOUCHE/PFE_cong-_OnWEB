<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use App\models\Employee;
use App\models\Conge;
use App\Models\Absense;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

// to use congeTaken methode from  CongeController
use App\Http\Controllers\CongeController;

class dashboard_controller extends Controller
{
    public function index()
    {
        return view("dashboard") ;
    }
    public function getData(CongeController $CongeC){
        $today = Carbon::now();
        
        // 1 count many conges today
        $employeesConge = Conge::select('dateDebut', 'dateFin','statue')
            ->where('statue', 'accepte') 
            ->whereDate('dateDebut', '<=', $today)
            ->whereDate('dateFin', '>=', $today)
            ->count();

        // 2 count many Abs today
        $employeesAbs = Absense::select('dateDebeut', 'dateFin','statue') 
            ->whereDate('dateDebeut', '<=', $today)
            ->whereDate('dateFin', '>=', $today)
            ->count();

        // 3 count Formateur not in conge 
        $FEmplys=Employee::select('mat','fonction')
        ->where('fonction','formateur')->get() ;

        $allForm_per100 = $FEmplys->count();

        $countF_emp = 0 ;

        foreach($FEmplys as $emp){
            $hasCong = Conge::select('mat_emp','dateDebut', 'dateFin','statue')->where('mat_emp',$emp->mat)->where('statue', 'accepte')->whereDate('dateDebut', '<=', $today)->whereDate('dateFin', '>=', $today)
            ->count();

            $hasAbs = Absense::select('mat_emp','dateDebeut', 'dateFin','statue')
            ->where('mat_emp',$emp->mat) ->whereDate('dateDebeut', '<=', $today)->whereDate('dateFin', '>=', $today)
            ->count();
        if(!($hasCong) && !($hasAbs)){
            $countF_emp =  $countF_emp +1 ;
        }
        }

        // $countForm_per100 = ($countF_emp*100)/$allForm_per100 ;
        $countForm_per100 = number_format(($countF_emp*100)/$allForm_per100, 2);

        // 4 count Emplys not in conge 

        $Emplys=Employee::select('mat','fonction')->get() ;

        $allEmplys_per100 = $Emplys->count();

        $count_emp = 0 ;

        foreach($Emplys as $emp){
            $hasCong = Conge::select('mat_emp','dateDebut', 'dateFin','statue')->where('mat_emp',$emp->mat)->where('statue', 'accepte')->whereDate('dateDebut', '<=', $today)->whereDate('dateFin', '>=', $today)
            ->count();

            $hasAbs = Absense::select('mat_emp','dateDebeut', 'dateFin','statue')
            ->where('mat_emp',$emp->mat) ->whereDate('dateDebeut', '<=', $today)->whereDate('dateFin', '>=', $today)
            ->count();
        if(!($hasCong) && !($hasAbs)){
            $count_emp =  $count_emp +1 ;
        }
        }

        $countEmply_per100 = number_format(($count_emp*100)/$allEmplys_per100 ,2 );

        // 5 conge+Abs 
        $currentYear = Carbon::now()->year;

        $congehave = $CongeC->congeTaken(Auth::user()->mat);

        $countConge = $congehave->getData()->congetaken;

        $countAbs = Absense::where('mat_emp', Auth::user()->mat)
        ->whereYear('dateDebeut', $currentYear)
        ->sum('dureeJours');
    
        $Abs_Cong = $countAbs+$countConge ;


        return response()->json(['employeesConge' => $employeesConge ,
                                    'employeesAbs'=>$employeesAbs ,
                                    'countF_emp'=>$countF_emp,
                                    'countForm_per100'=>$countForm_per100,
                                    'count_emp'=>$count_emp,
                                    'countEmply_per100'=>$countEmply_per100,
                                    'Abs_Cong'=>$Abs_Cong
                                ]);
        


    }
}
