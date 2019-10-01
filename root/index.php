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
    // LOL WTF PHP
    $stdobj = json_decode($userCookie);  //JSON to stdClass
    $temp = serialize($stdobj);          //stdClass to serialized

    // Now we reach in and change the class of the serialized object
    $temp = preg_replace('@^O:8:"stdClass":@', 'O:4:"User":', $temp);

    // Unserialize and walk away like nothing happened
    $user = unserialize($temp);   // Presto a php Class

    if ($user === null) {
        $user = new User();
    }
} catch (Exception $e) {
    $user = new User();
}

require_once('security.php');

if (!checkUrlWithToken($uri, $user->getToken(), $backend)) {
    $user = new User();
}

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
    case '/rooms':
    {
        require_once('pages/rooms.php');
        break;
    }
    case '/reset-password':
    {
        require_once('pages/reset-password.php');

        break;
    }
    case (preg_match('/rooms\/view\/[0-9]+\/.+/', $uri) ? true : false):
    {
        require_once('pages/room/open-room.php');
        break;
    }
    case (preg_match('/rooms\/add-error\/[0-9]+\/.+/', $uri) ? true : false):
    {
        require_once('pages/room/add-error.php');
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
