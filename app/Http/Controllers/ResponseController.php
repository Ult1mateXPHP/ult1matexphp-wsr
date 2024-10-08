<?php

namespace App\Http\Controllers;

class ResponseController extends Controller
{
    public function __construct()
    {
        //...
    }

    public static function success(array $return) {
        return response()->json($return);
    }

    public static function login_failed() {
        return response()->json([
            'message' => 'Login failed'
        ], 403);
    }

    public static function forbidden() {
        return response()->json([
            'message' => 'Forbidden for you'
        ], 403);
    }

    public static function not_found() {
        return response()->json([
            'message' => 'Not found'
        ], 403);
    }

    public static function validation_failed(array $error_message) {
        return response()->json([
            'success' => false,
            'message' => [
                $error_message
            ]
        ], 422);
    }
}
