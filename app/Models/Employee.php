<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static latest()
 */
class Employee extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nama_lengkap',
        'email',
        'nomor_telepon',
        'tanggal_lahir',
        'alamat',
        'tanggal_masuk',
        'status',
        'departemen_id',
        'jabatan_id',
    ];

    public function department(): BelongsTo {
        return $this->belongsTo(Department::class, 'departemen_id');
    }

    public function position(): BelongsTo {
        return $this->belongsTo(Position::class, 'jabatan_id');
    }

    public function salaries(): HasMany {
        return $this->hasMany(Salary::class, 'karyawan_id');
    }

    public function attendances(): HasMany {
        return $this->hasMany(Attendance::class, 'karyawan_id');
    }
}
