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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
//Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');


/*
 * Commercials
 */
Route::resource('commercials', 'CommercialController');
Route::get('all-commercials', 'CommercialController@all_commercials')->name('all-commercials');


/*
 * Agency
 */
Route::resource('agency', 'AgencyController');
Route::get('all-agencies', 'AgencyController@all_agencies')->name('all-agencies');
Route::get('delete-agencies', 'AgencyController@delete_agencies')->name('delete-agencies');



/*
 * Preferences
 */
Route::resource('preferences', 'PreferenceController');


/*
 * TaxController
 */
Route::resource('taxes', 'TaxController');
Route::get('delete-tax','TaxController@delete_tax')->name('delete-tax');

/*
 * Radio stations
 */
Route::resource('radio-stations', 'RadioStationController');


/*
 * Users Route
 */
Route::resource('users', 'UserController');
Route::get('all-users', 'UserController@all_users')->name('all-users');
Route::get('delete-users', 'UserController@delete_users')->name('delete-users');

/*
 * Users Route
 */
Route::resource('adverts', 'AdvertController');
Route::get('all-adverts', 'AdvertController@all_adverts')->name('all-adverts');
Route::get('delete-adverts', 'AdvertController@delete_advert')->name('delete-advert');


/**
 * Orders
 */
Route::resource('orders', 'OrderController');
Route::get('all-orders', 'OrderController@all_orders')->name('all-orders');
Route::get('delete-orders', 'OrderController@delete_orders')->name('delete-orders');
Route::get('filter-adverts', 'OrderController@filterAdverts')->name('filter-adverts');
Route::get('filter-agencies', 'OrderController@filterAgencies')->name('filter-agencies');


/**
 * Programs
 */
Route::resource('programs', 'ProgramController');
Route::get('all-programs', 'ProgramController@allPrograms')->name('all-programs');
Route::post('delete-programs', 'ProgramController@deletePrograms')->name('delete-programs');
Route::post('upload-programs', 'ProgramController@uploadPrograms')->name('upload-programs');
