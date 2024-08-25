<?php

namespace App\Modules\Student\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Modules\Student\Models\StudentTargetData;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'name',
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
     * Get the student's full_name attribute.
     */
    protected function getNameAttribute()
    {
        if($this->middle_name != null && $this->middle_name != ''){
            return "{$this->first_name} {$this->middle_name} {$this->last_name}";
        } else {
            return "{$this->first_name} {$this->last_name}";
        }
    }

    /**
     * TargetData model relation.
     *
     * @return HasMany
     */
    public function targetData(): HasMany
    {
        return $this->hasMany(StudentTargetData::class);
    }

    /**
     * StudentAvailability model relation.
     *
     * @return HasOne
     */
    public function availability(): HasOne
    {
        return $this->hasOne(StudentAvailability::class);
    }
}
