<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use Illuminate\Support\Facades\Bus;

class AuthController extends Controller
{
    public function getAccessToken()
    {
        $clientId = '1000.IRHZ7X8HJU8DD1ICKAWVQGRPGWY3KG';
        $clientSecret = '497b85987e689f9613e1a213ff09859003c40ded16';
        $refreshToken = '1000.e2d007af1cbc878e2d700c039f3c588d.fec068651c077ac9f5abc2ffb040613c';
        $redirectUri = 'http://localhost:8000';
        $grant_type = 'refresh_token';

        $response = Http::post('https://accounts.zoho.eu/oauth/v2/token?refresh_token='.$refreshToken.'&client_id='.$clientId.'&client_secret='.$clientSecret.'&grant_type='.$grant_type);

        return $response->json()['access_token'];
    }
}
