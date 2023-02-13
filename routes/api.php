<?php

use App\Http\Controllers\SpendIncomeCategoryController;
use App\Http\Controllers\SpendIncomeRecordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return response()->json($request->user());
});

// Route::middleware('auth:sanctum')->controller(LoginController::class)->group(function(){
//     Route::post('/login', 'authenticate')->name('login');
// });

Route::apiResources([
    'users' => UserController::class
]);

// Route::post('/auth/login', [LoginController::class, 'authenticate']);

Route::middleware('auth:sanctum')->get('/test', function(){
    return response()->json(['fda' => 'ds']);
});

Route::middleware('auth:sanctum')->apiResource('/categories', SpendIncomeCategoryController::class);
Route::middleware('auth:sanctum')->apiResource('/records', SpendIncomeRecordController::class);