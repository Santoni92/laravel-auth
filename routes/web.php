<?php

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
/*
Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes([
    'register'=>false,'reset'=>false,'verify'=>false]
); //se voglio disabilitare alcune rotte passo queste ultime come parametro alla routes() sotto forma di array associativo


//Route::get('/home', 'HomeController@index')->name('home');


Route::middleware('auth')   //indico che queste rotte sottostanno al fatto di essere loggati oppure no
->namespace('Admin')
->name('admin.')
->prefix('admin')
->group(function(){ //raggruppo delle rotte sotto il dominio admin
    Route::get('/','HomeController@index')->name('index');   //è la rotta per il dashboard
    Route::resource('posts','PostController');
});


//da mettere in fondo al file web.php
Route::get("{any?}",function(){
    return view('guest.home');
})->where("any",".*");
