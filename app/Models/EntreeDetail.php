<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntreeDetail extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function bonEntree(){
        return $this->belongsTo(BonEntree::class, 'bon_entrees_id' , 'id');
    }
}
