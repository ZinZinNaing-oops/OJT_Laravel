<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\LocalizationController;
use App\Models\Students;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//language change
Auth::routes();
Route::get('/locale/{lange}', [
    LocalizationController::class,
    'setLang'
]);

//home page
Route::get('/', [
    App\Http\Controllers\HomeController::class,
    'index'
])->name('home');

//view student page
Route::get('/students/view', [
    StudentsController::class, 'viewStudents'
])->middleware('auth')->name('view');

//view student by registered date
Route::get('/students/view_student_list', [
    StudentsController::class,
    'viewStudentsByDate'
]);

//add student page
Route::get('/students/add', [
    StudentsController::class,
    'addStudentView'
])->middleware('auth');

//add student 
Route::post('/students/add', [
    StudentsController::class,
    'addStudent'
]);

//delete student page
Route::get('/students/delete', [
    StudentsController::class,
    'deleteStudentView'
]);

//delete student
Route::get('/students/delete_student', [
    StudentsController::class,
    'deleteStudent'
]);

//update student page
Route::get('/students/update', [
    StudentsController::class,
    'updateStudentView'
])->middleware('auth');

//update student
Route::patch('/students/update', [
    StudentsController::class,
    'updateStudent'
]);

//show student by roll no
Route::get('/students/show', [
    StudentsController::class,
    'getStudentByRollNo'
]);

//show student by registered date
Route::get('/students/showDate', [
    StudentsController::class,
    'getStudentByCreatedDate'
]);
