<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\FacultyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/change-password', function () {
    return view('change-password');
})->name('password.change');


/* Students */
Route::resource('students',StudentController::class);
// Alumni Student 
Route::get('alumni/',[AlumniController::class, 'index'])->name('alumni.index');
// Route for Users
Route::resource('users',UserController::class);

/* Faculty */
Route::get('/faculty/search', [FacultyController::class, 'search'])->name('faculty.search');

Route::resource('faculty', FacultyController::class);

/* Notices */
Route::get('/notices', function () {
    return 'Notices';
})->name('notices.index');


/* Courses */
Route::get('/courses/',[CourseController::class, 'index'])->name('courses.index');
Route::get('courses/course-create',[CourseController::class ,'create'])->name('courses.create');
Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
Route::get('/courses/course-curriculam',[CourseController::class, 'viewcurriculam'])->name('courses.curriculum');
Route::get('/courses/course-teacher',[CourseController::class, 'viewCourseTeacher'])->name('courses.teacher');


/* Batches */
Route::get('/batches/assign', function () {
    return 'Assign Batch';
})->name('batches.assign');

Route::get('/batches/distribution', function () {
    return 'Batch Distribution';
})->name('batches.distribution');





/* Logout (Dummy for UI) */
Route::get('/logout', function () {
    return redirect()->route('dashboard');
})->name('logout');
