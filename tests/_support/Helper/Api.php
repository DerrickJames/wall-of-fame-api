<?php
namespace Helper;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class Api extends \Codeception\Module
{
    protected $authUser = null;
    protected $authUserToken = null;

    public function getCorrectCredentials()
    {
        $user = $this->getUser();

        return [
            'email'    => $user->email,
            'password' => 'password'
        ];
    }

    public function getWrongCredentials()
    {
        $user = $this->getUser();

        return [
            'email'    => $user->email,
            'password' => 'password1'
        ];
    }

    public function getUser()
    {
        $user = factory(\App\User::class)->create([
            'password' => bcrypt('password')
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

    protected function setAuthUserToken()
    {
        $user = $this->getUser();

        $this->authUser = $user;
        $this->authUserToken = JWTAuth::fromUser($user);
    }
}
