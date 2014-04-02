<?php
/**
 * BearFormUpdater.php
 * Created by Rik on 02/04/2014 
 */

namespace app\forms;
use app\models\Bear;
use Validator;

class BearFormUpdater {

    // Validation rules
    protected $rules = [
        'name' => ['required', 'alpha']
    ];

    public function update(bearFormListener $listener, Bear $bear, $input)
    {
        // check all the fields are valid
        $validator = Validator::make($input, $this->rules);
        if ($validator->fails()) {
            return $listener->bearFormUpdateFailed($validator->errors());
        }

        // They are, so update the model
        $bear->name = $input['name'];
        $bear->votes++;
        $bear->save();

        return $listener->bearFormUpdateWorked($bear);
    }
}

