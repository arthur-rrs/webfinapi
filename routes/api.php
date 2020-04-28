<?php

use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreUserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

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

$resources = [
    'accounts' => 'AccountController',
    'categories' => 'CategoryController',
    'transactions' => 'TransactionController',
];
Route::middleware('auth:api')->group(function() use($resources) {
    Route::apiResources($resources);
    Route::get('/myaccounts', 'AccountController@allAccountsOfUser');
    Route::get('/transactions/{start}/{end}', 'TransactionController@transactionsByPeriod');
});

Route::post('/user', 'AuthController@store');

Route::post('/login', 'AuthController@login');