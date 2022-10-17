<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    public $table = 'users';

    public $fillable = [
        'name',
        'email',
        'password'
    ];

    protected $casts = [
        'name' => 'string',
        'email' => 'string',
        'password' => 'string'
    ];

    public static $rules = [
        'name' => 'required',
        'email' => 'required',
        'password' => 'required'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

}
