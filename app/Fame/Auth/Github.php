<?php

namespace Fame\Auth;

use Fame\Repositories\UserInterface;
use Laravel\Socialite\Contracts\Factory as Socialite;

class Github extends AbstractAuth
{
    /**
     * @var Fame\Repositories\UserInterface
     */
    protected $user;

    /**
     * @var Laravel\Socialite\Contracts\Factory
     */
    protected $socialite;

    /**
     * Create a new Github instance.
     *
     * @param Fame\Repositories\UserInterface $user
     * @param Laravel\Socialite\Contracts\Factory $socialite
     * @return void
     **/
    public function __construct(UserInterface $user, Socialite $socialite)
    {
        $this->user = $user;
        $this->socialite = $socialite;
    }

    /**
     * Authenticate user.
     *
     * @param bool $hasCode
     * @return string
     */
    public function authenticate($hasCode)
    {
        if (! $hasCode) {
            return $this->getAuthorization();
        }

        $user = $this->user->findOrCreate($this->getGithubUser());

        $token = $this->generateToken($user);

        return $token;
    }

    /**
     * Get provider authorization.
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     **/
    protected function getAuthorization()
    {
        /*
         * TODO: Handle this on the client-side app!
         */
        \Log::info('Authorization invoked!');
        $provider = $this->socialite->driver('github')->stateless();

        return $provider->redirect();

        return $this->socialite->driver('github')->redirect();
    }

    /**
     * Get Github user data.
     *
     * @return array
     **/
    protected function getGithubUser()
    {
        $user = $this->socialite->driver('github')->user();

        return [
            'username' => $user->getName(),
            'email'    => $user->getEmail(),
            'avatar'   => $user->getAvatar(),
        ];
    }

    /**
     * Generate access token.
     *
     * @param \App\User $user
     * @return string $token
     **/
    protected function generateToken($user)
    {
        return $this->auth->fromUser($user);
    }
}
