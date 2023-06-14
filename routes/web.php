<?php

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('page',[App\http\Controllers\PageController::class,'getIndex']);

Route::get('loaisanpham/{type}',[App\http\Controllers\PageController::class,'getLoaiSP']);

Route::get('chitietsanpham',[App\http\Controllers\PageController::class,'getDetail']);

Route::get('lienhe',[App\http\Controllers\PageController::class,'getContact']);

Route::get('gioithieu',[App\http\Controllers\PageController::class,'getAbout']);


//Đăng Ký//Đăng Nhập

Route::get('/login', function(){
    return view('users.login');
});
Route::post('/login',[App\http\Controllers\UserController::class,'login']);
Route::get('/logout',[App\http\Controllers\UserController::class,'logout']);

Route::get('/register', function(){
    return view('users.register');
});
Route::post('/register',[App\http\Controllers\UserController::class,'Register']);

// admin 

Route::get('admin', [App\Http\Controllers\AdminController::class, 'getIndexAdmin']);	

Route::get('/admin-add-form', [App\Http\Controllers\AdminController::class, 'getAdminAdd'])->name('add-product');

Route::post('/admin-add-form', [App\Http\Controllers\AdminController::class, 'postAdminAdd']);	

Route::get('/admin-edit-form/{id}', [App\Http\Controllers\AdminController::class, 'getAdminEdit']);

Route::post('/admin-edit', [App\Http\Controllers\AdminController::class, 'postAdminEdit']);	

Route::post('/admin-delete/{id}', [App\Http\Controllers\AdminController::class, 'postAdminDelete']);	

Route::get('/admin-export', [App\Http\Controllers\AdminController::class, 'exportAdminProduct'])->name('export');

