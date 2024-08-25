<?php

namespace App\Providers;

use App\Modules\Student\Models\Student;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Modules\Student\Models\StudentSession;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Validator::extend('session_date_availability_check', function ($attribute, $value, $parameters, $validator) {
            $inputs = $validator->getData();
            $result = true;
            $student = Student::with(['availability'])->find($inputs['student_id']);
            $availability = $student->availability->toArray();
            if(!$availability[$inputs['day']]){
                return false;
            }
            return $result;
        }, 'Student is not available on that day.');

        Validator::extend('session_date_check', function ($attribute, $value, $parameters, $validator) {
            $inputs = $validator->getData();
            $startTime = $inputs['start_time'];
            $endTime = $inputs['end_time'];
            $result = true;
            $student = Student::with(['availability'])->find($inputs['student_id']);
            // dd($inputs);
            $sessionExist = StudentSession::where('student_id', $inputs['student_id'])
                                            ->where('type', 'one-time')
                                            ->where('date', $inputs['date'])
                                            ->where(function ($query) use($startTime, $endTime) {
                                                $query->whereBetween('start_time', [$startTime, $endTime])
                                                ->orWhereBetween('end_time', [$startTime, $endTime]);
                                            })
                                            ->first();
            if (is_object($sessionExist)) {
                $result = false;
            } else {
                $sessionExist = StudentSession::where('student_id', $inputs['student_id'])
                                                ->where('type', 'repeated')
                                                ->where(function ($query) use($startTime, $endTime) {
                                                    $query->whereBetween('start_time', [$startTime, $endTime])
                                                    ->orWhereBetween('end_time', [$startTime, $endTime]);
                                                })
                                                ->first();
                if (is_object($sessionExist)) {
                    $result = false;
                }
            }
            return $result;
        }, 'Session overlaps with existing session');
    }
}
