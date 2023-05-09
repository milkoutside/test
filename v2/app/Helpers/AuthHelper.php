<?php

namespace App\Helpers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;


class AuthHelper implements IAuthHelper
{

    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function makeAccessToken()
    {
        $client = new Client();
        $clientData = $client->getClient();

        $clientId = $clientData['client_id'];
        $clientSecret = $clientData['client_secret'];
        $refreshToken = $this->getRefreshToken();
        $grant_type = 'refresh_token';
        $params = [
            'refresh_token' => $refreshToken,
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'grant_type' => $grant_type
        ];

        $queryString = http_build_query($params);

        $url = 'https://accounts.zoho.eu/oauth/v2/token?' . $queryString;

        $response = Http::post($url);

        $data = $response->json()['access_token'];

        return $data;
    }
    public function setAccessToken()
    {
        return redirect('/')->withCookie(cookie('a_t', trim($this->makeAccessToken()),60000));
    }
    public function getAccessToken()
    {
        $cookie = $this->request->cookie('a_t');

        $accessToken = Crypt::decryptString($cookie);
        $parts = explode('|', $accessToken);
        $secondPart = $parts[1];

        return $secondPart;
    }
    public function setRefreshToken($code)
    {
        return redirect('/')->withCookie(cookie('r_t', trim($code),60000));
    }

    public function getRefreshToken()
    {
        return $this->request->cookie('r_t');
    }

    public function makeRefreshTokenRequest($code)
    {
        $client = new Client();
        $clientId = $client->getClient()['client_id'];
        $clientSecret = $client->getClient()['client_secret'];
        $redirectUri = $client->getClient()['redirect_url'];
        $grant_type = 'authorization_code';

        $response = Http::withHeaders([
            'Content-Type' => 'application/x-www-form-urlencoded'
        ])
            ->asForm()
            ->post('https://accounts.zoho.eu/oauth/v2/token', [
                'code' => $code,
                'client_id' => $clientId,
                'client_secret' => $clientSecret,
                'redirect_uri' => $redirectUri,
                'grant_type' => $grant_type
            ]);

        $refreshToken = $response->json()['refresh_token'];

        return $this->setRefreshToken($refreshToken);
    }

    public function makeAuthorizationRequest()
    {
        $client = new Client();
        $clientData = $client->getClient();
        return redirect('https://accounts.zoho.com/oauth/v2/auth?scope=ZohoCRM.modules.ALL&client_id='
            . $clientData['client_id'] .
            '&response_type=code&access_type=offline&redirect_uri=http://localhost:8000');
    }
}
