<?php

namespace RaBe\Util;

use RaBe\Models\User;
use GuzzleHttp;

/**
 * Class Security
 */
class Security
{
    /**
     * @param string|null $url
     * @param User|null $user
     * @param string $backendURL
     * @return bool
     */
    public static function checkUrlWithToken(?string &$url, ?User $user, string $backendURL): bool
    {
        if ($user === null || $user->getToken() === null) {
            if ($url !== '' && $url !== '/') {
                $url = '/login';
            }

            return false;
        }

        if (!self::checkLogin($backendURL, $user->getToken())) {
            if ($url !== '' && $url !== '/') {
                $url = '/login';

                return false;
            }
        }

        if (!$user->isPasswordChanged()) {
            $url = '/reset-password';

            return true;
        }

        if ($url === '/login') {
            $url = '/rooms';
        }

        return true;
    }

    /**
     * @param string $backend
     * @param string $token
     * @return bool
     */
    private static function checkLogin(string $backend, string $token)
    {
        $client = new GuzzleHttp\Client();

        try {
            $res = $client->request('GET', $backend . '/api/login', [
                'headers' => getHeadersForSecureRequest($token)
            ]);
            
            return $res->getStatusCode() === 200;
        } catch (GuzzleHttp\Exception\GuzzleException $e) {
            return false;
        }
    }
}
