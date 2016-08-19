<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use Fame\Auth\Github;
use Tymon\JWTAuth\JWTAuth;
use App\Events\CurrentUser;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use App\Http\Requests\LoginRequest;
use Fame\Repositories\UserInterface;
use App\Http\Controllers\ApiController;

class AuthController extends ApiController
{
    use Helpers;

    /**
     * @var Tymon\JWTAuth\JWTAuth
     **/
    protected $jwtAuth;

    /**
     * @var Fame\Repositories\UserInterface
     */
    protected $user;

    /**
     * Create a new AuthController instance.
     *
     * @param \App\Auth\JWTAuthentication $auth
     * @param \Fame\Repositories\UserInterface $user
     */
    public function __construct(JWTAuth $auth, UserInterface $user)
    {
        $this->user = $user;
        $this->jwtAuth = $auth;
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
     *          "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjE",
     *          "currentUser": {
     *              "uuid": "ef451aa8-2dca-4a53-92d5-bff19d81c359",
     *              "username": "Rickie Bernier",
     *              "email": "admin@gmail.com",
     *              "avatar": "http://localhost/profiles/avatars/avatar3.jpeg"
     *          }
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

        try {
            if (! $token = $this->jwtAuth->attempt($credentials)) {
                return $this->response->error('Invalid credentials', 401);
            }
        } catch (JWTException $e) {
            return $this->response->error('Could not create token', 500);
        }

        $user = $this->jwtAuth->toUser($token)->toArray();
        $currentUser = array_only($user, ['uuid', 'username', 'email', 'avatar']);

        return $this->response->array(compact('token', 'currentUser'), 200);
    }

    /**
     * TODO: Complete implementation of social login.
     */
    public function postSocialLogin(Github $social, Request $request)
    {
        $token = $social->authenticate($request->has('code'));

        return $this->response->array(compact('token'), 200);
    }

    /**
     * @api {get} /auth/user Current User
     * @apiVersion 0.0.1
     * @apiGroup Authentication
     * @apiName currentUser
     *
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 Success
     *      {
     *          "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjE",
     *          "currentUser": {
     *              "uuid": "ef451aa8-2dca-4a53-92d5-bff19d81c359",
     *              "username": "Rickie Bernier",
     *              "email": "admin@gmail.com",
     *              "avatar": "http://localhost/profiles/avatars/avatar3.jpeg"
     *          }
     *      }
     *
     * @apiErrorExample {json} Error-Response:
     *      HTTP/1.1 401 Unauthorized
     *      {
     *          "message": "Invalid token.",
     *          "status_code": 401
     *      }
     */
    public function currentUser(Request $request)
    {
        if (!$requestToken = $this->jwtAuth->setRequest($request)->getToken()) {
            return $this->response->errorBadRequest();
        }

        $user = $this->jwtAuth->authenticate($requestToken);

        if (!$user) {
            return $this->response->errorNotFound();
        }

        $token = $this->jwtAuth->refresh($requestToken);
        $currentUser = array_only($user->toArray(), ['uuid', 'username', 'email', 'avatar']);

        //event(new CurrentUser($token, $currentUser));

        return $this->response->array(compact('token', 'currentUser'), 200);
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
        $token = $this->auth->getToken();

        $this->auth->invalidate($token);

        return $this->response->array(['success' => 'user_logged_out'], 200);
    }
}
