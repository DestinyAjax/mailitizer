<?php

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
Route::group(['middleware'=>['auth']], function(){
    Route::get('/', 'SubscribersController@indexDashboard');

    Route::post('/send','EmailController@send');
    Route::get('/subscribers', 'SubscribersController@index');
    Route::post('/add-subscribers', 'SubscribersController@store');
    Route::post('/upload-subscribers', 'SubscribersController@uploadSubscribers');
    Route::get('/lists', 'SubscribersController@listIndex');
    Route::post('/add-list', 'SubscribersController@storeList');

    //settings
    Route::get('/settings', 'SettingsController@index');
    Route::patch('/update-settings', 'SettingsController@update');
});

Auth::routes();

Route::get('/logout', function(){
    auth()->logout();
    return redirect(url('/login'));
});
