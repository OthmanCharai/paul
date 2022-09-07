<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AppsController;
use App\Http\Controllers\UserInterfaceController;
use App\Http\Controllers\CardsController;
use App\Http\Controllers\ComponentsController;
use App\Http\Controllers\ExtensionController;
use App\Http\Controllers\PageLayoutController;
use App\Http\Controllers\FormsController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\MiscellaneousController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ChartsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

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

// Main Page Route


Auth::routes(['verify'=>true]);

Route::get('/',[\App\Http\Controllers\MeetController::class,'index'])->middleware('auth');
Route::resource('doctor', App\Http\Controllers\DoctorController::class)->middleware('auth');
Route::resource('meet',\App\Http\Controllers\MeetController::class)->middleware('auth');
Route::get('/all',[\App\Http\Controllers\MeetController::class,'get_all_meets'])->middleware('auth');
Route::get('create/admin',[\App\Http\Controllers\MeetController::class,'create_admin']);
Route::resource('/user', UserController::class)->middleware('auth');
Route::get('admin/user/list',[UserController::class,'get_all'])->middleware('auth')->name('admin.user');
Route::get('doctors/list',[\App\Http\Controllers\DoctorController::class,'get_all'])->name('doctor.list')->middleware('auth');
