<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController as BaseController;

class RegisterController extends BaseController
{

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(Request $request)
    {
        $response = $this->userService->createUser($request->all());
        return $this->sendResponse($response, 'User register successfully.');
    }

    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('JobTest')->accessToken;
            $success['name'] =  $user->name;

            return $this->sendResponse($success, 'User login successfully.');
        }
        else{
            return $this->sendError('Unauthorized.', ['error' => 'Unauthorized']);
        }
    }

    public function forgotPassword (Request $request)
    {
        $this->userService->forgotPassword($request->email);
        return response()->json(['message' => 'Reset password link sent on your email id.']);
    }

    public function resetPassword (Request $request)
    {
        return $this->userService->resetPassword($request->all());
    }
}
