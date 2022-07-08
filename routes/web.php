<?php

use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', function () {
        return view('home');
    })->name('home');

    //SHOW PROFILE (Currentuser)
    Route::get('profiles/{user:username}', [ProfileController::class, 'show'])->name('profiles');
});

//ADMIN ROUTES
Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function (){
    Route::get('/users/trashed', [UserController::class, 'trashed'])->name('user.trashed');
    Route::get('/users/trashed/{id}/restore', [UserController::class, 'trashedRestore'])->name('users.trashed.restore');
    Route::post('/users/trashed/{id}/forse_delete', [UserController::class, 'trashedDelete'])->name('users.trashed.destroy');
    Route::get('status', [UserController::class, 'userOnlineStatus']);
    Route::resource('/users', UserController::class);

    Route::resource('/roles', RoleController::class);
    Route::resource('/permissions',PermissionController::class);

    Route::post('images', [ImageController::class, 'store'])->name('images.store');

});

