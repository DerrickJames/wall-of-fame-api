<?php

namespace App\Http\Controllers\Auth;

use Fame\Auth\Github;
use Illuminate\Http\Request;
use Fame\Auth\JWTAuthentication;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\ApiController;

class AuthController extends ApiController
{
    /**
     * Create a new AuthController instance.
     *
     * @param \App\Auth\JWTAuthentication $auth
     */
    public function __construct(JWTAuthentication $auth)
    {
        $this->auth = $auth;
    }

    /**
     * @api {post} /auth/login User Login
     * @apiVersion 0.0.1
     * @apiGroup Authentication
     * @apiName postLogin
     *
     * @apiParamExample {json} Request-Example:
     *      {
     *          "email": "admin@example.com",
     *          "password": "0123456789"
     *      }
     *
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 Success
     *      {
     *          "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjE"
     *      }
     *
     * @apiErrorExample {json} Error-Response:
     *      HTTP/1.1 401 Unauthorized
     *      {
     *          "message": "Invalid credentials.",
     *          "status_code": 401
     *      }
     */
    public function postLogin(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        $token = $this->auth->login($credentials);

        return response()->json(compact('token'), 200);
    }

    /**
     * TODO: Complete implementation of social login.
     */
    public function postSocialLogin(Github $social, Request $request)
    {
        $token = $social->authenticate($request->has('code'));

        return response()->json(compact('token'), 200);
    }

    /**
     * @api {post} /auth/logout User Logout
     * @apiVersion 0.0.1
     * @apiGroup Authentication
     * @apiName logout
     *
     * @apiErrorExample {json} Error-Response:
     *      HTTP/1.1 422 Unprocessable Entity
     *      {
     *          "message": "Invalid token.",
     *          "status_code": 422
     *      }
     */
    public function logout()
    {
        $this->auth->logout();

        return response()->json(['success' => 'user_logged_out'], 200);
    }
}
