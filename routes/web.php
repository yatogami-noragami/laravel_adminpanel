<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;


// login and register
Route::redirect('/', 'loginPage');
Route::get('loginPage', [AuthController::class, 'loginPage'])->name('auth#loginPage');
Route::get('registerPage', [AuthController::class, 'registerPage'])->name('auth#registerPage');


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {

    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    Route::group(['prefix' => 'category', 'middleware' => 'admin_auth'], function () {
        Route::get('list', [CategoryController::class, 'list'])->name('category#list');
        Route::get('createPage', [CategoryController::class, 'createPage'])->name('category#createPage');
        Route::post('create', [CategoryController::class, 'create'])->name('category#create');
        Route::get('editPage/{id}', [CategoryController::class, 'editPage'])->name('category#editPage');
        Route::post('edit/{id}', [CategoryController::class, 'edit'])->name('category#edit');
        Route::post('editFast/{id}', [CategoryController::class, 'editFast'])->name('category#editFast');
        Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('category#delete');
    });

    Route::group(['prefix' => 'item', 'middleware' => 'admin_auth'], function () {
        Route::get('list', [ItemController::class, 'list'])->name('item#list');
        Route::get('createPage', [ItemController::class, 'createPage'])->name('item#createPage');
        Route::post('create', [ItemController::class, 'create'])->name('item#create');
        Route::get('editPage/{id}', [ItemController::class, 'editPage'])->name('item#editPage');
        Route::post('edit/{id}', [ItemController::class, 'edit'])->name('item#edit');
        Route::post('editFast/{id}', [ItemController::class, 'editFast'])->name('item#editFast');
        Route::get('delete/{id}', [ItemController::class, 'delete'])->name('item#delete');
    });
});
