<?php
/**
 * Created by PhpStorm.
 * User: Rik
 * Date: 30/04/2014
 * Time: 12:20
 */

namespace app\forms;


use Illuminate\Support\MessageBag;


/**
 * Class FormValidationException
 * @package app\forms
 */
class FormValidationException extends \Exception {

    /**
     * @var \Illuminate\Support\MessageBag
     */
    protected $errors;



    /**
     * @param string $message
     * @param MessageBag $errors
     */
    function __construct($message, MessageBag $errors)
    {
        $this->errors = $errors;

        parent::__construct($message);
    }



    /**
     * @return MessageBag
     */
    public function getErrors(){
        return $this->errors;
    }


} 