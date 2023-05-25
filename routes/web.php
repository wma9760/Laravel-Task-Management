<?php

use App\Http\Controllers\ContactsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\PreventBackHistory;
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
Route::middleware(['auth'])->group(function () {

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/proects', [HomeController::class, 'userProjects'])->name('home.project');
Route::get('/tasks', [HomeController::class, 'userTasks'])->name('home.task');
Route::get('/userAccount', [HomeController::class, 'userAccount'])->name('home.userAccount');

Route::get('/chat-room', function () {
    return view('chat.index');
});
Route::get('/chat', 'ChatController@index');
    Route::get('/messages', 'ChatController@fetchMessages');
    Route::post('/messages', 'ChatController@sendMessage');
Route::get('/chat', 'ChatController@index')->name('chat.index');
Route::post('/chat/send', 'ChatController@send')->name('chat.send');
Route::controller(ContactsController::class)->group(function(){
    Route::post('password/request',  'ForgotPassword')->name('ForgotPassword');
Route::post('password/code/check', 'CodeCheck')->name('CodeCheck');
Route::post('password/reset', 'ResetPassword')->name('ResetPassword');
});
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard')->middleware('is_admin');
Route::controller(ContactsController::class)->group(function(){
    Route::get('contact/create', 'create')->name('contact.create');
    Route::post('contact/create', 'store')->name('contact.store');
    Route::get('contact/update/{id}', 'update')->name('contact.update');
    Route::post('contact/update/{id}', 'updatedb')->name('contact.update');
    Route::get('verify-mail/{token}', 'VerificationMail')->name('VerificationMail');
    Route::get('EmailVerify/{email}', 'verifyAccount')->name('verifyAccount');
    Route::post('password/email',  'ForgotPassword')->name('ForgotPassword');
    Route::post('password/code/check', 'CodeCheck')->name('CodeCheck');
    Route::post('password/reset', 'ResetPassword')->name('ResetPassword');
    Route::get('contact/index', 'index')->name('contact.index');
    Route::get('contact/search', 'search')->name('contact.search');
    Route::get('contact/destroy/{id}', 'destroy')->name('contact.destroy');

});
Route::get('UserAccount/update/{id}', [ContactsController::class, 'edit'])->name("contact.edit");
Route::post('UserAccount/update/{id}', [ContactsController::class, 'update'])->name("contact.update");
Route::group(array('as' => 'project.', 'prefix' => 'project'), function () {
    Route::get('/', [ProjectController::class, 'index'])->name("index");
    Route::get('create', [ProjectController::class, 'create'])->name("create");
    Route::post('create', [ProjectController::class, 'store'])->name("create");
    Route::get('update/{id}', [ProjectController::class, 'edit'])->name("update");
    Route::post('update/{id}', [ProjectController::class, 'update'])->name("update");
    Route::get('show/{id}', [ProjectController::class, 'show'])->name("show");
    Route::post('destroy/{id}', [ProjectController::class, 'destroy'])->name("destroy");
});
Route::group(array('as' => 'task.', 'prefix' => 'task'), function () {
    Route::get('/', [TaskController::class, 'index'])->name("index");
    Route::get('create', [TaskController::class, 'create'])->name("create");
    Route::post('create', [TaskController::class, 'store'])->name("store");
    Route::get('update/{id}', [TaskController::class, 'edit'])->name("update");
    Route::post('update/{id}', [TaskController::class, 'update'])->name("update");
    Route::post('show/{id}', [TaskController::class, 'show'])->name("show");
    Route::get('destroy/{id}', [TaskController::class, 'destroy'])->name("destroy");
    Route::post('projectMembers', [TaskController::class, 'projectMembers'])->name("projectMembers");
    Route::get('TaskCompleted/{id}', [TaskController::class, 'TaskCompleted'])->name("TaskCompleted");
    
});
});

Route::group(['middleware' => 'prevent-back-history'], function () {

});
Auth::routes();

