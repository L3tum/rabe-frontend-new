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

    file_get_contents($backendURL . '/api/login', false, createContextWithToken($token));

    $status_line = $http_response_header[0];

    preg_match('{HTTP\/\S*\s(\d{3})}', $status_line, $match);

    $status = $match[1];

    if ($status !== '200') {
        $url = '/login';

        return false;
    }

    return true;
}
