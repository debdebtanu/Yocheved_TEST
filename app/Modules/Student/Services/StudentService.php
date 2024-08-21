<?php

namespace App\Modules\Student\Services;

use Carbon\Carbon;
use App\Modules\Student\Models\Student;

readonly class StudentService
{
    /**
     * Get students list service function.
     *
     */
    public function listStudents()
    {
        return Student::paginate();
    }

    /**
     * Store student service function.
     *
     * @param array $data
     * @return Student
     */
    // public function storeStudent(array $data): Student
    // {
    //     return $this->studentRepository->storeStudent($data);
    // }

    /**
     * Import student's target data service function.
     *
     * @param Student $student
     * @param array $data
     * @return void
     */
    // public function importTargetData(Student $student, array $data): void
    // {
    //     $targetData = app(DocService::class)->extractDataFromDocxFile($data['file']->getPathName());
    //     foreach ($targetData as $importData) {
    //         $this->targetDataRepository->storeTargetData($student, $importData);
    //     }
    // }

    /**
     * Generate student's report service function.
     *
     * @param Student $student
     * @param array $data
     * @return string
     * @throws HttpErrorResponse
     */
    // public function generateReport(Student $student, array $data): string
    // {
    //     $reportData = [];
    //     $data['student_id'] = $student->id;
    //     $sessions = $this->sessionRepository->listSessions($data, false);
    //     if ($sessions->isEmpty()) {
    //         throw new HttpErrorResponse(__('validation.no_sessions'));
    //     }

    //     /** @var Session $session */
    //     foreach ($sessions as $session) {
    //         if ($session->type == Session::TYPE_REPEATED) {
    //             $startTime = $session->start_time;
    //             $endTime = Carbon::parse($data['end_time']);
    //             while ($startTime <= $endTime) {
    //                 $this->getReportData($session, $student, $startTime, $data['split'], $reportData);
    //                 $startTime->addDay();
    //             }
    //         } else {
    //             $this->getReportData($session, $student, $session->start_time, $data['split'], $reportData);
    //         }
    //     }

    //     return app(DocService::class)->generateReport($reportData);
    // }

    /**
     * Get report data.
     *
     * @param Session $session
     * @param Student $student
     * @param Carbon $startTime
     * @param int $split
     * @param array $reportData
     * @return void
     */
    // private function getReportData(Session $session, Student $student, Carbon $startTime, int $split, array &$reportData): void
    // {
    //     $duration = $session->duration;
    //     if ($session->duration > $split) {
    //         do {
    //             $reportData[] = [
    //                 'student_full_name' => $student->full_name,
    //                 'session_date' => $startTime->format('Y-m-d'),
    //                 'session_start_time' => $startTime->format('H:i'),
    //                 'session_end_time' => $startTime->addMinutes($split)->format('H:i'),
    //                 'session_minutes' => $split,
    //                 'target_start_date' => $student->targetData->first()?->start_date->format('Y-m-d'),
    //                 'target_end_date' => $student->targetData->first()?->end_date->format('Y-m-d'),
    //                 'target' => $student->targetData->first()?->target,
    //                 'session_rating' => $session->rate,
    //             ];
    //             $duration -= $split;
    //         } while ($duration > $split);
    //     }
    //     $reportData[] = [
    //         'student_full_name' => $student->full_name,
    //         'session_date' => $startTime->format('Y-m-d'),
    //         'session_start_time' => $startTime->format('H:i'),
    //         'session_end_time' => $session->end_time->format('H:i'),
    //         'session_minutes' => (int) $duration,
    //         'target_start_date' => $student->targetData->first()?->start_date->format('Y-m-d'),
    //         'target_end_date' => $student->targetData->first()?->end_date->format('Y-m-d'),
    //         'target' => $student->targetData->first()?->target,
    //         'session_rating' => $session->rate,
    //     ];
    // }
}
