<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BonEntree extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function categorie(){
        return $this->belongsTo('App\Models\Categorie');
    }

    public function bons(){
        return $this->hasMany(EntreeDetail::class,'bon_entrees_id' , 'id');
    }
}
