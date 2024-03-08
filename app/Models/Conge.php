<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conge extends Model
{
    use HasFactory;

    protected $fillable = ['dateDebeut', 'dateFin', 'statue', 'id_type', 'mat_emp'];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'mat_emp', 'mat');
    }
    public function typeConge()
    {
        return $this->belongsTo(TypeConge::class, 'id_type', 'id_type');
    }
}
