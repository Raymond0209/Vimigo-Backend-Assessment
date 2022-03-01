<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\ExcelController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [ApiController::class, 'login']);

Route::post('/register', [ApiController::class, 'register']);

Route::middleware('auth:api')->group(function () {
    Route::get('userInfo/{user}', [ApiController::class, 'userInfo']);
    Route::get('users', [ApiController::class, 'users']);
    Route::post('addUser', [ApiController::class, 'addUser']);
    Route::put('updateUser/{user}', [ApiController::class, 'updateUser']);
    Route::delete('deleteUser/{user}', [ApiController::class, 'deleteUser']);
    Route::post('import', [ExcelController::class, 'import']);
});