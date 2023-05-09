<?php

namespace App\Helpers;


interface IAuthHelper
{
    public function getAccessToken();
    public function makeAccessToken();

    public function setAccessToken();

    public function setRefreshToken($code);

    public function getRefreshToken();

    public function makeRefreshTokenRequest($code);

    public function makeAuthorizationRequest();
}
