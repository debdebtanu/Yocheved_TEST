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
                <div class="card-header">{{ __('Import doc file') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('student.update', $student->id) }}"  enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PUT">
                        @csrf

                        <div class="row mb-3">
                            <label for="student_id" class="col-md-4 col-form-label text-md-end">{{ __('Document') }}</label>

                            <div class="col-md-6 mt-2">   
                                <input id="doc" type="file" class="form-control @error('doc') is-invalid @enderror" name="doc" value="{{ old('doc') }}" required autocomplete="doc" autofocus>

                                @error('doc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>                 

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Import') }}
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
