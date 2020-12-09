<?php

namespace App\Database;

/**
 * Class MeekroDBEval
 *
 * @package \App\Database
 */
class MeekroDBEval {
    public $text = '';

    function __construct($text) {
        $this->text = $text;
    }
}
