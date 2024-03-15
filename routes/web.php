<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\BuildController;
use App\Http\Controllers\BuildRatingController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\BuildCommentController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\HeroController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserBuildController;
use App\Http\Controllers\UserFavoriteController;
use App\Models\Rating;
use App\Models\Build;
use App\Models\Comment;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/heroes/{hero}/builds/create', [BuildController::class, 'create'])->name('build.create')->can('create', Build::class);
    Route::post('/heroes/{hero}/builds', [BuildController::class, 'store'])->name('build.store')->can('create', Build::class);

    Route::get('heroes/{hero}/builds/{build}/edit', [BuildController::class, 'edit'])->name('build.edit')->can('update', 'build');
    Route::put('heroes/{hero}/builds/{build}', [BuildController::class, 'update'])->name('build.update')->can('update', 'build');

    Route::delete('/builds/{build}', [BuildController::class, 'destroy'])->name('build.delete')->can('delete', 'build');

    Route::post('builds/{build}/ratings', [BuildRatingController::class, 'store'])->name('build.rating.store')->can('create', Rating::class);

    Route::get('/favorites', [UserFavoriteController::class, 'index'])->name('user.favorites');
    Route::post('/builds/{build}/favorite', [UserFavoriteController::class, 'store'])->name('user.favorite.store');
    Route::delete('/builds/{build}/favorite', [UserFavoriteController::class, 'destroy'])->name('user.favorite.delete');

    Route::post('/builds/{build}/comments', [BuildCommentController::class, 'store'])->name('build.comment.store')->can('create', Comment::class);;

    Route::post('/comments/{comment}/replies', [CommentController::class, 'store'])->name('comment.store')->can('create', Comment::class);
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy')->can('delete', 'comment');
});

Route::get('/builds', [BuildController::class, 'index'])->name('builds');
Route::get('/builds/{build}', [BuildController::class, 'show'])->name('build.show');

Route::get('/users/{user}', [UserController::class, 'show'])->name('user.show');
Route::get('/users/{user}/builds', [UserBuildController::class, 'index'])->name('user.builds');

Route::get('/heroes', [HeroController::class, 'index'])->name('heroes');
Route::get('/heroes/{hero}', [HeroController::class, 'show'])->name('hero.show');

Route::get('/maps', [MapController::class, 'index'])->name('maps');

Route::get('/comments/{comment}', [CommentController::class, 'show'])->name('comment.show');

require __DIR__.'/auth.php';
