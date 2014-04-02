<?php

namespace app\controllers;
use app\controllers\BaseController;
use app\forms\BearFormListener;

use app\forms\BearFormUpdater;
use app\models\Bear;
use app\models\Opportunities;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;



class Welcome extends BaseController implements BearFormListener {

    /** @var  BearFormUpdater */
    protected $formUpdater;

    public function __construct(BearFormUpdater $formUpdater)
    {
        $this->formUpdater = $formUpdater;
    }

    public function edit($id)
    {
        // get the data to show on the edit page
        $viewModel = array(
            'name'=>'For example',
            'bears' => Bear::all(),
            'bear'=>Bear::find($id),
            'Opp'=>Opportunities::find(14),
            'When'=>new Carbon('yesterday'));

        // render the template
        return View::make('Form', $viewModel);
    }

    public function update($id)
    {
        $bear = Bear::find($id);
        return $this->formUpdater->update($this, $bear, ['name'=>Input::get('name')]);
    }

    public function BearFormUpdateFailed($errors)
    {
        return Redirect::back()->withInput()->withErrors($errors);
    }

    public function BearFormUpdateWorked(Bear $bear)
    {
        return Redirect::back();
    }



	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}