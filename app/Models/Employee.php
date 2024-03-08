<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Auth\Passwords\CanResetPassword;

class Employee extends Model implements Authenticatable , CanResetPasswordContract
{
    use HasFactory , Notifiable , AuthenticatableTrait ,CanResetPassword ;
    protected $primaryKey="mat" ;
    protected $fillable = ["mat","nom","prenom","date_naiss" ,"date_recrutement" ,"fonction","situation_fam" ,"nbr_enfants" ,"secteur","grade","echelle","statue","psw_cnx","email"] ;
    protected $casts = [
        'mat' => 'string',
    ];
    public function absense()
    {
        return $this->hasMany(Absense::class, 'mat', 'mat_emp');
    }
    public function conge()
    {
        return $this->hasMany(Conge::class, 'mat', 'mat_emp');
    }

    // methode for authorization 
    public function isAdmin()
    {
        if($this->fonction == "Directeur" || $this->fonction == "directeur complexe"){
            return TRUE ;
        }else{
            return FALSE ;
        }
    }
}
