<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'address',
        'checked',
        'interest',
        'description',
        'date_of_birth',
        'email',
        'account',
        'job_id',
        'keys'
    ];

    public function CreditCard()
    {
        return $this->hasMany('App\Models\CreditCard','user_id','id');
    }

}
