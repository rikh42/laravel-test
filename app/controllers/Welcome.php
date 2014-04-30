<?php

namespace app\controllers;

use app\forms\FormValidationException;
use app\models\Bear;
use app\forms\Bear as BearForm;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;



class Welcome extends BaseController {


    protected $bearForm;

    function __construct(BearForm $bearForm)
    {
        $this->bearForm = $bearForm;
    }


    /**
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        // get the data to show on the edit page
        $viewModel = array(
            'name'=>'For example',
            'bears' => Bear::all(),
            'bear'=>Bear::find($id),
            'When'=>new Carbon('yesterday'));

        // render the template
        return View::make('Form', $viewModel);
    }


    /**
     * @param $id
     * @return mixed
     */
    public function update($id)
    {
        try {
            $this->bearForm->validate(Input::all());

            $bear = Bear::find($id);
            $bear->name = Input::get('name');
            $bear->votes++;
            $bear->save();

            return Redirect::back();
        }
        catch (FormValidationException $e) {
            return Redirect::back()->withInput()->withErrors($e->getErrors());
        }

    }



}