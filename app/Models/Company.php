<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Sorethea\DocumentState\Traits\DocumentStateTrait;
use Sorethea\Todo\Traits\TodoTrait;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Company extends Model implements HasMedia
{
    use InteractsWithMedia, /*DocumentStateTrait,*/ TodoTrait;

//    protected static function booted()
//    {
//        static::addGlobalScope(new ActiveScope());
//    }

    public function scopeGroup(Builder $query){
        return $query->where("group",true);
    }

    protected $fillable =[
        "name",
        "abbr",
        "phone",
        "email",
        "location",
        "address",
        "domain",
        "website",
        "description",
        "detail",
        "default_current",
        "group",
        //"active",
    ];

    protected $appends =[
        "state",
        "is_active",
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('icon')->fit(Manipulations::FIT_CROP,100,100);
        $this->addMediaConversion('thumb')->fit(Manipulations::FIT_CROP,300,300);
    }

    public function parent():BelongsTo{
        return $this->belongsTo(self::class);
    }
}
