<?php
/**
 * BearFormListener.php
 * Created by Rik on 02/04/2014 
 */

namespace app\forms;
use app\models\Bear;

interface BearFormListener {
    public function bearFormUpdateFailed($errors);
    public function bearFormUpdateWorked(Bear $bear);
}

