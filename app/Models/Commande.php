<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function bons(){
        return $this->hasMany(CommandeDetail::class,'commandes_id' , 'id');
    }
}
