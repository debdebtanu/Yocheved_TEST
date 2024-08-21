<?php

namespace App\Modules\Student\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;

class Student extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'dob',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'dob' => 'date',
        ];
    }

    /**
     * TargetData model relation.
     *
     * @return HasMany
     */
    public function targetData(): HasMany
    {
        return $this->hasMany(TargetData::class);
    }

    /**
     * StudentAvailability model relation.
     *
     * @return HasOne
     */
    public function studentAvailability(): HasOne
    {
        return $this->hasOne(StudentAvailability::class);
    }
}
