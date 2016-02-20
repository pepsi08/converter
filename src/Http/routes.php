<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {

    Route::get('/', 'ivanchenko\converter\http\controllers\CurrencyController@index');

    Route::post('/validate/currency', [
        'as' => 'validate-currency',
        'uses' => 'ivanchenko\converter\http\controllers\CurrencyController@validateCurrency'
    ]);

    Route::post('/converter', [
        'as' => 'converter',
        'uses' => 'ivanchenko\converter\http\controllers\CurrencyController@index'
    ]);

});
