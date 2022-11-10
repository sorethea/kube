<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Assignable extends Model
{
    use HasFactory;

    public function assignable():MorphTo {
        return $this->morphTo("assignable");
    }
    public function causer():MorphTo {
        return $this->morphTo("causer");
    }
}
