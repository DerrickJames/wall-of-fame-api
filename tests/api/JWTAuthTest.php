<?php

use Illuminate\Http\Response as HttpResponse;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class JWTAuthTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     *
     * Test: POST /api/auth/login
     */
    public function it_successfully_logs_in_user_with_correct_credentials()
    {
        $credentials = $this->getCorrectCredentials();

        $this->post('/api/auth/login', $credentials)->seeJsonStructure(['token']);
    }

    /** 
      * @test 
      *
      * Test: POST /api/auth/login
      */
    public function it_fails_logging_in_user_with_incorrect_credentials()
    {
        $credentials = $this->getWrongCredentials();

        $this->post('/api/auth/login', $credentials)
            ->seeStatusCode(HttpResponse::HTTP_UNAUTHORIZED)
            ->seeJsonStructure(['message']);
    }

    /**
     * @test
     *
     * Test: GET /api/auth/user
     **/
    public function it_returns_currently_authenticated_user_when_valid_token_is_provided()
    {
        $user = $this->getAuthUser();
        $token = $this->getAuthUserToken();

        $this->get('/api/auth/user', $this->getHeaders())
            ->seeStatusCode(HttpResponse::HTTP_OK)
            ->seeJson([
                'token' => $token,
                'currentUser' => [
                    'uuid' => $user->uuid,
                    'username' => $user->username,
                    'email' => $user->email,
                    'avatar' => $user->avatar
                ]
            ]);
    }
}
