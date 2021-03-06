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

Route::group(['before' => 'auth'], function()
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

    Route::get('profile/load/{social}',
              ['as'   => 'profile.load',
               'uses' => 'Karma\Controllers\AuthController@loadProfile']);

    /*
     * Friendships
     */
    Route::get('friends',
              ['as'   => 'friends.my',
               'uses' => 'Karma\Controllers\FriendController@allMy']);

    Route::get('friends/{user}',
              ['as'   => 'friends',
               'uses' => 'Karma\Controllers\FriendController@all']);

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
     * Library
     */
    Route::resource('library', 'Karma\Controllers\LibraryController');
    Route::get('audio/{user}', 'Karma\Controllers\LibraryController@userAudio');

    /*
     * Search
     */
    Route::get('search/people',
              ['as'   => 'search.people',
               'uses' => 'Karma\Controllers\SearchController@searchForPeople']);

    Route::get('search/music',
              ['as'   => 'search.music',
               'uses' => 'Karma\Controllers\SearchController@searchForMusic']);

    Route::get('search/deezer',
              ['as'   => 'search.deezer',
              'uses' => 'Karma\Controllers\SearchController@searchDeezer']);

    Route::get('search',
              ['as' => 'search.index',
              'uses' => 'Karma\Controllers\SearchController@index']);

    Route::get('search/artist/{id}',
              ['as' => 'search.artist',
              'uses' => 'Karma\Controllers\SearchController@artistPage']);

    /*
     * Music import
     */
    Route::get('importTrack/{id}',
              ['as'   => 'import.track',
               'uses' => 'Karma\Controllers\ImportController@importTrack']);

    Route::get('importFromDeezerAlbum/{id}',
              ['as'   => 'import.albumFromDeezer',
               'uses' => 'Karma\Controllers\ImportController@importFromDeezerAlbum']);

    Route::get('importTrackFromDeezer/{id}',
              ['as'   => 'import.trackFromDeezer',
               'uses' => 'Karma\Controllers\ImportController@importTrackFromDeezer']);

    Route::get('import/{provider}',
              ['as'   => 'import.provider',
               'uses' => 'Karma\Controllers\ImportController@import']);

    Route::get('import',
              ['as'   => 'import',
               'uses' => 'Karma\Controllers\ImportController@index']);

    Route::post('import/select/{provider}',
               ['as'  => 'import.select',
               'uses' => 'Karma\Controllers\ImportController@importSelect']);

    Route::get('sync',
              ['as'   => 'import.sync',
               'uses' => 'Karma\Controllers\ImportController@sync']);

    /*
     * Notifications
     */
    Route::get('notifications',
              ['before' => 'ajax-only',
               'as'   => 'notify.check',
               'uses' => 'Karma\Controllers\NotificationController@checkForNew']);

    Route::match(['POST', 'PUT', 'PATCH'],
               'notifications',
              ['before' => 'ajax-only',
               'as'   => 'notify.check',
               'uses' => 'Karma\Controllers\NotificationController@checkNotifications']);

    /*
     * Feed
     */

    Route::resource('feed', 'Karma\Controllers\FeedController');

    /*
     * Messages
     */

    Route::get('messages/',
              ['as' => 'chat.index',
              'uses' => 'Karma\Controllers\ChatController@index']);

    Route::get('messages/{id}',
              ['as' => 'chat.chat',
              'uses' => 'Karma\Controllers\ChatController@chatWithUser']);

    Route::get('messages/history/{user}',
              ['as' => 'chat.history',
              'uses' => 'Karma\Controllers\ChatController@getHistory']);

    /*
     * Groups
     */
    Route::resource('groups', 'Karma\Controllers\GroupController');
    Route::get('genreGroup/{genreId}', 'Karma\Controllers\GroupController@selectedGenre');

    /*
     * Rating
     */
    Route::match(['post', 'put', 'patch'],
                  'rate',
                 ['as'   => 'rate.rate',
                  'uses' => 'Karma\Controllers\RatingController@rate']
    );

    Route::get('rates/',
              ['as'   => 'rate.all',
               'uses' => 'Karma\Controllers\RatingController@loadRates']
    );

});

/*
 * Homepage
 */
Route::get('/', ['as' => 'home', 'uses' => 'Karma\Controllers\MainController@index']);
Route::get('about', 'Karma\Controllers\MainController@about');
Route::get('rights', 'Karma\Controllers\MainController@rights');
