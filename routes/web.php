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

Route::get('/', 'MainController@index');
Route::get('/about', 'MainController@about');
Route::get('/services', 'MainController@services');

//Papers Routes
Route::resource('papers', 'PapersController');
Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/download/{filename}', function($filename){
        
    $filename1 = strtolower($filename) ;
    $exts = explode(".", $filename1) ;
    $n = count($exts)-1;
    $exts = $exts[$n];
    if($exts == 'txt'){
        $headers = [
            'Content-Type' => 'text/plain',
         ]; 
    } else{
        $headers = [
            'Content-Type' => 'application/pdf',
         ];
    }
         return Storage::download('public/cover/'.$filename, $filename  , $headers);
});

Route::get('/searches/title', 'SearchesController@title');
Route::get('/searches/titleResult', 'SearchesController@titleHandler');
Route::get('/searches/author', 'SearchesController@author');
Route::get('/searches/authorResult', 'SearchesController@authorHandler');
Route::get('/searches/keywords', 'SearchesController@keywords');
Route::get('/searches/keywordsResult', 'SearchesController@keywordsHandler');
Route::get('/searches/advanced', 'SearchesController@advanced');
Route::get('/searches/advancedsResult', 'SearchesController@advancedHandler');

Route::get('profile/{name}', 'MainController@profile');
Route::get('editprofile/{id}', 'MainController@editProfile');

Route::get('feed/{userid}', 'MainController@feed'); 
Route::get('follow/{myId}/{hisId}', 'MainController@follow');
Route::get('unfollow/{myId}/{hisId}', 'MainController@unfollow');

Route::resource('users','UsersController');
Route::get('/searches/livesearch.php','MainController@livesearch');
