<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntreeDetail extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function bonEntree(){
        return $this->belongsTo(BonSortie::class, 'bon_sorties_id' , 'id');
    }
}
