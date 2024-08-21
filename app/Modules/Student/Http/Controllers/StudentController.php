<?php

namespace App\Modules\Student\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Exceptions\HttpErrorResponse;
use App\Modules\Student\Models\Student;
use App\Modules\Student\Services\StudentService;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use App\Modules\Student\Http\Requests\CreateStudentRequest;
use App\Modules\Student\Http\Requests\GenerateReportRequest;
use App\Modules\Student\Http\Requests\ImportTargetDataRequest;
use App\Modules\Student\Models\StudentAvailability;

class StudentController extends Controller
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
    /**
     * Get students list controller function.
     *
     */
    public function index()
    {
        return view('student.index', [
            'students' => Student::paginate()
        ]);
    }

    public function create()
    {
        return view('student.create');
    }

    /**
     * Store student controller function.
     *
     * @param CreateStudentRequest $request
     */
    public function store(CreateStudentRequest $request)
    {
        $data = $request->validated();
        $student = Student::create($data);
        $data['student_id'] = $student->id;
        StudentAvailability::create($data);

        return redirect('student');
    }

    /**
     * Import student's target data controller function.
     *
     * @param ImportTargetDataRequest $request
     * @param Student $student
     * @return JsonResponse
     */
    public function importTargetData(ImportTargetDataRequest $request, Student $student, StudentService $studentService): JsonResponse
    {
        $studentService->importTargetData($student, $request->validated());

        return $this->sendSuccessResponse(__('response.student.target-data-imported'));
    }

    /**
     * Generate student's report controller function.
     *
     * @param GenerateReportRequest $request
     * @param Student $student
     * @return BinaryFileResponse
     * @throws HttpErrorResponse
     */
    public function generateReport(GenerateReportRequest $request, Student $student, StudentService $studentService): BinaryFileResponse
    {
        $fileName = $studentService->generateReport($student, $request->validated());

        return response()->download(public_path($fileName));
    }
}
