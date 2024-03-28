<?php

use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\PostController as PublicPostController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [PublicPostController::class, 'index'])->name('posts');
Route::get('/posts/{postSlug}', [PublicPostController::class, 'show'])->name('posts.show');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resources([
            'posts' => PostController::class,
            'media' => MediaController::class,
            'analytics' => AnalyticsController::class
        ]);
        Route::get('posts/{post}/delete', [PostController::class, 'delete'])->name('posts.delete');
        Route::get('analytics/{analytic}/delete', [AnalyticsController::class, 'delete'])->name('analytics.delete');
    });

});
