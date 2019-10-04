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

/***
 * @param string|null $token
 * @return array
 */
function getHeadersForSecureRequest(?string $token)
{
    return [
        'Accept' => 'application/json',
        'Authorization' => "Bearer $token",
        'Content-Type' => 'application/json',
    ];
}

/**
 * @param string $url
 * @param string $token
 * @param int $success
 * @param string $method
 * @return string
 * @throws Exception
 */
function makeGetRequest(string $url, string $token, int $success = 200, string $method = 'GET')
{
    $client = new GuzzleHttp\Client();

    try {
        $res = $client->request($method, $url, [
            'headers' => getHeadersForSecureRequest($token)
        ]);
    } catch (GuzzleHttp\Exception\GuzzleException $e) {
        $res = null;
    }

    $responseCode = $res !== null ? $res->getStatusCode() : 500;

    if ($responseCode !== $success) {
        throw new Exception($res !== null ? $res->getReasonPhrase() : '', $responseCode);
    }

    return $res->getBody()->getContents();
}
