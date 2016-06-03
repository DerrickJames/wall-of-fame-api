<?php

namespace Fame\Auth;

use Tymon\JWTAuth\JWTAuth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

abstract class AbstractAuth
{
    /**
     * @var \Tymon\JWTAuth\JWTAuth
     **/
    protected $auth;

    /**
     * Create a new AbstractAuth instance.
     *
     * @param \Tymon\JWTAuth\JWTAuth $auth
     * @return void
     **/
    public function __construct(JWTAuth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Logout user.
     *
     * @return void
     */
    public function logout()
    {
        $token = $this->auth->getToken();

        return $this->auth->invalidate($token);
    }

    /**
     * Get authenticated user from the request object.
     *
     * @param \Illuminate\Http\Request $request
     * @return \App\User
     */
    public function getUserFromRequest($request)
    {
        if (! $token = $this->auth->setRequest($request)->getToken()) {
            throw new BadRequestHttpException('Token not provided.');
        }

        $user = $this->auth->authenticate($token);

        if (! $user) {
            throw new NotFoundHttpException('User not found.');
        }

        return $user;
    }
}
