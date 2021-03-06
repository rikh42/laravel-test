<?php

namespace app\models;
use Eloquent;


class Opportunities extends Eloquent {

    protected $table = 'Opportunities';


    // MASS ASSIGNMENT -------------------------------------------------------
    // define which attributes are mass assignable (for security)
    // we only want these 3 attributes able to be filled
    protected $fillable = array('name', 'votes');
}


