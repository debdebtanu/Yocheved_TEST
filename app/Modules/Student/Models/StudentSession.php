<?php

namespace App\Modules\Student\Models;

use App\Modules\Student\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentSession extends Model
{

    const TYPE_ONE_TIME = 'one-time';
    const TYPE_REPEATED = 'repeated';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'student_id',
        'date',
        'start_time',
        'end_time',
        'type',
        'rate',
        'is_notified',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_notified' => 'boolean',
        ];
    }

    /**
     * Get session types.
     *
     * @return string[]
     */
    public static function sessionTypes(): array
    {
        return [
            self::TYPE_ONE_TIME,
            self::TYPE_REPEATED,
        ];
    }

    /**
     * Student model relation.
     *
     * @return BelongsTo
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
