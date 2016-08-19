<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    protected $authUser = null;
    protected $authUserToken = null;

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    public function getCorrectCredentials()
    {
        $user = $this->getUser();

        return [
            'email'    => $user->email,
            'password' => 'password',
        ];
    }

    public function getWrongCredentials()
    {
        $user = $this->getUser();

        return [
            'email'    => $user->email,
            'password' => 'password1',
        ];
    }

    public function getUser()
    {
        $user = factory(\App\User::class)->create([
            'password' => bcrypt('password'),
        ]);

        return $user;
    }

    public function getAuthUser()
    {
        if (! $this->authUser) {
            $this->setAuthUserToken();
        }

        return $this->authUser;
    }

    public function getAuthUserToken()
    {
        if (! $this->authUserToken) {
            $this->setAuthUserToken();
        }

        return $this->authUserToken;
    }

    /**
     * Return request headers.
     *
     * @return array
     */
    public function getHeaders()
    {
        $headers = ['Accept' => 'application/json'];
        $token = $this->getAuthUserToken();

        if ($token) {
            JWTAuth::setToken($token);
            $headers['Authorization'] = 'Bearer '.$token;
        }

        return $headers;
    }

    protected function setAuthUserToken()
    {
        $user = $this->getUser();

        $this->authUser = $user;
        $this->authUserToken = JWTAuth::fromUser($user);
    }
}
