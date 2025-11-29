<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Company extends Model
{
    protected $fillable = [
        'name',
        'address',
        'city',
        'state',
        'country',
        'postal_code',
        'phone',
        'founded_date',
        'website',
        'description',
        'field',
        'registered_by',
        'slug'
    ];

    protected $casts = [
        'founded_date' => 'date',
    ];

    public function registeredBy(): BelongsTo {
        return $this->belongsTo(Admin::class, 'registered_by');
    }

    public function banks(): HasMany
    {
        return $this->hasMany(Bank::class, 'company_id');
    }

    public static function booted()
    {
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->name, '-');
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('name') && empty($model->slug)) {
                $model->slug = Str::slug($model->name, '-');
            }
        });
    }
}
