<?php

namespace App\Modules\Student\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Student\Models\Student;
use App\Modules\Student\Http\Requests\CreateStudentRequest;
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
        return view('student.student.index', [
            'students' => Student::paginate()
        ]);
    }

    public function create()
    {
        return view('student.student.create');
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
}
