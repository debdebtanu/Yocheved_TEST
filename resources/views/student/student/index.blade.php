@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{route('student.create')}}" class="btn btn-primary"> Add Student</a>
    <a href="{{route('session.index')}}" class="btn btn-primary"> Session</a>
    <a href="{{route('template.edit', 1)}}" class="btn btn-primary"> Template</a>
    <a href="{{route('report.create')}}" class="btn btn-primary"> Report</a>
    <table class="table table-striped" id="students">
        <thead>
            <tr>
                <th>{{ __('Full Name') }}</th>
                <th>{{ __('Date of Birth') }}</th>
                <th>{{ __('Action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->dob }}</td>
                    <td>
                        <a href="{{route('student.edit', $student->id)}}" class="btn btn-sm btn-warning">Import</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
 
{{ $students->links() }}
@endsection
