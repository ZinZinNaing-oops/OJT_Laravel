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

Auth::routes();
Route::get('/locale/{lange}', [LocalizationController::class, 'setLang']);
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/students/view', [StudentsController::class, 'view'])->middleware('auth')->name('view');
Route::get('/students/view_student_list',[StudentsController::class,'viewStudentList'])->name('view');
Route::get('/students/add', [StudentsController::class, 'add'])->middleware('auth');
Route::post('/students/add', [
    StudentsController::class,
    'create'
]);
Route::get('/students/delete', [
    StudentsController::class,
    'delete_student_list'
]);
Route::get('/students/delete_student', [
    StudentsController::class,
    'delete'
]);
Route::get('/students/update', [StudentsController::class, 'edit'])->middleware('auth');
Route::get('/students/show', [StudentsController::class, 'getStudentByRollNo']);
Route::patch('/students/update', [StudentsController::class, 'update']);
Route::get('/students/showDate', [StudentsController::class, 'getStudentByCreatedDate']);
