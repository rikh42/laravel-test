<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('hello/{name?}', function($name = 'world')
{
    // Create a bear...
    $bear = new Bear;
    $bear->name = $name;
    $bear->votes = 1;
    $bear->save();

    $all = Bear::all();
    return View::make('world', array('name'=>$name, 'bears' => $all));
})->where('name', '[a-zA-Z]+');


Route::get('bears/{id}', array('as'=>'editBear', 'uses'=>'app\controllers\Welcome@edit'))->where('id', '[0-9]+');
Route::post('bears/{id}', array('as'=>'updateBear', 'uses'=>'app\controllers\Welcome@update', 'before'=>'csrf'))->where('id', '[0-9]+');

