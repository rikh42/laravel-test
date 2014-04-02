<?php

namespace app\controllers;

use app\forms\BearFormListener;
use app\forms\BearFormUpdater;
use app\models\Bear;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;



class Welcome extends BaseController implements BearFormListener {

    /** @var  BearFormUpdater */
    protected $formUpdater;

    public function __construct(BearFormUpdater $formUpdater)
    {
        $this->formUpdater = $formUpdater;
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
        $bear = Bear::find($id);
        return $this->formUpdater->update($this, $bear, ['name'=>Input::get('name')]);
    }


    /**
     * @param $errors
     * @return mixed
     */
    public function BearFormUpdateFailed($errors)
    {
        return Redirect::back()->withInput()->withErrors($errors);
    }


    /**
     * @param Bear $bear
     * @return mixed
     */
    public function BearFormUpdateWorked(Bear $bear)
    {
        return Redirect::back();
    }

}