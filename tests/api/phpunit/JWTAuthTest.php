<?php

use Illuminate\Http\Response as HttpResponse;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class JWTAuthTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_successfully_logs_in_user_with_correct_credentials()
    {
        $credentials = $this->getCorrectCredentials();

        $response = $this->call('POST', '/api/auth/login', $credentials);

        $this->assertEquals(HttpResponse::HTTP_OK, $response->status());

        $responseData = json_decode($response->getContent());

        $this->assertObjectHasAttribute('token', $responseData);
        $this->assertNotEmpty($responseData->token);
    }

    /** @test */
    public function it_fails_logging_in_user_with_incorrect_credentials()
    {
        $credentials = $this->getWrongCredentials();

        $response = $this->call('POST', '/api/auth/login', $credentials);

        $this->assertEquals(HttpResponse::HTTP_UNAUTHORIZED, $response->status());

        $responseData = json_decode($response->getContent());

        $this->assertObjectHasAttribute('message', $responseData);
        $this->assertNotEmpty($responseData->message);
    }
}
