<?php
/**
 * Created by PhpStorm.
 * User: Rik
 * Date: 30/04/2014
 * Time: 12:26
 */

namespace app\forms;


/**
 * Class Bear
 * @package app\forms
 */
class Bear extends FormValidator {


    /**
     * @return mixed
     */
    protected function getValidationRules()
    {
        return [
            'name' => ['required', 'alpha']
        ];
    }
}