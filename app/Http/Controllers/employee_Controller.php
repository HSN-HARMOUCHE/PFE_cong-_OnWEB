<?php

namespace App\Http\Controllers;


use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\models\Employee;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;


class employee_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Gate::allows('Admin-user')){
            $emplys = Employee::all(); 
            return  view('emplyee.emplyee' ,['emplys'=>$emplys]) ;
        }
        // else{
        //     $id=Auth::user()->mat;
        //     $emply = Employee::find($id); 
        //     return  view('emplyee.emplyee',['emply'=>$emply]) ;
        // } 

    
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('emplyee.add_emplyee');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'mat' => ['required','unique:employees,mat'],
            'email'=>['required','unique:employees,email'],
            'prenom' => 'required|string',
            'nom' => 'required|string',
            'date_naiss' => ['date' , Rule::requiredIf($request->statue != "vacataire")],
            'date_recru' => ['date' , Rule::requiredIf($request->statue != "vacataire")],
            'situation_fam' => ['string' , Rule::requiredIf($request->statue != "vacataire"),Rule::in(['Célibataire', 'marie'])],
            'nbr_enf' => ['numeric' , Rule::requiredIf($request->statue != "vacataire")],
            'fonction' =>['required',Rule::in(['Directeur', 'formateur','directeur complexe','magasinier'])],
            'secteur' => ['required', Rule::in(['Administration', 'AGC','BTP','NTIC']) ],
            'grade' => ['string' , Rule::requiredIf($request->statue != "vacataire")],
            'echelle' =>['string' , Rule::requiredIf($request->statue != "vacataire")],
            'statue' => ['required', Rule::in(['statutaire', 'vacataire','contractuel','coopérant'])],
            'psw' => 'required|min:8',
        ]);

        
        
        // Save
        if(Gate::allows('Admin-user')){
        //   if user admin create new Employee
        $employee = new Employee;
        
        $employee->mat = $validatedData['mat'];
        $employee->email = $validatedData['email'];
        $employee->nom = $validatedData['nom'];
        $employee->prenom = $validatedData['prenom'];
        $employee->date_naiss = $validatedData['date_naiss'];
        $employee->date_recrutement = $validatedData['date_recru'];
        $employee->fonction = $validatedData['fonction'];
        $employee->situation_fam = $validatedData['situation_fam'];
        $employee->nbr_enfants = $validatedData['nbr_enf'];
        $employee->secteur = $validatedData['secteur'];
        $employee->grade = $validatedData['grade'];
        $employee->echelle = $validatedData['echelle'];
        $employee->statue = $validatedData['statue'];
        $employee->psw_cnx = Hash::make($validatedData['psw']);

            if ($employee->save()) {
                return back()->with('msj', '!!!! message: Employee data saved successfully.');
            } else {
                return back()->with('err', '!!!! message: Failed to save employee data.');
            }
        }else return abort(403); 
    }

    /**
     * Display the specified resource.
     *  @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        if(Gate::allows('Info_user',$id)){
            $emplyee_data = Employee::find($id);
            if ($emplyee_data) {
                return view('emplyee.show_emplyee', compact('emplyee_data'));
            }else {  
                return response()->json(['error' => 'Employee n\'exsite pas'], 404); 
                }
        }else{
            return abort(403 ,"you don't have the authorization to this action !!") ;
        }



      
    }

    /**
     * Show the form for editing the specified resource.
     *@param  int  $id
     *@return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $emplyee_data = Employee::find($id);
        if (!$emplyee_data) {
            return response()->json(['error' => 'Employee not found'], 404);
        }
        return view('emplyee.edit_emplyee', compact('emplyee_data'));
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $id)
    {
// if the user is an admin need to validate all data but if not , need to validated only data he can change
        if(Gate::allows('Admin-user')){

            $employee = Employee::find($id);

            $validatedData = $request->validate([
                'mat' => ['required',Rule::unique('employees','mat')->ignore($employee->mat, 'mat'),],
                'prenom' => 'required|string',
                'nom' => 'required|string',
                'date_naiss' => ['date' , Rule::requiredIf($request->statue != "vacataire")],
                'date_recru' => ['date' , Rule::requiredIf($request->statue != "vacataire")],
                'situation_fam' => ['string' , Rule::requiredIf($request->statue != "vacataire"),Rule::in(['Célibataire', 'marie'])],
                'nbr_enf' => ['numeric' , Rule::requiredIf($request->statue != "vacataire")],
                'fonction' =>['required',Rule::in(['Directeur', 'formateur','directeur complexe','magasinier'])],
                'secteur' => ['required', Rule::in(['Administration', 'AGC','BTP','NTIC']) ],
                'grade' => ['string' , Rule::requiredIf($request->statue != "vacataire")],
                'echelle' =>['string' , Rule::requiredIf($request->statue != "vacataire")],
                'statue' => ['required', Rule::in(['statutaire', 'vacataire','contractuel','coopérant'])],
                'email'=>[
                    'required',
                    Rule::unique('employees','email')->ignore($employee->mat, 'mat'),
                ],

            ]);
        $employee->mat = $validatedData['mat'];
        $employee->email = $validatedData['email'];
        $employee->nom = $validatedData['nom'];
        $employee->prenom = $validatedData['prenom'];
        $employee->date_naiss = $validatedData['date_naiss'];
        $employee->date_recrutement = $validatedData['date_recru'];
        $employee->fonction = $validatedData['fonction'];
        $employee->situation_fam = $validatedData['situation_fam'];
        $employee->nbr_enfants = $validatedData['nbr_enf'];
        $employee->secteur = $validatedData['secteur'];
        $employee->grade = $validatedData['grade'];
        $employee->echelle = $validatedData['echelle'];
        $employee->statue = $validatedData['statue'];


        }elseif(Gate::allows('Info_user',$id)){
            $validatedData = $request->validate([
            'prenom' => 'required|string',
            'nom' => 'required|string',
            'date_naiss' => 'nullable|date',
            'situation_fam' => 'nullable|string',
            'nbr_enf' => 'nullable|numeric',
            'password' => 'required|min:8',
            'email'=>[
                'required',
                Rule::unique('employees','email')->ignore(Auth::user()->mat, 'mat'),
            ],
        ]);

        $employee = Employee::find($id);
        $employee->nom = $validatedData['nom'];
        $employee->prenom = $validatedData['prenom'];
        $employee->date_naiss = $validatedData['date_naiss'];
        $employee->situation_fam = $validatedData['situation_fam'];
        $employee->nbr_enfants = $validatedData['nbr_enf'];
        $employee->psw_cnx =Hash::make($validatedData['password']);
        $employee->email =$validatedData['email'];

        }else{
            abort(403) ;
        }


        if($employee->save()){
            return back()->with('msj', 'Enregistrement de lemployé mis à jour avec succès..');
        }else{
            return back()->with('msj', 'ERROR !! ');
        };
       
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
    if (Gate::allows('Admin-user')) {
        $Employee = Employee::find($id);
        
        if ($Employee) {
            if($id == Auth::user()->mat ){
                $Employee->delete();
            }else{
                $Employee->delete();
                return redirect()->back() ;
            }
        } else {
            return redirect()->back()->with('msj', 'Employee not found.');
        }
    }else{
        return abort(403,"you don't have the authorization to this action !!") ;
    }

    }
}
