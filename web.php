<?php

use Illuminate\Support\Facades\Route;
use da;
use routes;

//引用 ListController 控制器
use App\Http\Controllers\Admin\Member\ListController;

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
    return view('welcome');
});

//增删查改
Route::get('member_add', [ListController::class, 'memberAdd']);
Route::get('member_del', [ListController::class, 'memberDel']);
Route::get('member_get', [ListController::class, 'memberGet']);
Route::get('member_update', [ListController::class, 'memberUpdate']);
Route::get('member_sql', [ListController::class, 'memberSql']);

//列表
Route::get('member_list', [ListController::class, 'memberList']);

//登录
Route::post('member_login', [ListController::class, 'memberLogin'])->name("login");

//增删查改(AR模式) 
Route::get('member_model_add', [ListController::class, 'memberModelAdd']);
Route::get('member_model_del', [ListController::class, 'memberModelDel']);
Route::get('member_model_get', [ListController::class, 'memberModelGet']);
Route::get('member_model_update', [ListController::class, 'memberModelUpdate']);

//增加(AR模式) 批量赋值
Route::post('member_model_create', [ListController::class, 'memberModelCreate']);

