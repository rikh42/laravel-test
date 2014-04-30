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
     * @var
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
        $this->validation = $this->validator->make($formData, $this->getValidationRules());

        if ($this->validation->fails()) {
            throw new FormValidationException('Validation Failed', $this->getValidationErrors());
        }

        return true;

    }



    /**
     * @return mixed
     */
    protected function getValidationErrors()
    {
        return $this->validation->errors();
    }


    /**
     * @return mixed
     */
    abstract protected function getValidationRules();

}