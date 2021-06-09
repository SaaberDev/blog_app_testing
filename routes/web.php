<?php

use App\Http\Controllers\BlogPostAdminController;
use App\Http\Controllers\ExternalPostAdminController;
use App\Http\Controllers\ExternalPostSuggestionController;
use App\Http\Controllers\JsonPostController;
use App\Http\Controllers\RedirectAdminController;
use App\Http\Controllers\UpdatePostSlugController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\DeletePostController;
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

Route::feeds();

Route::get('/', [BlogPostController::class, 'index']);
Route::get('/blog/{post}.json', [JsonPostController::class, 'show']);
Route::get('/blog.json', [JsonPostController::class, 'index']);
Route::get('/blog/{post}', [BlogPostController::class, 'show']);

Route::post('/suggest', ExternalPostSuggestionController::class);

Route::middleware(['auth:sanctum', 'verified'])
    ->prefix('/admin')
    ->group(function () {
        Route::get('/', function () {
            return view('dashboard');
        })->name('dashboard');

        Route::get('/blog', [BlogPostAdminController::class, 'index']);
        Route::get('/blog/new', [BlogPostAdminController::class, 'create']);
        Route::post('/blog/new', [BlogPostAdminController::class, 'store']);
        Route::get('/blog/{post}/edit', [BlogPostAdminController::class, 'edit']);
        Route::post('/blog/{post}/edit', [BlogPostAdminController::class, 'update']);
        Route::post('/blog/{post}/slug', UpdatePostSlugController::class);
        Route::post('/blog/{post}/delete', DeletePostController::class);

        Route::get('/redirects', [RedirectAdminController::class, 'index']);

        Route::get('/externals', [ExternalPostAdminController::class, 'index']);
        Route::get('/externals/{externalPost}/approve', [ExternalPostAdminController::class, 'approve']);
        Route::get('/externals/{externalPost}/remove', [ExternalPostAdminController::class, 'remove']);

    });
