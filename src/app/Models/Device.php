<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Device extends Model
{
    use HasFactory, SoftDeletes;

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function deviceSetting(): HasOne
    {
        return $this->hasOne(DeviceSetting::class);
    }

    public function datas(): HasMany
    {
        return $this->hasMany(Data::class);
    }
}
