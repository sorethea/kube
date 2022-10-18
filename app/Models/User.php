<?php

namespace App\Models;


use App\Models\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, InteractsWithMedia;

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

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('icon')->fit(Manipulations::FIT_CROP,100,100);
        $this->addMediaConversion('thumb')->fit(Manipulations::FIT_CROP,300,300);
    }
}
