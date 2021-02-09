<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BonEntree extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'bon_number',
        'bon_date',
        'article',
        'categorie_id',
        'quantite',
        'prix_unitaire',
        'prix_total',
        'created_by',
        'received_by'
    ];

    public function categorie(){
        return $this->belongsTo('App\Models\Categorie');
    }
}
