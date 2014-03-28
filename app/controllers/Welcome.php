<?php

use Carbon\Carbon;

class Welcome extends \BaseController {


    public function handleFormAction()
    {
        if (Request::isMethod('post')) {

            // Validation rules
            $rules = array(
                'name' => array('required', 'alpha')
            );

            // check all the fields are valid
            $validator = Validator::make(Input::all(), $rules);
            if ($validator->fails()) {
                return Redirect::route('testForm')->withInput()->withErrors($validator);
            }

            // They are, so update the model
            $bear = Bear::find(1);
            $bear->name = Input::get('name');
            $bear->votes++;
            $bear->save();

            // and redirect back
            return Redirect::route('testForm');
        }

        // get the data to show the form
        $all = Bear::all();
        $edit = Bear::find(1);
        $opp = Opportunities::find(14);
        $created = new Carbon($opp->Created);
        return View::make('Form', array(
            'name'=>'For example',
            'bears' => $all,
            'bear'=>$edit,
            'Opp'=>$opp,
            'When'=>$created));
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
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
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