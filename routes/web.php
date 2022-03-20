<?php

use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\CoverImageController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\UserProfileController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::group(['middleware'=>'auth'],function(){
    Route::get('users/profile',[UserProfileController::class,'edit'])->name('profile.edit');
    Route::put('users/profile/password', [UserProfileController::class, 'passwordUpdate'])->name('profile.password.update');
    Route::put('users/profile',[UserProfileController::class,'update'])->name('profile.details.update');

    //companies
    Route::put('/companies/{id}/logo',[CompaniesController::class,'logoUpdate'])->name('companies.logo.update');
    Route::put('/companies/{id}/cover-images', [CompaniesController::class, 'coverImageUpdate'])->name('companies.cover_images.update');
    Route::resource('companies',CompaniesController::class);

    //companies cover images update
    Route::delete('/cover-images/{id}', [CoverImageController::class, 'destroyCoverImage'])->name('cover_images.destroy');

    // employees
    Route::put('/employees/{id}/avatars',[EmployeesController::class,'updateAvatar'])->name('employees.avatar.update');
    Route::get('/company/{id}/employees',[EmployeesController::class,'companyEmployess'])->name('companies.employees');
    Route::resource('/employees',EmployeesController::class);
});
