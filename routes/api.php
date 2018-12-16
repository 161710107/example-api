<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
 Route::group([
    'middleware' => ['api', 'cors'],
    // 'namespace' => $this->namespace,
    // 'prefix' => 'api',
], function ($router) {
     //Category
	Route::get('category', 'CategoriController@index');
	Route::get('category/{id}', 'CategoriController@show');
	Route::post('category', 'CategoriController@store');
	Route::put('category/{id}', 'CategoriController@update');
	Route::delete('category/{id}', 'CategoriController@destroy');
    Route::post('category/getDataTableJson', 'CategoriesController@getDataTableJson')->name('getDataTableJson');



// Transfer
Route::get('transfer', 'TransferController@index');
Route::get('transfer/{id}', 'TransferController@show');
Route::post('transfer', 'TransferController@store');
Route::put('transfer/{id}', 'TransferController@update');
Route::delete('transfer/{id}', 'TransferController@destroy');

// Event
Route::get('event', 'EventController@index');
Route::get('event/{id}', 'EventController@show');
Route::post('event', 'EventController@store');
Route::put('event/{id}', 'EventController@update');
Route::delete('event/{id}', 'EventController@destroy');

// Bank
Route::get('bank', 'BankController@index');
Route::get('bank/{id}', 'BankController@show');
Route::post('bank', 'BankController@store');
Route::put('bank/{id}', 'BankController@update');
Route::delete('bank/{id}', 'BankController@destroy');

// Master Bank
Route::get('masterbank', 'MasterBankController@index');
Route::get('masterbank/{id}', 'MasterBankController@show');
Route::post('masterbank', 'MasterBankController@store');
Route::put('masterbank/{id}', 'MasterBankController@update');
Route::delete('masterbank/{id}', 'MasterBankController@destroy');



//User
    Route::get('user', 'UserController@index');
    Route::get('user/{id}', 'UserController@show');
    Route::post('user', 'UserController@store');
    Route::put('user/{id}', 'UserController@update');
    Route::delete('user/{id}', 'UserController@destroy');

});
