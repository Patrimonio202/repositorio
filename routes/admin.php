<?php

use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;


Route::get('admin', [HomeController::class,'index'])->middleware('can:admin.home')->name('admin.home');

Route::resource('admin/users', UserController::class)->only('index', 'edit', 'update')->names('admin.users');
Route::resource('admin/roles', RoleController::class)->names('admin.roles');

Route::resource('admin/categories', CategoryController::class)->except('show')->names('admin.categories');
Route::resource('admin/tags', TagController::class)->except('show')->names('admin.tags');
Route::resource('admin/posts', PostController::class)->except('show')->names('admin.posts');

