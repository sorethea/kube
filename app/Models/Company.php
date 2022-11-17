<?php

namespace App\Models;

use App\Models\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Sorethea\DocumentState\Traits\DocumentStateTrait;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Company extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, DocumentStateTrait;

//    protected static function booted()
//    {
//        static::addGlobalScope(new ActiveScope());
//    }
    public function scopeGroup($query){
        $query->where("group",true);
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
        "active",
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
