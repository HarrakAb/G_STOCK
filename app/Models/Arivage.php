<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arivage extends Model
{
    use HasFactory;

    protected $fillable = [
        'article',
        'quantite',
        'prix_unitaire',
    ];


    public function entree(){
        return $this->belongsTo(BonEntree::class, 'bon_entrees_id' , 'id');
    }


}
