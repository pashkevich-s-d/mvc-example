<?php

require_once('..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');
require_once(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'parameters.php');

use \PashkevichSD\MvcExample\Component\Router;
use \PashkevichSD\MvcExample\Component\Database;
use Symfony\Component\Dotenv\Dotenv;

(new Dotenv())->load(ROOT_DIR . DIRECTORY_SEPARATOR . '.env');

Database::initConnection();

(new Router(include_once(ROUTES_CONFIG)))->run();
