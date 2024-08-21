<?php

namespace App\Modules\Student\Http\Controllers;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Modules\Student\Models\Student;
use App\Modules\Student\Models\StudentSession;
use App\Modules\Student\Models\StudentAvailability;
use App\Modules\Student\Http\Requests\CreateSessionRequest;
use App\Modules\Student\Http\Requests\UpdateSessionRequest;

class StudentSessionController extends Controller
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
     * Get sessions list controller function.
     *
     */
    public function index()
    {
        return view('student.session.index', [
            'sessions' => StudentSession::with(['Student'])->paginate()
        ]);
    }

    public function create()
    {
        return view('student.session.create', [
            'types' => StudentSession::sessionTypes(),
            'students' => Student::get(),
        ]);
    }

    public function edit($id)
    {
        return view('student.session.edit', [
            'session' => StudentSession::find($id),
        ]);
    }

    /**
     * Store student controller function.
     *
     * @param CreateSessionRequest $request
     */
    public function store(CreateSessionRequest $request)
    {
        $data = $request->validated();
        $session = StudentSession::create($data);

        return redirect('session');
    }

    /**
     * Update student controller function.
     *
     * @param UpdateSessionRequest $request
     */
    public function update(UpdateSessionRequest $request, StudentSession $session)
    {
        $data = $request->validated();
        $session = $session->update($data);
        return redirect('session');
    }
}
