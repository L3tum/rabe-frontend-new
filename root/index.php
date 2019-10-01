<?php

@include_once('vendor/autoload.php');
require_once('util/util.php');
require_once('User.php');

$backend = $_ENV['BACKEND_URI'] ?? $_SERVER['BACKEND_URI'] ?? "https://rabe-backend.herokuapp.com";
$header = 'RaBe';
$uri = $_SERVER['REQUEST_URI'];

$userCookie = '';

if (isset($_COOKIE['user'])) {
    $userCookie = $_COOKIE['user'];
}

try {
    $user = json_decode($userCookie);

    if ($user === null) {
        $user = new User();
    }
} catch (Exception $e) {
    $user = new User();
}

require_once('security.php');

$uri = checkUrlWithToken($uri, $user->getToken());

require_once('util/header.php');
?>
<body>
<?php
require_once('util/nav.php');

switch ($uri) {
    case '/login':
    {
        require_once('pages/login.php');
        break;
    }
    case '/':
    default:
    {
        require_once('pages/home.php');
        break;
    }
}

require_once('util/footer.php');
?>
</body>
