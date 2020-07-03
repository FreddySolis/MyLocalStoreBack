<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

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


Route::get('enviar',function(){
    Mail::send('emails',[],function($message){
        $message->from('mystorebusiness9@gmail.com','My Store');
        $message->to('julioxddi@gmail.com')->subject('Bienvenid@ a My Store');
    });

    // Mail::send('emails',[], function ($message) {
    //     $message->from('mystorebusiness9@gmail.com', 'Laravel');
    
    //     $message->to('julioxddi@gmail.com')->cc('mystorebusiness9@gmail.com');
    // });

   // return "Enviado con exito";
});


Auth::routes();
Route::resource('products', 'ProductController');
Route::resource('rols', 'RolController');

Route::get('/home', 'HomeController@index')->name('home');


