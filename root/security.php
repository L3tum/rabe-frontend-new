<?php

/**
 * @param string|null $url
 * @param string|null $token
 * @param string      $backendURL
 * @return bool
 */
function checkUrlWithToken(?string &$url, ?string $token, string $backendURL): bool
{
    if ($token === null) {
        if ($url !== '' && $url !== '/' && $url !== '/login') {
            $url = '/login';
        }

        return false;
    }

    return true;
}
