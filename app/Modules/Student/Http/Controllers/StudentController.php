<?php

namespace App\Modules\Student\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Student\Models\Student;
use App\Modules\Student\Services\DocService;
use App\Modules\Student\Models\StudentAvailability;
use App\Modules\Student\Http\Requests\CreateStudentRequest;
use App\Modules\Student\Http\Requests\UpdateStudentRequest;

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
        return view('student.student.index', [
            'students' => Student::paginate()
        ]);
    }

    public function create()
    {
        return view('student.student.create');
    }

    public function edit($id)
    {
        return view('student.student.edit', [
            'student' => Student::find($id),
        ]);
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
     * Update student controller function.
     *
     * @param UpdateStudentRequest $request
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $data = $request->validated();    
        $targetData = app(DocService::class)->extractDataFromDocxFile($data['doc']->getPathName());
        foreach ($targetData as $importData) {
            $student->targetData()->create($importData);
        }
        return redirect('student');
    }
}
