<?php

namespace Fame\Auth;

use Tymon\JWTAuth\JWTAuth;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class JWTAuthentication extends AbstractAuth
{
    /**
     * @var \Tymon\JWTAuth\JWTAuth
     **/
    protected $auth;

    /**
     * Create a new JWTAuthentication instance.
     *
     * @param \Tymon\JWTAuth\JWTAuth $auth
     * @return void
     **/
    public function __construct(JWTAuth $auth)
    {
        parent::__construct($auth);
    }

    /**
     * Authenticate user.
     *
     * @param array $credentials
     * @return array
     */
    public function login($credentials)
    {
        $token = $this->auth->attempt($credentials);

        if (! $token) {
            throw new UnauthorizedHttpException('Invalid credentials.');
        }

        return $token;
    }
}
