<?php
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

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

Route::group(['as' => 'backend.', 'prefix' => 'backend'],function () {
    //登入
	Route::get('/login', [Controllers\Backend\LoginController::class, 'index'])->name('login')->middleware(['guest:admin']);
	Route::post('/login', [AuthenticatedSessionController::class, 'store'])
		->middleware(array_filter([
			'guest:admin']));

    Route::group(['middleware' => ['auth:admin', 'user.status', 'verified']],function () {
        Route::get('/home/dashboard', [Controllers\Backend\DashboardController::class, 'index'])->name('dashboard');

		//後台登出
		Route::post('/logout', [Controllers\AuthController::class, 'logout'])->name('logout');
        //修改密碼
        Route::resource('/edit_password', Controllers\Backend\AuthController::class);

        //操作紀錄
        Route::resource('/audits', Controllers\Backend\AuditController::class);

        Route::group(['prefix' => 'users_setting'],function () {
            //新增管理員
            Route::resource('/users', Controllers\Backend\UserController::class);
            Route::put('/users/status/{user}', [Controllers\Backend\UserController::class, 'status'])->name('users.status');
            //角色
            Route::get('/roles/select', [Controllers\Backend\RoleController::class, 'select'])->name('roles.select');
            Route::resource('/roles', Controllers\Backend\RoleController::class);
        });

        Route::post('/tmp_files', [Controllers\Backend\TmpFileController::class, 'store'])->name('tmp_files.store');
        Route::delete('/tmp_files', [Controllers\Backend\TmpFileController::class, 'destroy'])->name('tmp_files.destroy');

        Route::post('/upload', [Controllers\Backend\UploadController::class, 'store'])->name('upload.store');
        Route::delete('/upload', [Controllers\Backend\UploadController::class, 'destroy'])->name('upload.destroy');
    });
});
