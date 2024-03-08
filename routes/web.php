<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/dashboard', 'App\Http\Controllers\dashboard_controller@index')->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard_data', 'App\Http\Controllers\dashboard_controller@getData')->middleware(['auth', 'verified']);


Route::middleware('auth')->group(function () {
    
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        // employee
        Route::resource('emplyee', App\Http\Controllers\employee_Controller::class);
        // import Excel 
        Route::get('/importEmply', 'App\Http\Controllers\ImportController@import');
        Route::post('/upload', 'App\Http\Controllers\ImportController@upload');
        
        //Conge 
        Route::resource('conge', App\Http\Controllers\CongeController::class);
    
        //Change statue of conge 
        Route::put('conge/statue/{id}', 'App\Http\Controllers\statueController@updateStatue');
    
        // Notif Rout
        Route::get('conge/send_notification/{id}', 'App\Http\Controllers\statueController@sendNotif');
    
        // conge calculation 
        Route::get('conge_Duree/{id}', 'App\Http\Controllers\CongeController@getDurée');
        Route::get('congetaken/{id}', 'App\Http\Controllers\CongeController@congeTaken');
    
        // Absence
        Route::get('/absences','App\Http\Controllers\AbsenceController@index')->name('absences');
        Route::get('/Abs/create','App\Http\Controllers\AbsenceController@create')->name('absences.create');
        Route::post('/absences', 'App\Http\Controllers\AbsenceController@store')->name('absences.store');
        // download justification absence 
        Route::get('/employees/{employee}/download-justification', [App\Http\Controllers\EmployeeController::class, 'downloadJustification'])
            ->name('employees.downloadJustification');
    
        // graph 
        Route::POST('/graph', 'App\Http\Controllers\GraphController@Chart');
        Route::get('/g', 'App\Http\Controllers\GraphController@index');
    
    
});

require __DIR__.'/auth.php';
