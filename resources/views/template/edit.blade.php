@extends('layouts.app')

@section('content')
<div class="container">
<a href="{{route('student.index')}}" class="btn btn-primary"> Student</a>
<a href="{{route('session.index')}}" class="btn btn-primary"> Session</a>
<a href="{{route('report.create')}}" class="btn btn-primary"> Report</a>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Template') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('template.update', $template->id) }}"  enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PUT">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-12">   
                            <textarea class="form-control @error('template') is-invalid @enderror" id="content" placeholder="Enter the Template" name="template">{{ old('template')? old('template'):$template->template }}</textarea>

                                @error('template')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>                 

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-5">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .ck-editor__editable_inline {
        min-height: 400px;
    }
</style>
<script>
    ClassicEditor.create( document.querySelector( '#content' ) )
    .catch( error => {
        console.error( error );
    } );
</script>
@endsection
