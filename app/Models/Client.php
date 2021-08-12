<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'address',
        'phone',
        'email',
        'code_client',
    ];

    public function children()
    {
        return $this->hasOne(Client::class,'address','id');
    }

    public function parent()
    {
      return $this->belongsTo(Client::class,'id','address');
    }

    public function credit(){
        return $this->hasOne(Credit::class,'credit_id' , 'id');
    }
}
