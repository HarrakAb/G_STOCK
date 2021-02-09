<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'descritption',
        'categorie_id',
        'stock',
    ];

    public function categorie(){
        return $this->belongsTo('App\Models\Categorie');
    }
}
