<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaginationController;
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



route::get('/pagination', [PaginationController::class, 'pagination'])->name('pagination.list');
route::post('/pagination/add', [PaginationController::class, 'insert'])->name('pagination.add');
Route::get('/edit/{id}', [PaginationController::class, 'edit'])->name('edit.list');
Route::post('/update/{id}', [PaginationController::class, 'update'])->name('edit.update');
Route::delete('delete/{id}', [PaginationController::class, 'destroy'])->name('pagination.delete');
Route::get('pagination/paginate', [PaginationController::class, 'paginate']);
Route::get('/search', [PaginationController::class, 'search'])->name('search.list');

?>