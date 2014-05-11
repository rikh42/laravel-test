<?php
namespace app\controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;

/**
 * Class UserController
 * @package app\controllers
 */
class UserController extends BaseController {


    /**
     * Show the sign in form
     *
     * @return mixed
     */
    public function signInForm()
    {
        // render the template
        return View::make('user.signin');
    }

    /**
     * Attempt to sign in - responds to the sign in form POST
     * @return mixed
     */
    public function signIn()
    {
        // Try and sign in, and return to the home page if we did
        if (Auth::attempt(Input::only('email', 'password'), true)) {
            return Redirect::home();
        }

        // Failed to sign in. Go back.
        return Redirect::back();
    }

    /**
     * Sign the user out
     *
     * @return mixed
     */
    public function signOut()
    {
        // Log the user out
        Auth::logout();

        // go to the home page
        return Redirect::home();
    }
}