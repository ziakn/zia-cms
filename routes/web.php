<?php

use App\Http\Controllers\CMS\AmenityController;
use App\Http\Controllers\CMS\CategoryController;
use App\Http\Controllers\CMS\RoleController;
use App\Http\Controllers\CMS\UserController;
use App\Http\Controllers\CMS\HomeController;
use App\Http\Controllers\CMS\ImageController;
use App\Http\Controllers\CMS\ImageFolderController;
use Illuminate\Support\Facades\Route;
  



require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('welcome');
});




// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

Route::get('/logoutuser', [UserController::class, 'logout']);
//resources


Route::middleware(['auth'])->prefix('/app')->group(function () {
    Route::resource('roles', RoleController::class);
    Route::get('permission', [RoleController::class, 'getpermission']);
    Route::get('allcategory', [CategoryController::class, 'index']);
    Route::resource('user', UserController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('/folder', ImageFolderController::class);
    Route::resource('/image', ImageController::class);
    Route::resource('/amenity', AmenityController::class);
});






// Auth::routes();

Route::middleware(['auth'])->get('/home', [HomeController::class, 'index']);
Route::middleware(['auth'])->get('/{slug}', [HomeController::class, 'index']);
Route::middleware(['auth'])->get('/{slug}/{child}', [HomeController::class, 'index']);
Route::middleware(['auth'])->get('/{slug}/{child}/{id}', [HomeController::class, 'index']);
