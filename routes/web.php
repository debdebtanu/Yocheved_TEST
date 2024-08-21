<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Modules\Student\Http\Controllers\StudentController;

Route::get('/', function () {
    if(Auth::check()){
        return redirect('/student');
    } else {
        return redirect('/login');
    }
});

Auth::routes();
Route::group(['middleware' => 'auth'], function () {
    Route::resource('student', StudentController::class);
});
