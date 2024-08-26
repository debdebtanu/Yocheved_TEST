<?php

namespace App\Modules\Report\Http\Controllers;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Exceptions\HttpErrorResponse;
use App\Modules\Student\Models\Student;
use App\Modules\Student\Services\DocService;
use App\Modules\Student\Models\StudentSession;
use App\Modules\Report\Http\Requests\CreateReportRequest;

class ReportController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('report.create', [
            'types' => StudentSession::sessionTypes(),
            'students' => Student::get(),
        ]);
    }

    /**
     * store report controller function.
     *
     * @param CreateReportRequest $request
     */
    public function store(CreateReportRequest $request)
    {
        $data = $request->validated();
        $reportData = [];
        $student = Student::find($data['student_id']);
        $sessions = StudentSession::query()
                        ->with('student')
                        ->when(
                            $data['student_id'] ?? null,
                            fn($q) => $q->whereStudentId($data['student_id'])
                        )
                        ->when(
                            $data['start_time'] ?? null,
                            fn($q) => $q->where('start_time', '>=', $data['start_time'])
                        )
                        ->when(
                            $data['end_time'] ?? null,
                            fn($q) => $q->where('end_time', '<=', $data['end_time'])
                        )
                        ->get();
        if(!is_object($sessions)){
            throw new HttpErrorResponse('No sessions found.');
        }

        foreach ($sessions as $session) {
            if ($session->type == StudentSession::TYPE_REPEATED) {
                $startTime = Carbon::parse($session->start_time);
                $endTime = Carbon::parse($data['end_time']);
                while ($startTime <= $endTime) {
                    $reportData = $this->getReportData($session, $student, $startTime, $data['split_duration'], $reportData);
                    $startTime->addDay();
                }
            } else {
                $startTime = Carbon::parse($session->start_time);
                $reportData = $this->getReportData($session, $student, $startTime, $data['split_duration'], $reportData);
            }
        }
        $zipFileName = app(DocService::class)->generateReport($reportData);
        return response()->download(public_path($zipFileName));
    }

    /**
     * Get report data.
     *
     * @param Session $session
     * @param Student $student
     * @param Carbon $startTime
     * @param int $split_duration
     * @param array $reportData
     */
    private function getReportData(StudentSession $session, Student $student, Carbon $startTime, int $split_duration, array $reportData)
    {
        $duration = $session->duration;        
        $endTime = Carbon::parse($session->end_time);
        if(is_object($student->targetData)){
            $startDate = Carbon::parse($student->targetData->first()->start_date)->format('Y-m-d');
            $endDate = Carbon::parse($student->targetData->first()->end_date)->format('Y-m-d');
        } else {
            $startDate = "";
            $endDate = "";
        }
        if ($session->duration > $split_duration) {
            do {
                $reportData[] = [
                    'student_full_name' => $student->name,
                    'session_date' => $startTime->format('Y-m-d'),
                    'session_start_time' => $startTime->format('H:i'),
                    'session_end_time' => $startTime->addMinutes($split_duration)->format('H:i'),
                    'session_minutes' => $split_duration,
                    'target_start_date' => $startDate,
                    'target_end_date' => $endDate,
                    'target' => $student->targetData->first()?->target,
                    'session_rating' => $session->rate,
                ];
                $duration -= $split_duration;
            } while ($duration > $split_duration);
        }
        $reportData[] = [
            'student_full_name' => $student->name,
            'session_date' => $startTime->format('Y-m-d'),
            'session_start_time' => $startTime->format('H:i'),
            'session_end_time' => $endTime->format('H:i'),
            'session_minutes' => (int) $duration,
            'target_start_date' => $startDate,
            'target_end_date' => $endDate,
            'target' => $student->targetData->first()?->target,
            'session_rating' => $session->rate,
        ];
        return $reportData;
    }
}
