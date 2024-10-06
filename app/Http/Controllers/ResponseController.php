<?php

namespace App\Http\Controllers;

//use

class ResponseController extends Controller
{
    public function __construct()
    {
        //...
    }

    public function success() {
        //200
    }

    public function login_failed() {
        //403
    }

    public function forbidden() {
        //403
    }

    public function not_found() {
        //404
    }

    public function validation_failed() {
        //422
    }
}
