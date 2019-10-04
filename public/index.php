<?php

ob_start();

require_once('./../vendor/autoload.php');
require_once('./../src/Util/util.php');

use RaBe\Util\Serializer;
use Whoops\Handler\Handler;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;
use RaBe\Models\User;
use RaBe\Util\Security;

$app_env = $_ENV['APP_ENV'] ?? $_SERVER['APP_ENV'] ?? "dev";
$debug = $app_env === "dev";

if ($debug) {
    $whoops = new Run();
    $whoops->prependHandler(new PrettyPageHandler());
    $whoops->register();
} else {
    $whoops = new Run();
    $whoops->prependHandler(function ($exception, $inspector, $run) {
        /** @var Exception $exception */
        $message = $exception->getMessage();
        require_once('pages/error.php');
        return Handler::DONE;
    });
    $whoops->register();
}

$httpMethod = $_SERVER['REQUEST_METHOD'];

if ($httpMethod !== 'GET') {
    http_response_code(405);
    exit();
}

$backend = $_ENV['BACKEND_URI'] ?? $_SERVER['BACKEND_URI'] ?? "https://rabe-backend.herokuapp.com";
$header = 'RaBe';
$uri = $_SERVER['REQUEST_URI'];

$userCookie = '';

if (isset($_COOKIE['user'])) {
    $userCookie = $_COOKIE['user'];
}

try {
    $user = Serializer::deserialize($userCookie, User::class);
} catch (Exception $e) {
    // Intentionally left blank
}

if (!Security::checkUrlWithToken($uri, $user, $backend)) {
    $user = new User();
}

require_once('partials/header.php');
?>
<body>
<?php
require_once('partials/nav.php');

switch ($uri) {
    case (preg_match('/rooms\/view\/\d+/', $uri) ? true : false):
    {
        require_once('pages/room/open-room.php');
        break;
    }
    case (preg_match('/rooms\/add-error\/\d+/', $uri) ? true : false):
    {
        require_once('pages/room/add-error.php');
        break;
    }
    case (preg_match('/rooms\/workplace\/\d+/', $uri) ? true : false):
    {
        require_once('pages/room/workplace.php');
        break;
    }
    case (preg_match('/admin\/teacher\/\d+/', $uri) ? true : false):
    {
        require_once('pages/admin/teacher/view.php');
        break;
    }
    case (preg_match('/admin\/room\/\d+/', $uri) ? true : false):
    {
        require_once('pages/admin/room/view.php');
        break;
    }
    case '':
    case '/':
    {
        require_once('pages/home.php');
        break;
    }
    default:
    {
        if (strpos($uri, '.') === false && file_exists("pages$uri.php")) {
            @require_once("pages$uri.php");

            break;
        }

        header('Location: /', true, 302);
        exit();
    }
}

require_once('partials/footer.php');
?>
</body>
