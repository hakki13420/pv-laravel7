<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => '', 'middleware' => 'auth'], function () {

    Route::resource('/users', 'UserController');
    Route::resource('/brigades', 'BrigadeController');
    Route::resource('/grades', 'GradeController');
    Route::resource('/communes', 'CommuneController');
    Route::resource('/infractions', 'InfractionController');
    Route::resource('/services', 'ServiceController');
    Route::resource('/exercices', 'ExerciceController');
    Route::resource('/configurations', 'ConfigurationController');

    Route::resource('/activites', 'ActiviteController');
    Route::resource('/activitescom', 'ActivitesComController');
    Route::resource('/adressescom', 'AdressesComController');

    Route::resource('/commercants', 'CommercantController');
    Route::resource('/pvs', 'PvController');
    Route::resource('/modelRedaction', 'ModelRedactionController');
    Route::resource('/typesaisies', 'TypesaisieController');
    Route::resource('/categories', 'CategoryController');
    Route::resource('/products', 'ProductController');



    Route::get('/activitesCom/{commercantId}', 'ActivitesComController@getActivitesCom');
    Route::get('/adressesCom/{commercantId}', 'AdressesComController@getAdressesCom');
    Route::get('/commercantPvs/{id}', 'PvController@getCommercantPvs');
    Route::get('/pvsCreate/{commercant_id}', 'PvController@getCommercantPvs')->name('pvCreate');
    Route::get('/pvsPrint/{pv_id}', 'PvController@printPv')->name('pvPrint');
    Route::get('/modelRedactionInf/{infraction_id}', 'ModelRedactionController@getModelRedactionsInfraction');
    Route::get('/getredactions/{id}', 'PvController@getRedactionModel');

    Route::get('/ordreVerssement/{pv_id}', 'OrdreVerssementController@print')->name('ordrePrint');
    Route::get('/pvSaisie/{pv_id}', 'PvSaisieController@print')->name('PvSaisiePrint');

    Route::get('/tsaisies', 'TsaisieController@index');
});



//by id
Route::get('serviceById/{service_id}', 'ServiceController@getServiceById');
Route::get('brigadeById/{brigade_id}', 'BrigadeController@getBrigadeById');
Route::get('commercantById/{commercant_id}', 'CommercantController@getCommercantById');
Route::get('userById/{user_d}', 'UserController@getUserById');

//searching routes
Route::get('users/search/{q}', 'UserController@search');
Route::get('activites/search/{q}', 'ActiviteController@search');
Route::get('commercants/search/{q}', 'CommercantController@search');
Route::get('pvs/search/{q}', 'PvController@search');
Route::get('infractions/search/{q}', 'InfractionController@search');
Route::get('grades/search/{q}', 'GradeController@search');
Route::get('brigades/search/{q}', 'BrigadeController@search');
Route::get('typesaisies/search/{q}', 'TypesaisieController@search');
Route::get('categories/search/{q}', 'CategoryController@search');
Route::get('products/search/{q}', 'ProductController@search');
Route::get('modelRedactions/search/{q}', 'ModelRedactionController@search');
Route::get('communes/search/{q}', 'CommuneController@search');
Route::get('services/search/{q}', 'ServiceController@search');

//statistique routes
Route::get('statistiques', 'StatistiqueController@getStatistiques');
Route::post('statistiques.between', 'StatistiqueController@getStatistiquesBetween');
Route::post('statistiques.service', 'StatistiqueController@getStatistiquesService');
Route::post('statistiques.operateur', 'StatistiqueController@getStatistiquesOperateur');

//qr code route
//Route::get('qrcode/{pv_id}','QrCodeController@getUrl')->name('qrcode');;


//activities logs routes

Route::get('logs', 'LogActivityController@index');
