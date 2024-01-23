<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StatsController;
use App\Http\Controllers\TestAnswerController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();
Route::group(['middleware' => ['auth']], function () {
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('roles', RoleController::class);
Route::resource('employees', EmployeeController::class);
Route::put('employees/password/reset/{id}', [App\Http\Controllers\EmployeeController::class, 'resetpass'])->name('employees.reset');
Route::resource('courses', CourseController::class);
Route::resource('lessons', LessonController::class)->except('index');
Route::get('lessons/complete/{enrollment}', [App\Http\Controllers\LessonController::class, 'completeLesson'])->name('lessons.complete');
Route::get('lessons/start/{enrollment}', [App\Http\Controllers\LessonController::class, 'startLesson'])->name('lessons.start');
Route::resource('tests', TestController::class);
Route::resource('answers', TestAnswerController::class)->except('store','update');
Route::post('answers/store/{question}', [App\Http\Controllers\TestAnswerController::class, 'store'])->name('answers.store');
Route::put('answers/update/{question}', [App\Http\Controllers\TestAnswerController::class, 'update'])->name('answers.update');
Route::resource('questions', QuestionController::class)->except('store','update');
Route::post('questions/store/{testId}', [App\Http\Controllers\QuestionController::class, 'store'])->name('questions.store');
Route::put('questions/update/{question}', [App\Http\Controllers\QuestionController::class, 'update'])->name('questions.update');
Route::get('questions/generate/{lesson}', [App\Http\Controllers\LessonController::class, 'generateQuestions'])->name('questions.generate');
Route::resource('enrollments', EnrollmentController::class);
Route::resource('stats', StatsController::class);
// routes/web.php

Route::get('employees/create/bulk-import', [App\Http\Controllers\EmployeeController::class, 'showImportForm'])->name('employees.import.form');
Route::post('employees/create/import-users', [App\Http\Controllers\EmployeeController::class, 'importUsers'])->name('employees.import.users');
Route::post('employees/create/save-users', [App\Http\Controllers\EmployeeController::class, 'saveUsers'])->name('employees.save.users');

});
