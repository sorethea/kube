<?php

namespace App\Models;


use App\Models\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    public $table = 'users';

    protected static function booted()
    {
        static::addGlobalScope(new ActiveScope());
    }

    public $fillable = [
        'name',
        'email',
        'phone',
        'device_token',
        'password'
    ];

    protected $casts = [
        'name' => 'string',
        'email' => 'string',
        'phone' => 'string',
        'device_token' => 'string',
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
