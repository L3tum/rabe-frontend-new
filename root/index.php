<?php

@include_once('vendor/autoload.php');
require_once('util/util.php');

$header = 'RaBe';
$uri = $_SERVER['REQUEST_URI'];
$userCookie = $_COOKIE['user'];


try {
    $user = json_decode($userCookie);
} catch (Exception $e) {
    $user = new User();
}

require_once('security.php');

$uri = checkUrlWithToken($uri, $user->getToken());

require_once('util/header.php');

switch ($uri) {
    case '/':
    default:
    {
        require_once('pages/home.php');
        break;
    }
}

require_once('util/footer.php');
