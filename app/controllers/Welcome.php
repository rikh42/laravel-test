<?php

use Carbon\Carbon;

interface bearFormListener {
    public function bearFormFailed($errors);
    public function bearFormWorked();
}

class bearFormUpdater {

    // Validation rules
    protected $rules = ['name' => ['required', 'alpha']];

    public function update(bearFormListener $listener, $bear, $input)
    {
        // check all the fields are valid
        $validator = Validator::make($input, $this->rules);
        if ($validator->fails()) {
            return $listener->bearFormFailed($validator->errors());
        }

        // They are, so update the model
        $bear->name = $input['name'];
        $bear->votes++;
        $bear->save();
        
        return $listener->bearFormWorked($bear);
    }
}


class Welcome extends \BaseController implements bearFormListener {

    /** @var  bearFormUpdater */
    protected $formUpdater;

    public function __construct(bearFormUpdater $formUpdater)
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
        return $this->formUpdater->update($this, Bear::find($id), ['name'=>Input::get('name')]);
    }

    public function bearFormFailed($errors)
    {
        return Redirect::back()->withInput()->withErrors($errors);
    }

    public function bearFormWorked()
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