<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/change-password', function () {
    return 'Change Password';
})->name('password.change');


/* Students */
Route::resource('students',StudentController::class);

Route::get('/students/alumni', function () {
    return 'Alumni Students';
})->name('students.alumni');


/* Faculty */
Route::get('/faculty', function () {
    return 'Faculty & Staff';
})->name('faculty.index');


/* Notices */
Route::get('/notices', function () {
    return 'Notices';
})->name('notices.index');


/* Courses */
Route::get('/courses/subjects', function () {
    return 'Subjects';
})->name('courses.subjects');

Route::get('/courses/curriculum', function () {
    return 'Curriculum';
})->name('courses.curriculum');

Route::get('/courses/assign-teacher', function () {
    return 'Assign Teacher';
})->name('courses.assign.teacher');


/* Batches */
Route::get('/batches/assign', function () {
    return 'Assign Batch';
})->name('batches.assign');

Route::get('/batches/distribution', function () {
    return 'Batch Distribution';
})->name('batches.distribution');


/* Users */
Route::get('/users', function () {
    return 'Users & Roles';
})->name('users.index');


/* Logout (Dummy for UI) */
Route::get('/logout', function () {
    return redirect()->route('dashboard');
})->name('logout');
