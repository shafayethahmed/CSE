<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\FacultyAuthController;
use App\Http\Controllers\offeredCoursesController;
use App\Http\Controllers\FacultyCourseController;
use App\Http\Controllers\SuporvisorController;
use App\Http\Controllers\Faculty\FacultyDashboardController;
use Faker\Guesser\Name;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\TestStatus\Notice;

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

// Faculty Portal All Route: 
Route::get('/faculty/dashboard', [FacultyDashboardController::class, 'index'])->name('faculty.dashboard');


//Control & Execute logic for general login & faculty login and logout.
//Thorttle are activated for both login.
Route::middleware(['throttle:5,1'])->group(function(){
    Route::post('general/login', [AuthController::class, 'generalLogin'])->name('general.login');
    Route::post('faculty/login', [FacultyAuthController::class,'facultyLogin'])->name('faculty.login');
});

// Middleware Start from here
Route::middleware(['checkUserRole','auth'])->group(function(){
Route::post('logout',[AuthController::class, 'logoutUserOrFaculty'])->name('logout');
Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');
Route::get('/change-password', function () { return view('change-password');})->name('password.change');

/* Students */
Route::resource('students',StudentController::class);
Route::get('/student/image/{id}', [StudentController::class, 'showImage']);

// Alumni Student 
Route::get('alumni/',[AlumniController::class, 'index'])->name('alumni.index');
Route::delete('/alumni/{alumni}/delete', [AlumniController::class , 'destroy'])->name('alumni.destroy');

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

// Offered Course : 
Route::get('courses/offered', [offeredCoursesController::class,'index'])->name('courses.offered-curriculum');
Route::get('courses/offred/course-offer',[offeredCoursesController::class, 'create'])->name('courses.offered.create');
Route::post('courses/offered', [offeredCoursesController::class,'store'])->name('courses.offered.store');
Route::get('courses/offered/courses' , [offeredCoursesController::class, 'alreadyOfferedCourses' ])->name('courses.offered-curriculum.assigned');
Route::delete('/offered-course/delete/{id}', [offeredCoursesController::class, 'deleteExistedCourse']);

// Course Teacher Assign Section: 
Route::get('courses/faculty-taught', [FacultyCourseController::class, 'index'])->name('courses.faculty-taught');
Route::get('courses/faculty/assign', [FacultyCourseController::class, 'create'])->name('assign-course-teacher.create');
Route::get('courses/course-teacher/fetch',[FacultyCourseController::class, 'fetchLatestCourses'])->name('course.course-teacher.fetch');
Route::get('courses/course-teacher/{id}/edit',[FacultyCourseController::class, 'edit'])->name('courses.course-teacher.edit');
Route::post('courses/course-teacher/{id}',[FacultyCourseController::class, 'update'])->name('courses.faculty-course.update');

// Batche Supervisor:
Route::get('/batches/supervisor', [SuporvisorController::class, 'index'])->name('supervisor.index');
Route::get('/faculty-search', [SuporvisorController::class, 'searchFaculty'])->name('batch-supervisor.faculty.search');
Route::post('/batch-supervisor-store',[SuporvisorController::class, 'store'])->name('batch-supervisor.store');
Route::delete('/batch-supervisor/{supervisorid}',[SuporvisorController::class, 'destroy'])->name('batch-supervisor.destroy');

/* Batches */
Route::get('/batch/assign-supervisor',function(){
   return view('supervisor.create');
})->name('supervisor.assign');

Route::get('/batches/distribution', function () {
    return 'Batch Distribution';
})->name('batches.distribution');
});

?>
