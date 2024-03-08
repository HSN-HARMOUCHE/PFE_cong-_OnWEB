<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\models\Conge;
use App\models\Employee;



class statueController extends Controller
{
    public function updateStatue(Request $request, $id)
    {
        $conge = Conge::find($id);

        if($request->input('statue') == "accepte"){

            $startDate = new \DateTime($conge->dateDebut);
            $endDate = new \DateTime($conge->dateFin);
            $duration = $endDate->diff($startDate)->format('%a');

            $emply=Employee::find($conge->mat_emp);

            if( $emply->solde_conge + $emply->solde_report >= $duration ){
                if($emply->solde_conge-$duration >= 0){

                    $emply->solde_conge = $emply->solde_conge - $duration ;

                }elseif( $emply->solde_report - $duration >= 0){
                    $emply->solde_report = $emply->solde_report - $duration ;
                }
                $emply->save();
                $conge->statue = $request->input('statue');
                $conge->save();
                $updatedConge = Conge::findOrFail($id);

            }else{
                return response()->json(['error' => true,'message'=>'cet employé a atteint le maximum de ses jours de congé cette année']);
            }
        }else{
            $conge->statue = $request->input('statue');
            $conge->save();
            $updatedConge = Conge::findOrFail($id);
        }

        return response()->json(['success' => true, 'conge' => $updatedConge]);
    }


    public function sendNotif(Request $request, $id)
    {
        $manger = \App\models\Employee::find(Auth::user()->mat) ;

        $conge = Conge::find($id);

        $emply = \App\Models\Employee::find($conge->mat_emp);
        
        $notificationData = [
            'statue' => $conge->statue ,
            'startDate' => $conge->dateDebut,
            'endDate' => $conge->dateFin ,
            'managerName' => $manger->nom ." ".$manger->prenom,
            'managerEmail' => $manger->email ,
        ];

        $emply->notify(new \App\Notifications\CongeNotification($notificationData));

        session(['msjNotif' => 'une notification envoyée avec succès à l\'employé']);

        return response()->json(['success' => true]);
        
    }
    
}
