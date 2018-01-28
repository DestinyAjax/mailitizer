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
    
    //lists
    Route::get('/lists', 'SubscribersController@listIndex');
    Route::post('/add-list', 'SubscribersController@storeList');
    Route::post('/delete-list','SubscribersController@deleteList');
    
    //templates
    Route::get('/templates', 'TemplatesController@index');
    Route::post('/activate', 'TemplatesController@activateTemplate');

    //settings
    Route::get('/settings', 'SettingsController@index');
    Route::patch('/update-settings', 'SettingsController@update');

    //profile
    Route::get('/profile', 'SettingsController@profileIndex');
    Route::patch('/update-profile', 'SettingsController@profileUpdate');
});

Auth::routes();

Route::get('/logout', function(){
    auth()->logout();
    return redirect(url('/login'));
});
