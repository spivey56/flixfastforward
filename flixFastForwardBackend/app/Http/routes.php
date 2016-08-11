<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('admin/intros/index');
});

Route::get("admin/intros/times/{id}",function($id){
    $intros=new \App\Http\Controllers\Admin\IntrosController();
    echo $intros->getStartAndSkipTimes($id);
});

Route::resource('admin/intros', 'Admin\\IntrosController');