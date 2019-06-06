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

Route::get('/', 'Hellocontroller@form');
Route::post('/post','Hellocontroller@post');
Route::post('/complete','Hellocontroller@complete');

/* Salescontroller ルート情報 */
Route::get('/login','LoginController@index');
Route::post('/login','LoginController@login');
Route::post('/input','InputController@input');
Route::get('/input','InputController@input');
Route::post('/comfir','InputController@comfir');
Route::get('/comfir','InputController@comperr');
Route::post('/comp','InputController@comp');
Route::get('/menu','MenuController@menu');
Route::get('/data_input','SalesController@data_index');
Route::post('/data_input','SalesController@data_input');
Route::post('/data_comfir','SalesController@data_comfir');
Route::post('/data_comp','SalesController@data_comp');
Route::get('/claim_comfir','ClaimController@claim_comfir');
Route::post('/claim_fix','ClaimController@claim_fix');
Route::get('/claim_fix2','ClaimController@claim_fix2');
Route::get('/claim_fix3','ClaimController@claim_fix3');
Route::get('/claim_fix4','ClaimController@claim_fix4');
Route::post('/claim_comp2','ClaimController@claim_comp2');
Route::post('/claim_comp3','ClaimController@claim_comp3');
Route::post('/claim_comp4','ClaimController@claim_comp4');
Route::get('/output','SalesController@output');
Route::post('/output_comfir','SalesController@output_comfir');
Route::get('/output_execu','SalesController@output_execu');
Route::get('/output_export','SalesController@output_export');