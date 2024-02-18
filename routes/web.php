<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GalleryLikeController;
use App\Http\Controllers\UserSettingController;
use App\Http\Controllers\DownloadImageController;
use App\Http\Controllers\DashboardAdminController;

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


Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::group(['middleware' => ['guest']], function () {
    // register admin
    Route::get('/register/admin', [AuthController::class, 'registerAdmin'])->name('register.admin');
    Route::post('/register/admin', [AuthController::class, 'storeAdmin'])->name('register.store.admin');
    // register user
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'store'])->name('register.store');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login.authenticate');
});

Route::group(['middleware' => ['auth']], function () {

    Route::get('/search', [HomeController::class, 'search'])->name('search');

    // images expect index
    Route::resource('images', GalleryController::class)->except('index','edit');
    Route::post('/download/image/{id}', [DownloadImageController::class, 'DownloadImage'])->name('download.image');

    // profile page
    Route::get('/profile/{user:slug}', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile', [ProfileController::class, 'store'])->name('profile.store');
    Route::get('/profile/{user:slug}/image/{id}', [ProfileController::class, 'showImage'])->name('profile.showImage');

    Route::resource('settings/user', UserSettingController::class)->except('create','index');
    Route::get('settings/user/{user:slug}/account-management', [ProfileController::class, 'create'])->name('settings.account-management');
    Route::put('settings/{user:slug}/account-management', [ProfileController::class, 'update'])->name('settings.account-management.update');
    // Route::post('settings/{user:slug}/account-management', [ProfileController::class, 'store'])->name(
    //     'settings.account-management.store'
    // );
    // comment controller
    Route::post('/comment/{image}', [CommentController::class, 'store'])->name('comment.store');
    Route::delete('/comment/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy');

    // like controller
    Route::post('/image/{image}/like', [GalleryLikeController::class, 'like'])->name('image.like');
    Route::post('/image/{image}/unlike', [GalleryLikeController::class, 'unlike'])->name('image.unlike');


    Route::group(['middleware' => ['can:admin.guard']], function () {

        // dashboard controller
        Route::get('/dashboard/traffic/{year}', [AdminController::class, 'traffic'])->name('admin.traffic');

        Route::get('/dashboard/data-user', [AdminController::class, 'dataUser'])->name('admin.user');
        Route::delete('/dashboard/data-user/{user:slug}', [AdminController::class, 'destroy'])->name('admin.user.destroy');

        Route::get('/dashboard/data-image', [AdminController::class, 'dataImage'])->name(
            'admin.image'
        );
        Route::put('/dashboard/data-image/{image}', [AdminController::class, 'changeStatus'])->name('admin.image.status');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
