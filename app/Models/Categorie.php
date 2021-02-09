<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    protected $fillable = [
        'categorie_name',
        'created_By',
    ];

    public function invoice(){
        return $this->hasMany('App\Models\Invoice');
    }
    public function bonEntree(){
        return $this->hasMany('App\Models\BonEntree');
    }
}
