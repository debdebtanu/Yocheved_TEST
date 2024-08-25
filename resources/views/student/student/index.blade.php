@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{route('student.create')}}" class="btn btn-primary"> Add Student</a>
    <a href="{{route('session.index')}}" class="btn btn-primary"> Session</a>
    <table class="table table-striped" id="students">
        <thead>
            <tr>
                <th>{{ __('Full Name') }}</th>
                <th>{{ __('Date of Birth') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->dob }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
 
{{ $students->links() }}
@endsection
