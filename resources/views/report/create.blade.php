@extends('layouts.app')

@section('content')
<div class="container">
<a href="{{route('student.index')}}" class="btn btn-primary"> Student</a>
<a href="{{route('session.index')}}" class="btn btn-primary"> Session</a>
<a href="{{route('template.edit', 1)}}" class="btn btn-primary"> Template</a>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Generate Report') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('report.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="student_id" class="col-md-4 col-form-label text-md-end">{{ __('Student') }}</label>

                            <div class="col-md-6">                                
                                <select class="form-control @error('students') is-invalid @enderror" name="student_id" required>                                    
                                    <option value="" @selected(old('student_id') == "")>Choose..</option>
                                    @foreach ($students as $student)
                                        <option value="{{ $student->id }}" @selected(old('student_id') == $student->id)>
                                            {{ $student->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('student_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="split_duration" class="col-md-4 col-form-label text-md-end">{{ __('Split session in minutes') }}</label>

                            <div class="col-md-6">
                                <input id="split_duration" type="number" class="form-control @error('split_duration') is-invalid @enderror" name="split_duration" value="{{ old('split_duration') }}" required autocomplete="split_duration" min="1" max="15">

                                @error('split_duration')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="start_date" class="col-md-4 col-form-label text-md-end">{{ __('Start Date') }}</label>

                            <div class="col-md-6">
                                <input id="start_date" type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" value="{{ old('start_date') }}" required autocomplete="start_date" autofocus>

                                @error('start_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="end_date" class="col-md-4 col-form-label text-md-end">{{ __('End Date') }}</label>

                            <div class="col-md-6">
                                <input id="end_date" type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date" value="{{ old('end_date') }}" required autocomplete="end_date" autofocus>

                                @error('end_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>                       

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
