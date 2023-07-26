<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [\App\Http\Controllers\FormController::class, 'dashboard'])->middleware('auth')->name('dashboard');

Route::get('/dashboard/{session_id}', [\App\Http\Controllers\FormController::class, 'breakdown'])->middleware('auth')->name('breakdown');

Route::get('/form', [\App\Http\Controllers\FormController::class, 'index'])->middleware('auth')->name('index');

Route::get('/form/{id}', [\App\Http\Controllers\FormController::class, 'show'])->middleware('auth')->name('show_question');

Route::post('/form/create/post', [\App\Http\Controllers\FormController::class, 'store'])->middleware('auth')->name('store');

Route::get('/form/create/post', [\App\Http\Controllers\FormController::class, 'create'])->middleware('auth')->name('create');

Route::get('/form/{id}/edit', [\App\Http\Controllers\FormController::class, 'edit'])->middleware('auth')->name('edit');

Route::put('/form/{id}/edit', [\App\Http\Controllers\FormController::class, 'update'])->middleware('auth')->name('update');

Route::delete('/delete-question/{id}', [\App\Http\Controllers\FormController::class, 'deleteQuestion'])->middleware('auth')->name('delete_question');

Route::delete('/delete-choice/{id}', [\App\Http\Controllers\FormController::class, 'deleteChoice'])->middleware('auth')->name('delete_choice');

Route::get('/questionnaire', [\App\Http\Controllers\ResponseController::class, 'showQuestionnaire'])->name('questionnaire.show');

Route::post('/questionnaire/submit', [\App\Http\Controllers\ResponseController::class, 'submitQuestionnaire'])->name('questionnaire.submit');

