<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'type',
        'number',
        'name',
        'expirationDate'
    ];
    public function User()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}
