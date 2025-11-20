<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Salary extends Model
{
    protected $fillable = [
        'employee_id',
        'base_salary',
        'allowance',
        'cut',
        'bank_account',
        'bank_id',
    ];

    public function employee(): BelongsTo {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function bank(): BelongsTo {
        return $this->belongsTo(Bank::class, 'bank_id', 'id');
    }

    public function getNetSalaryAttribute()
    {
        return ($this->base_salary + $this->allowance) - $this->cut;
    }
}
