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

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect' ]
    ],
    function()
{   
 // все маршруты

Route::get('/', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

// Authentication Routes...
Auth::routes();
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::post('author/find','Library\AuthorController@postFind');
Route::get('author','Library\AuthorController@index');
Route::get('authorsalpha','Library\AuthorController@indexalpha_surname');
Route::get('author/{author}','Library\AuthorController@show');
Route::get('ACategory/{ACategory}','Library\ACategoryController@show');
Route::get('ACategory','Library\ACategoryController@index0');


Route::post('book/find','Library\BookController@postFind');
Route::get('book','Library\BookController@index');
Route::get('booksalphaname','Library\BookController@indexalpha_name');
Route::get('booksalphaauthor','Library\BookController@indexalpha_author');
Route::get('book/{book}','Library\BookController@show');
Route::get('book/{book}/download','Library\BookController@download');
Route::get('BCategory','Library\BCategoryController@index0');
Route::get('BCategory/{BCategory}','Library\BCategoryController@show');


// Library routes for regusers (admin or user)
Route::group([
    'prefix'=>'library/edit',
    'namespace'=>'Library\Edit',
    'middleware'=>'reguser'
    ], function() {

    Route::get('', function() {
        return view('library.edit.index');
    });

    Route::get('book/autocomplete','BookController@autocomplete');
    Route::get('book/{book}/delete','BookController@destroy');
    Route::post('book/find','BookController@postFind');
    Route::resource('book','BookController');

    Route::get('author/autocomplete','AuthorController@autocomplete');
    Route::get('author/{author}/delete','AuthorController@destroy');
    Route::post('author/find','AuthorController@postFind');
    Route::resource('author','AuthorController');

	# Dictionaries

    Route::post('ACategory/parents/{ACategory}','ACategoryController@parents');
    Route::post('ACategory/children/{ACategory}','ACategoryController@children');
    Route::post('ACategory/elements/{ACategory}','ACategoryController@elements');
    Route::get('ACategory/autocomplete','ACategoryController@autocomplete');
    Route::get('ACategory/{ACategory}/delete','ACategoryController@destroy');
    Route::resource('ACategory','ACategoryController');

    Route::post('BCategory/parents/{BCategory}','BCategoryController@parents');
    Route::post('BCategory/children/{BCategory}','BCategoryController@children');
    Route::post('BCategory/elements/{BCategory}','BCategoryController@elements');
    Route::get('BCategory/autocomplete','BCategoryController@autocomplete');
    Route::get('BCategory/{BCategory}/delete','BCategoryController@destroy');
    Route::resource('BCategory','BCategoryController');

    Route::get('PD_template/autocomplete','PD_templateController@autocomplete');
    Route::get('PD_template/{PD_template}/delete','PD_templateController@destroy');
    Route::resource('PD_template','PD_templateController');


});

// Admin routes
Route::group([
    'prefix'=>'admin',
    'namespace'=>'Admin',
    'middleware'=>'admin'
    ], function() {
        
    Route::get('', function() {
        return view('admin.index');
    });
    Route::post('user/find','UserController@postFind');
    Route::resource('user','UserController');
 

});     


});



