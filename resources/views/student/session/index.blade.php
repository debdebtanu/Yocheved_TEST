@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{route('student.index')}}" class="btn btn-primary"> Student</a>
    <a href="{{route('session.create')}}" class="btn btn-primary"> Add Session</a>
    <a href="{{route('template.edit', 1)}}" class="btn btn-primary"> Template</a>
    <a href="{{route('report.create')}}" class="btn btn-primary"> Report</a>
    <table class="table table-striped" id="students">
        <thead>
            <tr>
                <th>{{ __('Student') }}</th>
                <th>{{ __('Date') }}</th>
                <th>{{ __('Start Time') }}</th>
                <th>{{ __('End Time') }}</th>
                <th>{{ __('Type') }}</th>
                <th>{{ __('Rate') }}</th>
                <th>{{ __('Notified') }}</th>
                <th>{{ __('Action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sessions as $session)
                <tr>
                    <td>{{ $session->student->name }}</td>
                    <td>{{ $session->date }}</td>
                    <td>{{ $session->start_time }}</td>
                    <td>{{ $session->end_time }}</td>
                    <td>{{ $session->type }}</td>
                    <td>{{ $session->rate }}</td>
                    <td>{{ ($session->is_notified)? "Yes":"No" }}</td>
                    <td>
                        <a href="{{route('session.edit', $session->id)}}" class="btn btn-sm btn-warning">Rate</a>
                    </td>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
 
{{ $sessions->links() }}
@endsection
