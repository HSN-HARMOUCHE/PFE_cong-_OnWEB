<?php
namespace App\Imports;
use App\Models\Employee;
use DateTime;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Illuminate\Validation\Rule;  
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

use Throwable;


class EmplyImport implements ToCollection,
                                WithHeadingRow, 
                                SkipsOnError, 
                                withValidation,
                                SkipsOnFailure,
                                SkipsEmptyRows
                        
{
    use \Maatwebsite\Excel\Concerns\SkipsErrors , SkipsFailures;

    /**
    * @param Collection $rows
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            Employee::create([
                'mat' => $row['mat'],
                'nom' => $row['nom'],
                'prenom' => $row['prenom'],
                'date_naiss' => $this->convertExcelDate($row['date_naiss']),
                'date_recrutement' => $this->convertExcelDate($row['date_recrutement']),
                'fonction' => $row['fonction'],
                'situation_fam' => $row['situation_fam'],
                'nbr_enfants' => $row['nbr_enfants'],
                'secteur' => $row['secteur'],
                'grade' => $row['grade'],
                'echelle' => $row['echelle'],
                'statue' => $row['statue'],
                'psw_cnx' => $row['psw_cnx'],
                'email' => $row['email'],
            ]);


        }
    }

    public function convertExcelDate($date)
{
    // Check if $date is in Excel date format
    if (is_numeric($date)) {
        try {
            // Adjust the format based on your Excel date format
            $formattedDate = Date::excelToDateTimeObject($date)->format('Y-m-d');
            return $formattedDate;
        } catch (\Exception $e) {
            return null;
        }
    }
    return $date;
}

    /** validation
     * @return array
     */
    public function rules(): array
    {
        return [
            'mat' => ['required','unique:employees,mat'],
            'nom' => 'required|max:50',
            'prenom' => 'required|max:50',
            'fonction' => ['required', Rule::in(['Directeur', 'formateur','directeur complexe','magasinier'])],
            'situation_fam' => [Rule::in(['Célibataire', 'marie'])],
            'nbr_enfants' => ['integer', 'min:0', 'max:50'],
            'secteur' => ['required', Rule::in(['Administration', 'AGC','BTP','NTIC'])],
            'statue' => ['required', Rule::in(['statutaire', 'vacataire','contractuel','coopérant'])],
            'psw_cnx' => 'required|max:50',
            'email' => ['required','email','unique:employees,email'],
        ];
            // Add conditional rules based on 'statue'
            if ($this->input('statue') !== 'vacataire') {
                $rules['grade'] = 'required';
                $rules['echelle'] = 'required';
                $rules['date_recrutement'] = 'required';
                $rules['date_naiss'] = 'required';
                $rules['nbr_enfants'][] = 'required';
                $rules['situation_fam'][] = 'required';
    }
    
    }
    public function customValidationMessages(): array
        {
            return [
                'mat.required' => 'Le champ "mat" est obligatoire.',
                'mat.unique' => 'La valeur du champ "matricule/CINE" est déjà prise.',
                'nom.required' => 'Le champ "nom" est obligatoire.',
                'nom.max' => 'Le champ "nom" ne doit pas dépasser 50 caractères.',
                'prenom.required' => 'Le champ "prenom" est obligatoire.',
                'prenom.max' => 'Le champ "prenom" ne doit pas dépasser 50 caractères.',
                'date_naiss.required' => 'Le champ "date_naiss" est obligatoire.',
                'date_naiss.date' => 'Le champ "date_naiss" doit être une date valide.',
                'date_recrutement.required' => 'Le champ "date_recrutement" est obligatoire.',
                'date_recrutement.date' => 'Le champ "date_recrutement" doit être une date valide.',
                'fonction.required' => 'Le champ "fonction" est obligatoire.',
                'fonction.in' => 'la valeur sélectionnée de "fonction" ne correspond pas à une de ces valeurs :(Directeur,formateur,directeur complexe,magasinier)',
                'situation_fam.in' => 'la valeur sélectionnée de "situation_fam" ne correspond pas à une de ces valeurs :(Célibataire,marie)',
                'nbr_enfants.integer' => 'Le champ "nbr_enfants" doit être un entier.',
                'nbr_enfants.min' => 'Le champ "nbr_enfants" doit être au moins 0.',
                'nbr_enfants.max' => 'Le champ "nbr_enfants" ne doit pas dépasser 50.',
                'secteur.required' => 'Le champ "secteur" est obligatoire.',
                'secteur.in' => 'la valeur sélectionnée de "secteur" ne correspond pas à une de ces valeurs :(Administration,AGC,BTP,NTIC)',
                'grade.required_if' => 'Le champ "grade" est obligatoire lorsque "statue" n\'est pas "vacataire".',
                'echelle.required_if' => 'Le champ "echelle" est obligatoire lorsque "statue" n\'est pas "vacataire".',
                'statue.required' => 'Le champ "statue" est obligatoire.',
                'statue.in' => ' la valeur sélectionnée de "statue" ne correspond pas à une de ces valeurs :(statutaire,vacataire,contractuel,coopérant).',
                'psw_cnx.required' => 'Le champ "psw_cnx" est obligatoire.',
                'psw_cnx.max' => 'Le champ "psw_cnx" ne doit pas dépasser 50 caractères.',
                'email.required' => 'Le champ "email" est obligatoire.',
                'email.email' => 'L\'adresse "email" doit être une adresse email valide.',
                'email.unique' => 'La valeur du champ "email" est déjà prise.',
            ];
        }

    public function onFailure(Failure ...$failures)
    {
        if(session::has('import_errors')){
            session()->forget('import_errors');
            session()->forget('errors');
        }
    
        foreach ($failures as $failure) {

            $row = $failure->row();
            $errors = $failure->errors();
            $val =$failure->values()[$failure->attribute()];
    
            $importErrors[] = [
                'row' => $row,
                'errors' => $errors,
                'val'=>$val
            ];
        }
        session(['import_errors' => $importErrors]);
    }




}

