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

Auth::routes();


Route::get('/', 'HomeController@index')->name('home');
Route::get('/logout', 'HomeController@logout')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/resetPassword', 'HomeController@cambiarPassword')->name('resetPassword');
Route::post('/resetPassword', 'HomeController@resetPass')->name('resetPass');


Route::get('descargaPdf/{id}', 'AudienciasController@pdf')->name('pdf');
Route::get('planillaEscrito/{id}', 'EscritosController@word')->name('word_escrito');
Route::get('planillaCaso/{id}', 'CasosController@word')->name('word_caso');
Route::get('planillaAudiencia/{id}', 'AudienciasController@word')->name('word_audiencia');


Route::get('profile/{id}', 'UsersController@profile')->name('profile');
Route::get('verAudiencia/{id}', 'AudienciasController@notificar')->name('notificar');



//Route::get('archivo/{id}', 'ApiController@archivo')->name('archivo');



Route::resource('/usuarios','UsersController');
Route::resource('/casos','CasosController');
Route::resource('/expedientes','ExpedientesController');
Route::resource('/audiencias','AudienciasController');
Route::resource('/escritos','EscritosController');
Route::resource('/roles','RolesController');


//Rutas de la API.
Route::prefix('api')->group(function () {
	//Route::resource('/rutas','ApiController@index')->name('rutas');
	Route::post('createProduct', 'ApiController@createProduct')->name('create_product');
    Route::get('searchArticle', 'ApiController@searchArticle')->name('search_article');
    Route::get('searchAudiciones', 'ApiController@searchAudiciones')->name('search_audiciones');

    Route::get('permissions', 'ApiController@permissions')->name('permissions');
    Route::get('getRoleInfo', 'ApiController@getRoleInfo')->name('getRoleInfo');




    
	
});

// //Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});

// //Clear Cache facade value:
Route::get('/clear-cache', function() {
     $exitCode = Artisan::call('cache:clear');
     return '<h1>Cache facade value cleared</h1>';
});

// //View Clear facade value:
Route::get('/view-clear', function() {
     $exitCode = Artisan::call('view:clear');
     return '<h1>View facade value cleared</h1>';
});

// //View cache facade value:
Route::get('/view-cache', function() {
     $exitCode = Artisan::call('view:cache');
     return '<h1>View facade value cache</h1>';
});
