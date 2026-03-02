<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\FacultyAuthController;
use Faker\Guesser\Name;
use Illuminate\Support\Facades\Route;

// Route::get('/login', function () {
//     return view('welcome');
// });

// Login Information (General Login)
Route::get('/',function(){
  return view('login');
});
Route::get('/login',function(){
  return view('login');
})->name('login');


//Control & Execute logic for general login & faculty login and logout.
Route::post('general/login', [AuthController::class, 'generalLogin'])->name('general.login');
Route::post('faculty/login', [FacultyAuthController::class,'facultyLogin'])->name('faculty.login');

Route::middleware(['checkUserRole','auth'])->group(function(){
Route::post('logout',[AuthController::class, 'logoutUserOrFaculty'])->name('logout');
Route::get('/dashboard', function () { return view('dashboard');})->name('dashboard');
Route::get('/change-password', function () { return view('change-password');})->name('password.change');
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
Route::resource('notices', NoticeController::class);


/* Courses */
Route::get('/courses/',[CourseController::class, 'index'])->name('courses.index');
Route::get('courses/course-create',[CourseController::class ,'create'])->name('courses.create');
Route::post('/courses/store',[CourseController::class, 'store'])->name('courses.store');
Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
Route::put('/courses/{course}/update',[CourseController::class, 'update'])->name('courses.update');
Route::delete('/courses/{course}/delete',[CourseController::class, 'destroy'])->name('courses.destroy');
Route::get('/courses/course-curriculam',[CourseController::class, 'viewcurriculam'])->name('courses.curriculum');
Route::get('/courses/course-teacher',[CourseController::class, 'viewCourseTeacher'])->name('courses.teacher');
Route::get('/courses/course-teacher/assign',[CourseController::class, 'viewAssignCourseTeacher'])->name('assign-course-teacher.create');

/* Batches */
Route::get('/batches/supervisor', function () {
    return view('supervisor.index');
})->name('batches.supervisor');
Route::get('/batch/assign-supervisor',function(){
   return view('supervisor.create');
})->name('supervisor.assign');

Route::get('/batches/distribution', function () {
    return 'Batch Distribution';
})->name('batches.distribution');


});
?>
