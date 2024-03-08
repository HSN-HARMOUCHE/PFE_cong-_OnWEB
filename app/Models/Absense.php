<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absense extends Model
{
    use HasFactory;
    protected $primaryKey="idAbs" ;
    protected $fillable = ["raisons","dateDebeut","dateFin" ,"dureeJours" ,"Jusifications" ,"mat_emp" ] ;
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'mat_emp', 'mat');
    }  
}
