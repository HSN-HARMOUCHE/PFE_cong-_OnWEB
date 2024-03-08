<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\EmplyImport;


class ImportController extends Controller
{
    public function import(){
        return view('emplyee.import');
    }
    public function upload(Request $request){
        try {

            $file = $request->file('excel_f');
            Excel::import(new EmplyImport, $file);

            $importErrors = session('import_errors',[]);

            if (!empty($importErrors)) {
                return redirect('/emplyee')->with('importErrors', $importErrors);
            }else{
                return redirect('/emplyee')->with('msj', "Toutes les données importées avec succès ");
            }

        } catch (\Exception $e) {

            // Handle the exception, you might want to log it or show a specific message
            return redirect('/emplyee')->with('error', 'Une erreur s\'est produite lors de l\'importation: '.$e->getMessage());
        }

    }
}
