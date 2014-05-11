<?php

use app\models\Bear;
use app\models\User;


// Home

Route::get('/', ['as' => 'home', function()
{
	return View::make('home');
}]);



// Users

Route::get( '/signin',   ['as'=>'signin.form',   'uses'=>'app\controllers\UserController@signInForm']);
Route::post('/signin',   ['as'=>'signin',        'uses'=>'app\controllers\UserController@signIn']);
Route::get( '/signout',  ['as'=>'signout',       'uses'=>'app\controllers\UserController@signOut']);




// Experiments

Route::get('hello/{name?}', function($name = 'world')
{
    // Create a bear...
    $bear = new Bear;
    $bear->name = $name;
    $bear->votes = 1;
    $bear->save();

    $all = Bear::all();
    return View::make('world', array('name'=>$name, 'bears' => $all, 'user' => Auth::user()));
})->where('name', '[a-zA-Z]+');


Route::get('bears/{id}', array('as'=>'editBear', 'uses'=>'app\controllers\Welcome@edit'))->where('id', '[0-9]+');
Route::post('bears/{id}', array('as'=>'updateBear', 'uses'=>'app\controllers\Welcome@update', 'before'=>'csrf'))->where('id', '[0-9]+');

