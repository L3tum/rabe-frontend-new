<?php

/**
 * @param string|null $url
 * @param string|null $token
 * @param string $backendURL
 * @return bool
 */
function checkUrlWithToken(?string &$url, ?string $token, string $backendURL): bool
{
    if ($token === null) {
        $url = $url === '/' ? '/' : $url === '/login' ? '/login' : '/login';

        return false;
    }

    return true;
}
