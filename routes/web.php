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
  if (date('Y-m-d') >= '2019-12-15'){
      return view('welcome1');
  }else{
      return view('auth.login');
  }
});

Auth::routes();
//Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');


/*
 * Commercials
 */
Route::resource('commercials', 'CommercialController');
Route::get('all-commercials', 'CommercialController@allCommercials')->name('all-commercials');
Route::post('filter-programs', 'CommercialController@filterPrograms')->name('filter-programs');

Route::resource('play-commercials', 'PlayCommercial');
/*
 * Agency
 */
Route::resource('agency', 'AgencyController');
Route::get('all-agencies', 'AgencyController@all_agencies')->name('all-agencies');
Route::get('delete-agencies', 'AgencyController@delete_agencies')->name('delete-agencies');
Route::get('search-agencies', 'AgencyController@search_agencies')->name('search-agencies');



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
Route::post('delete-radio-stations', 'RadioStationController@deleteRadioStation')->name('delete-radio-stations');

/*
 * Users Route
 */
Route::resource('users', 'UserController');
Route::get('all-users', 'UserController@all_users')->name('all-users');
Route::get('delete-users', 'UserController@delete_users')->name('delete-users');
Route::get('export-users', 'UserController@export')->name('export-users');
Route::get('search-users', 'UserController@search_users')->name('search-users');

/*
 * Users Route
 */
Route::resource('adverts', 'AdvertController');
Route::get('all-adverts', 'AdvertController@all_adverts')->name('all-adverts');
Route::get('delete-adverts', 'AdvertController@delete_advert')->name('delete-advert');
Route::get('search-adverts', 'AdvertController@search_adverts')->name('search-adverts');

/**
 * Orders
 */
Route::resource('orders', 'OrderController');
Route::get('all-orders', 'OrderController@all_orders')->name('all-orders');
Route::get('delete-orders', 'OrderController@delete_orders')->name('delete-orders');
Route::get('filter-adverts', 'OrderController@filterAdverts')->name('filter-adverts');
Route::get('filter-agencies', 'OrderController@filterAgencies')->name('filter-agencies');
Route::get('search-orders', 'OrderController@searchOrders')->name('searchOrders');


/**
 * Programs
 */
Route::resource('programs', 'ProgramController');
Route::get('all-programs', 'ProgramController@allPrograms')->name('all-programs');
Route::post('delete-programs', 'ProgramController@deletePrograms')->name('delete-programs');
Route::post('upload-programs', 'ProgramController@uploadPrograms')->name('upload-programs');
Route::get('search-programs', 'ProgramController@searchPrograms')->name('search-programs');
Route::get('filter-programs', 'ProgramController@filterPrograms')->name('filter-programs');


/**
 * Transaction Certificate
 */

Route::resource('tc-s', 'TransmissionCertificateController');
Route::get('filter-tc-orders', 'TransmissionCertificateController@filterOrders')->name('filter-tc-orders');


/*
 * Invoice
 */
Route::resource('invoice','InvoiceController');
Route::get('filter-invoice-orders', 'InvoiceController@filterOrders')->name('filter-invoice-orders');
Route::get('filter-invoice-orders-dec', 'InvoiceController@filterOrderDescription')->name('filter-invoice-orders-dec');
Route::get('print-invoice/{id}', 'InvoiceController@printInvoice')->name('print-invoice');
Route::get('all-invoice', 'InvoiceController@allInvoices')->name('all-invoice');
