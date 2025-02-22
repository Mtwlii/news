<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\categoryController;
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


Route::group([
    'as' => 'frontend.'
], function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::post('news_subscribe', [NewsSubscriberController::class, 'store'])->name('news.subscribe');
    Route::get('/category/{slug}', categoryController::class)->name('category.posts');
});
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
