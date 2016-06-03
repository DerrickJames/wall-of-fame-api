<?php

use Illuminate\Http\Response as HttpResponse;

class JWTAuthCest
{
    public function _before(ApiTester $I)
    {
    }

    public function loginUsingCorrectCredentials(ApiTester $I)
    {
        $I->wantTo('Login with correct credentials and receive authorization token.');

        $credentials = $I->getCorrectCredentials();

        $I->sendPOST('/api/auth/login', $credentials);

        $I->seeResponseCodeIs(HttpResponse::HTTP_OK);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType(['token' => 'string']);
        $I->seeResponseJsonMatchesJsonPath('$.token');
    }

    public function loginUsingWrongCredentials(ApiTester $I)
    {
        $I->wantTo('Login with wrong credentials and receive an error.');

        $credentials = $I->getWrongCredentials();

        $I->sendPOST('/api/auth/login', $credentials);

        $I->seeResponseCodeIs(HttpResponse::HTTP_UNAUTHORIZED);
        $I->seeResponseIsJson();
        $I->seeResponseJsonMatchesJsonPath('$.message');
        $I->dontSeeResponseJsonMatchesJsonPath('$.token');
    }
}
