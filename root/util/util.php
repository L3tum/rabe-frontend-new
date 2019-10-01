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
 * @param string $body
 * @return resource
 */
function createContextWithToken($token, $body = '')
{
    // Create a stream
    $opts = [
        "http" => [
            "method" => "GET",
            "header" => "Authorization=$token",
            "content" => $body,
            "ignore_errors" => true
        ]
    ];

    return stream_context_create($opts);
}
