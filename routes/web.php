<?php

use App\Http\Controllers\Auth\VerificationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\frontend\SearchControler;
use App\Http\Controllers\frontend\categoryController;
use App\Http\Controllers\frontend\ContactUsController;
use App\Http\Controllers\frontend\dashboard\ProfileController;
use App\Http\Controllers\Frontend\NewsSubscriberController;

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

Route::redirect('/', '/home');

Route::group([
    'as' => 'frontend.'
], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('index');
    Route::post('/news_subscribe', [NewsSubscriberController::class, 'store'])->name('news.subscribe');
    Route::get('/category/{slug}', categoryController::class)->name('category.posts');

    // Post Routes
    Route::controller(PostController::class)->name('post.')->prefix('post')->group(function () {
        Route::get('/{slug}',  'show')->name('show');
        Route::get('/comments/{slug}', 'getAllComments')->name('getAllComments');
        Route::post('/comments/store',  'saveComment')->name('comments.store');
    });

    // Contact Us Routes
    Route::controller(ContactUsController::class)->name('contactus.')->prefix('contact-us')->group(function () {
        Route::get('/',  'index')->name('index');
        Route::post('/store',  'store')->name('store');
    });
    Route::match(['get', 'post'], '/search', SearchControler::class)->name('search');
    // Profile // Dashboard Routes for authenticated users only
    Route::prefix('account/')->name('dashboard.')->middleware(['auth:web', 'verified'])->group(function () {
        Route::controller(ProfileController::class)->name('profile.')->group(function () {
            Route::get('profile', 'index')->name('index');
            Route::post('/post', 'storePost')->name('post.store');
            Route::get('/post/edit/{slug}', 'editPost')->name('post.edit');
            Route::delete('/post/delete', 'deletePost')->name('post.delete');

            // Route::post('/update-password', 'updatePassword')->name('update.password');
        });
    });
});

Route::controller(VerificationController::class)->prefix('email')->name('verification.')->group(function () {
    Route::get('verify', 'show')->name('notice');
    Route::get('verify/{id}/{hash}', 'verify')->name('verify');
    Route::post('resend', 'resend')->name('resend');
});

Auth::routes();
