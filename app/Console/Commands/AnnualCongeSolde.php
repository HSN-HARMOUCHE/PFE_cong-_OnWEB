<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Employee;

class AnnualCongeSolde extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'annual:Conge-solde';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Processus de roulement annuel pour les jours de congé des employés ';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $employees = Employee::all();

        foreach ($employees as $employee) {

            $currentYear = date('Y');

            if ($employee->annee_report != $currentYear) {

                $OverDays = $employee->solde_conge;

                $employee->annee_report = $currentYear;

                if($employee->solde_report + $OverDays > 30){
                    $employee->solde_report= 30 ;
                }else{
                    $employee->solde_report = $employee->solde_report + $OverDays;
                }
                $employee->solde_conge = 30 ;
                $employee->save();
            }
        }
        $this->info('Annual Rollover Process Completed Successfully.');
    }
}
