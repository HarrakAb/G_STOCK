<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommandeDetail extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function bonCommande(){
        return $this->belongsTo(Commande::class, 'commandes_id' , 'id');
    }
}
