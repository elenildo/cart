<?php

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
Auth::routes();

Route::get('/', 'HomeController@index')->name('homepage');
Route::get('produto/{id}', 'HomeController@product')->name('produto');
Route::get('carrinho', 'CartController@index')->name('carrinho');
Route::get('carrinho/adicionar/{id}', 'CartController@store')->name('carrinho.adicionar');
Route::get('carrinho/remover/{id}', 'CartController@destroy')->name('carrinho.remover');
Route::get('carrinho/finalizar/{id}', 'CartController@finish')->name('carrinho.finalizar');

Route::get('home', 'HomeController@index')->name('home');

Route::prefix('admin')->middleware('can:admin_access')->group(function(){
    Route::get('/', function() {
        return view('admin.index');
    })->name('admin.home');

    Route::prefix('produtos')->middleware('can:manage_products')->group(function(){
        Route::get('/', 'admin\ProductController@index')->name('admin.produtos');
        Route::get('adicionar', 'admin\ProductController@create')->name('admin.produtos.adicionar');
        Route::post('salvar', 'admin\ProductController@store')->name('admin.produtos.salvar');
        Route::get('editar/{id}', 'admin\ProductController@edit')->name('admin.produtos.editar');
        Route::put('editar/{id}', 'admin\ProductController@update')->name('admin.produtos.atualizar');
        Route::get('excluir/{id}', 'admin\ProductController@destroy')->name('admin.produtos.excluir');
    });

    Route::prefix('usuarios')->middleware('can:manage_users')->group(function(){
        Route::get('/', 'admin\UserController@index')->name('admin.usuarios');
        Route::get('editar/{id}', 'admin\UserController@edit')->name('admin.usuarios.editar');
        Route::put('editar/{id}', 'admin\UserController@update')->name('admin.usuarios.atualizar');

    });

    Route::prefix('papeis')->middleware('can:manage_roles')->group(function(){
        Route::get('/', 'admin\RoleController@index')->name('admin.papeis');
        Route::get('adicionar', 'admin\RoleController@create')->name('admin.papeis.adicionar');
        Route::post('salvar', 'admin\RoleController@store')->name('admin.papeis.salvar');
        Route::get('editar/{id}', 'admin\RoleController@edit')->name('admin.papeis.editar');
        Route::put('editar/{id}', 'admin\RoleController@update')->name('admin.papeis.atualizar');
        Route::get('excluir/{id}', 'admin\RoleController@destroy')->name('admin.papeis.excluir');
        Route::get('permissoes/{id}', 'admin\RoleController@show')->name('admin.papeis.permissoes');
        Route::post('permissoes/{id}', 'admin\RoleController@storePermission')->name('admin.papeis.salvarPermissao');
        Route::put('atualizar/{id}', 'admin\RoleController@updatePermissions')->name('admin.papeis.atualizarPermissoes');
    });
});
