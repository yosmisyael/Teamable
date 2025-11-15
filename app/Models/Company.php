<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasRelationships;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Company extends Model
{
    protected $fillable = [
        'name',
        'address',
        'phone',
        'founded_date',
        'website',
        'description',
        'field',
        'registered_by',
    ];

    protected $casts = [
        'founded_date' => 'date',
    ];

    public function registeredBy(): BelongsTo {
        return $this->belongsTo(Admin::class, 'registered_by');
    }
}
