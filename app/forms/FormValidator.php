<?php
/**
 * Created by PhpStorm.
 * User: Rik
 * Date: 30/04/2014
 * Time: 12:02
 */

namespace app\forms;



use Illuminate\Validation\Factory as Validator;


/**
 * Class Form
 * @package app\forms
 */
abstract class FormValidator {


    /**
     * @var Validator
     */
    protected $validator;


    /**
     * @var \Illuminate\Validation\Validator
     */
    protected $validation;


    /**
     * @param Validator $validator
     */
    function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }


    /**
     * @param array $formData
     * @return bool
     * @throws FormValidationException
     */
    public function validate(array $formData)
    {
        // Create the validation object
        $this->validation = $this->validator->make($formData, $this->getValidationRules());

        // If the form data fails to validate, throw an exception
        if ($this->validation->fails()) {
            throw new FormValidationException('Validation Failed', $this->getValidationErrors());
        }

        // All is well. Should this return a bool AND throw exceptions. Pick one.
        return true;

    }



    /**
     * Gets the MessageBag array with all the validation errors in it.
     * @return \Illuminate\Support\MessageBag
     */
    protected function getValidationErrors()
    {
        return $this->validation->errors();
    }


    /**
     * Up to derived classes to provide an implementation for this. It should return an array of
     * the validation rules to use for the form.
     * @return mixed
     */
    abstract protected function getValidationRules();

}