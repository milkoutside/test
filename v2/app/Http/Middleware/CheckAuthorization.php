<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Helpers\AuthHelper;


class CheckAuthorization
{
    public function handle(Request $request, Closure $next)
    {
        $authHelper = new AuthHelper($request);
        $url = $request->fullUrl();
        $refreshToken = $authHelper->getRefreshToken();
        $accessToken = $request->cookie('a_t');

        if (strpos($url, 'code=') !== false) {
            $code = $request->input('code');
            $code = strtok($code, '&');
            $code = substr($code, strpos($code, '='));
            return $authHelper->makeRefreshTokenRequest($code);
        }
        // Пользователь не авторизован, перенаправляем на страницу авторизации
        if (!isset($refreshToken)) {
            return $authHelper->makeAuthorizationRequest();
        }
        if(!isset($accessToken))
        {
            return $authHelper->setAccessToken();
        }
        // Пользователь уже авторизован, продолжаем выполнение запроса
        return $next($request);
    }
}
