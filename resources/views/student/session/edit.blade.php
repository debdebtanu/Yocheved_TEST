@extends('layouts.app')

@section('content')
<div class="container">
<a href="{{route('student.index')}}" class="btn btn-primary"> Student</a>
<a href="{{route('session.index')}}" class="btn btn-primary"> Session</a>
<a href="{{route('template.edit', 1)}}" class="btn btn-primary"> Template</a>
<a href="{{route('report.create')}}" class="btn btn-primary"> Report</a>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Rate Session') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('session.update', $session->id) }}">
                    <input type="hidden" name="_method" value="PUT">
                        @csrf

                        <div class="row mb-3">
                            <label for="student_id" class="col-md-4 col-form-label text-md-end">{{ __('Student') }}</label>

                            <div class="col-md-6 mt-2">                                
                                {{ $session->student->name }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="type" class="col-md-4 col-form-label text-md-end">{{ __('Type') }}</label>

                            <div class="col-md-6 mt-2">              
                            {{ $session->type }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="start_time" class="col-md-4 col-form-label text-md-end">{{ __('Start Time') }}</label>

                            <div class="col-md-6 mt-2">              
                            {{ $session->start_time }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="duration" class="col-md-4 col-form-label text-md-end">{{ __('Duration') }}</label>

                            <div class="col-md-6 mt-2">              
                            {{ abs(round((strtotime($session->end_time) - strtotime($session->start_time)) / 60)) }}
                            </div>
                        </div>  

                        <div class="row mb-3">
                            <label for="rate" class="col-md-4 col-form-label text-md-end">{{ __('Rate') }}</label>

                            <div class="col-md-6">
                                <input id="rate" type="number" class="form-control @error('rate') is-invalid @enderror" name="rate" value="{{ old('rate')? old('rate'):0 }}" required autocomplete="rate" min="0" max="10">

                                @error('rate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>                       

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Rate') }}
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
