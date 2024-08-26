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
                <div class="card-header">{{ __('Add Student') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('student.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="first_name" class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>

                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="middle_name" class="col-md-4 col-form-label text-md-end">{{ __('Middle Name') }}</label>

                            <div class="col-md-6">
                                <input id="middle_name" type="text" class="form-control @error('middle_name') is-invalid @enderror" name="middle_name" value="{{ old('middle_name') }}" autocomplete="middle_name" autofocus>

                                @error('middle_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="last_name" class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="dob" class="col-md-4 col-form-label text-md-end">{{ __('Date of Birth') }}</label>

                            <div class="col-md-6">
                                <input id="dob" type="date" class="form-control @error('dob') is-invalid @enderror" name="dob" value="{{ old('dob') }}" required autocomplete="dob">

                                @error('dob')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-3">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Days') }}</th>
                                            <th>{{ __('Availability') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Monday</td>
                                            <td><input type="checkbox" name="monday" value="1" {{ old('monday')? "checked":"" }}></td>
                                        </tr>
                                        <tr>
                                            <td>Tuesday</td>
                                            <td><input type="checkbox" name="tuesday" value="1"  {{ old('tuesday')? "checked":"" }}></td>
                                        </tr>
                                        <tr>
                                            <td>Wednesday</td>
                                            <td><input type="checkbox" name="wednesday" value="1"  {{ old('wednesday')? "checked":"" }}></td>
                                        </tr>
                                        <tr>
                                            <td>Thursday</td>
                                            <td><input type="checkbox" name="thursday" value="1"  {{ old('thursday')? "checked":"" }}></td>
                                        </tr>
                                        <tr>
                                            <td>Friday</td>
                                            <td><input type="checkbox" name="friday" value="1"  {{ old('friday')? "checked":"" }}></td>
                                        </tr>
                                        <tr>
                                            <td>Saturday</td>
                                            <td><input type="checkbox" name="saturday" value="1"  {{ old('saturday')? "checked":"" }}></td>
                                        </tr>
                                        <tr>
                                            <td>Sunday</td>
                                            <td><input type="checkbox" name="sunday" value="1"  {{ old('sunday')? "checked":"" }}></td>
                                        </tr>
                                    </tbody>
                                </table>
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
