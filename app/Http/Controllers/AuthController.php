<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Laravel\Sanctum\Sanctum;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthController extends Controller
{
    /**
     * @method POST
     * @return string|JsonResponse
     */
    public function authorize() : string|JsonResponse
    {
        $credentials = [
            'email' => Request::input('email'),
            'password' => Request::input('password')
        ];

        if(!Auth::validate($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Login failed'
            ], 401);
        }

        $user = Auth::getProvider()->retrieveByCredentials($credentials);
        Auth::login($user);
        $token = Request::user()->createToken('access')->plainTextToken;
        return $token;
    }

    /**
     * @method POST
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function registration()
    {
        $email = Request::input('email');
        $password = Request::input('password');
        $error_message = [];

        if (!empty($email)) {
            $credentials['email'] = $email;
        } else {
            $error_message[] = ['message' => 'email can not be blank'];
        }

        if (!empty($password)) {
            $credentials['password'] = $password;
        } else {
            $error_message[] = ['message' => 'password can not be blank'];
        }

        if (!empty($first_name)) {
            $credentials['first_name'] = $first_name;
        } else {
            $error_message[] = ['message' => 'first name can not be blank'];
        }

        if (!empty($last_name)) {
            $credentials['last_name'] = $last_name;
        } else {
            $error_message[] = ['message' => 'last name can not be blank'];
        }

        if (count($error_message) > 0) {
            return ResponseController::validation_failed($error_message);
        } else {
            $user = User::query()->create($credentials);
            Auth::login($user);
            $token = Request::user()->createToken('access')->plainTextToken;
            return $token;
        }
    }

    /**
     * @method GET
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        if(Auth::check()) {
            Request::user()->tokens()->delete();
            Auth::logout();
            return response()->json([
                'success' => true,
                'message' => 'Logout'
            ]);
        } else {
            return ResponseController::login_failed();
        }
    }
}
