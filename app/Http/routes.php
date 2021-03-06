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
use \App\User;

Route::get('/', function () {
  return 'Estamos pra Uso!!!:)';
});




Route::group(['prefix' => 'api' , 'middleware' => 'cors'], function(){

  Route::post('/teste', function(Request $request) {
    $socketClient = new \App\Realtime\Events;
    $socketClient->test();
    return Request::input('message');
  });

  // Route::resource('authenticate', 'AuthenticateController', ['only' => ['index']]);
  Route::post('authenticate', 'AuthenticateController@authenticate');
  Route::post('register', 'AuthenticateController@register');
  Route::post('forgot-pass', 'AuthenticateController@reset');


  //Prefix /user
  Route::group(['prefix' => 'user'], function(){
    Route::get('profile','ProfileController@getUserProfile');
    Route::put('profile', 'ProfileController@updateUserProfile');
    Route::post('profile/update_picture', 'ProfileController@updateUserPicture');
  });


  Route::get('profile', 'ProfileController@index');
  Route::get('profile/{id}', 'ProfileController@show');
    /**
    * Posts
    **/
  Route::get('users', 'UserController@index');
  Route::post('user-pass', 'UserController@reset');


   /**
   * Posts
   **/
  Route::get('posts', 'PostController@index');
  Route::post('posts', 'PostController@store');
  Route::delete('posts/{id}', 'PostController@destroy');

   /**
   * FriendRequest
   */
  Route::get('/friend-requests', 'FriendRequestController@index');
  Route::post('/friend-requests', 'FriendRequestController@store');
  Route::delete('/friend-requests/{userId}', 'FriendRequestController@destroy');

  /**
  * Friends
  */
  Route::get('/friends', 'FriendController@index');
  Route::post('/friends', 'FriendController@store');
  Route::delete('/friends/{userId}', 'FriendController@destroy');










});



//
// Route::group(['prefix'=>'user'], function(){
//
//     Route::get('', ['uses' => 'UserController@allUsers']);
//
//     Route::get('{id}', ['uses' => 'UserController@getUser']);
//
// //    Route::post('', function(){});
// //    Route::put('{id}', function($id){});
// //    Route::delete('{id}', function($id){});
//
// });







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
    //
});
