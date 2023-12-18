<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use Illuminate\Auth\Events\Logout;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PermissionController;

/**
 * Rota principal chama o ControllerHome
 */
Route::get('/', [HomeController::class, 'index'])->name('home');

/**
 * Configuro as rotas relacionadas ao sistema de login
 */
Route::controller(LoginController::class)->group(function() {
    Route::get('login', 'index')->name('login.index');
    Route::post('login', 'trylogin')->name('login.trylogin');
    Route::get('logout', 'destroy')->name('login.destroy');
});

/**
 * Configura a rota /user/ com o Middleware que vai verificar
 * se aém de logado ele tem nivel de acesso "user"
 */
Route::middleware(['user'])->group(function () {
    Route::get('/user', function () {
        return view('user/home');
    })->name('user.dashboard');
});

/**
 * Configura as rotas que vão gerenciar as funções do usuario, como, manter produtos
 * manter categorias e manter marcas. Uso middleware que vai verificar se ele está logado e tem nivel
 * de 'user'e também vai verificar se ele possui a permissão necessária para acessar a funcionalidade.
 *
 * Exemplo: ele acessa, /user/manage_categories, além de estar logado e ser nivel acesso "user", ele
 * deverá ter permissão cadastrada para gerenciar categorias "manage_categories"
 */
Route::middleware(['user', 'check.permission:manage_categories'])->group(function () {
    Route::get('/user/manage_categories', function () {
        return view('/user/manage_category');
    })->name('user.manage_categories');
});

Route::middleware(['user', 'check.permission:manage_brands'])->group(function () {
    Route::get('/user/manage_brands', function () {
        return view('user/manage_brand');
    })->name('user.manage_brands');
});

Route::middleware(['user', 'check.permission:manage_products'])->group(function () {
    Route::get('/user/manage_products', function () {
        return view('user/manage_product');
    })->name('user.manage_products');
});

/**
 * Configura a rota /admin/ com o Middleware que vai verificar
 * se alem de logado ele tem nivel de acesso "admin"
 */
Route::middleware(['admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin/home');
    })->name('admin.dashboard');

    /**
     * Rota responsavel pela listagem de usuarios
     */
    Route::get('/admin/manage_users', [AdminController::class, 'manageUsers'])->name('admin.manage_users');

    /**
     * Rotas responsaveis pela criação de novos usuarios
     */
    Route::get('/admin/create_users', [AdminController::class, 'index'])->name('admin.create_users');

    Route::post('/admin/create_users', [AdminController::class, 'createUsers'])->name('admin.try_create_users');

    /**
     * Rotas responsaveis pela edição usuarios
     */
    Route::get('/admin/manage_users/{id}', [AdminController::class, 'editUsers'])->name('admin.edit_users');

    Route::put('/admin/manage_users/{id}/basic-info', [AdminController::class, 'execEditUsers'])->name('admin.exec_edit_users');

    /**
     * Rota responsável por excluir usuarios
     */
    Route::delete('/admin/manage_users/{id}/delete', [AdminController::class, 'deleteUser'])->name('admin.delete_users');



    /**
     * Rotas responsáveis pela edição de permissões
     */
    Route::get('/admin/manage_permissions', [PermissionController::class, 'index'])->name('admin.manage_permissions');

    Route::get('/admin/manage_permissions/{id}', [PermissionController::class, 'edit'])->name('admin.edit_permissions');

    Route::post('/admin/update_permissions/{id}/exec', [PermissionController::class, 'update'])->name('admin.exec_edit_permissions');

});
