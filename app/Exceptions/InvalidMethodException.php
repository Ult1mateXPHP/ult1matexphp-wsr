<?php

namespace App\Exceptions;

use Exception;

class InvalidMethodException extends Exception
{
    public function render() {
        return "Неизвестный метод";
    }
}
