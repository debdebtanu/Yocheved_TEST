@extends('layouts.app')

@section('content')
<div class="container">
<a href="{{route('student.index')}}" class="btn btn-primary"> Student</a>
<a href="{{route('session.index')}}" class="btn btn-primary"> Session</a>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Session') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('session.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="student_id" class="col-md-4 col-form-label text-md-end">{{ __('Student') }}</label>

                            <div class="col-md-6">                                
                                <select class="form-control @error('students') is-invalid @enderror" name="student_id" required>                                    
                                    <option value="" @selected(old('student_id') == "")>Choose..</option>
                                    @foreach ($students as $student)
                                        <option value="{{ $student->id }}" @selected(old('student_id') == $student->id)>
                                            {{ $student->full_name }}
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
                            <label for="type" class="col-md-4 col-form-label text-md-end">{{ __('Type') }}</label>

                            <div class="col-md-6">
                                <select class="form-control @error('type') is-invalid @enderror" name="type">
                                    @foreach ($types as $type)
                                        <option value="{{ $type }}" @selected(old('type') == $type)>
                                            {{ ucfirst(str_replace("-", " ", $type)) }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="start_time" class="col-md-4 col-form-label text-md-end">{{ __('Start Time') }}</label>

                            <div class="col-md-6">
                                <input id="start_time" type="datetime-local" class="form-control @error('start_time') is-invalid @enderror" name="start_time" value="{{ old('start_time') }}" required autocomplete="start_time" autofocus>

                                @error('start_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="duration" class="col-md-4 col-form-label text-md-end">{{ __('Duration') }}</label>

                            <div class="col-md-6">
                                <input id="duration" type="number" class="form-control @error('duration') is-invalid @enderror" name="duration" value="{{ old('duration') }}" required autocomplete="duration" min="1" max="15">

                                @error('duration')
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
