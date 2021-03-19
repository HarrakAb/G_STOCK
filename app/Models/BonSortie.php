<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BonSortie extends Model
{
    use HasFactory;

    use SoftDeletes;

   protected $guarded = [];

    public function bons(){
        return $this->hasMany(SortieDetail::class,'bon_sorties_id' , 'id');
    }

}
