<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'full_name',
        'address',
        'phone',
        'email',
    ];

    public function children()
    {
        return $this->hasOne(Fournisseur::class,'address','id');
    }

    public function parent()
    {
      return $this->belongsTo(Fournisseur::class,'id','address');
    }
}
