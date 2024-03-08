<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeConge extends Model
{
    protected $primaryKey="id_type" ;
    protected $fillable = ['designation_type', 'nomConge', 'duree'];

    use HasFactory;
    public function conge()
    {
        return $this->hasMany(Conge::class, 'id_type', 'id');
    }
}
