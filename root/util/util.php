<?php

/**
 * @param $haystack
 * @param $needle
 * @return bool
 */
function startsWith($haystack, $needle)
{
    return substr_compare($haystack, $needle, 0, strlen($needle)) === 0;
}

/**
 * @param $haystack
 * @param $needle
 * @return bool
 */
function endsWith($haystack, $needle)
{
    return substr_compare($haystack, $needle, -strlen($needle)) === 0;
}

/**
 * @param string $token
 * @return resource
 */
function createContextWithToken($token)
{
    // Create a stream
    $opts = [
        "http" => [
            "method" => "GET",
            "header" => "Accept:application/json\r\nAuthorization: Bearer $token\r\nConnection: close",
            'ignore_errors' => true
        ]
    ];

    return stream_context_create($opts);
}
