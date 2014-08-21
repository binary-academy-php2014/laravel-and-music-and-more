<?php

/*
 * Models
 */
Route::model('user', 'Karma\Entities\User');

/*
 * Auth stuff
 */
Route::get('login/{provider}', 
          ['as'   => 'auth.login',
           'uses' => 'Karma\Controllers\AuthController@login']);

Route::get('login/{provider}/callback',
          ['as'   => 'auth.login.callback',
           'uses' => 'Karma\Controllers\AuthController@callback']);

Route::get('logout',
          ['as'   => 'auth.logout',
           'uses' => 'Karma\Controllers\AuthController@logout']);

Route::get('user/{social}',
           'Karma\Controllers\AuthController@loadProfile');

Route::group(array('before' => 'auth'), function()
{

    
    /*
     * Profile
     */
    Route::get('profile',
              ['as'   => 'profileIndex',
               'uses' => 'Karma\Controllers\ProfileController@index']);
    
    Route::get('profile/{user}',
              ['as'   => 'profile',
               'uses' => 'Karma\Controllers\ProfileController@show']);
    
    Route::get('import',
              ['as'   => 'import',
               'uses' => 'Karma\Controllers\ImportController@index']);

    /*
     * Friendships
     */
    Route::get('friends',
              ['as'   => 'friends.my',
               'uses' => 'Karma\Controllers\FriendController@getAllMy']);

    Route::get('friends/requests',
              ['as'   => 'friends.requests',
               'uses' => 'Karma\Controllers\FriendController@getRequests']);

    Route::get('friends/{user}',
              ['as'   => 'friends',
               'uses' => 'Karma\Controllers\FriendController@getAll']);

    Route::get('friends/add/{user}',
              ['as'   => 'friends.add',
               'uses' => 'Karma\Controllers\FriendController@add']);

    Route::get('friends/cancel/{user}',
              ['as'   => 'friends.cancel',
               'uses' => 'Karma\Controllers\FriendController@cancel']);

    Route::get('friends/confirm/{user}',
              ['as'   => 'friends.confirm',
               'uses' => 'Karma\Controllers\FriendController@confirm']);

    Route::get('friends/delete/{user}',
              ['as'   => 'friends.delete',
               'uses' => 'Karma\Controllers\FriendController@delete']);

    Route::get('friends/restore/{user}',
              ['as'   => 'friends.restore',
               'uses' => 'Karma\Controllers\FriendController@restore']);

    /*
     * Some other stuff
     */
    Route::get('connect/{provider}',
              ['as'   => 'auth.connect',
               'uses' => 'Karma\Controllers\AuthController@connect']);
    
    Route::get('connect/{provider}/callback',
              ['as'   => 'auth.connect.callback',
               'uses' => 'Karma\Controllers\AuthController@callbackConnect']);
    
    /*
     * Music import
     */
    Route::get('import/{provider}', 
              ['as'   => 'import.provider',
               'uses' => 'Karma\Controllers\ImportController@import']);

    Route::get('import',
              ['as'   => 'import',
               'uses' => 'Karma\Controllers\ImportController@index']);

    Route::post('import/select/{provider}',
               ['as'  => 'import.select',
               'uses' => 'Karma\Controllers\ImportController@importSelect']);

});

/*
 * Homepage
 */
Route::get('/', ['as' => 'home', 'uses' => 'Karma\Controllers\MainController@index']);
Route::get('about', 'Karma\Controllers\MainController@about');
Route::get('rights', 'Karma\Controllers\MainController@rights');
