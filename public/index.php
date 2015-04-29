<?php

/**
 * autoload files
 * doctrine has own autoloader, we need register it too
 */
$loader = require_once __DIR__ . "/../vendor/autoload.php";
\Doctrine\Common\Annotations\AnnotationRegistry::registerLoader([$loader, 'loadClass']);

/**
 * setup application options
 */
$app = new \Singo\Application(
    [
        "app.path" => __DIR__ . "/../src",
        "app.public.path" => __DIR__,
        "config.path" => __DIR__ . "/../src/Config/config.yml",
        "config.cache.lifetime" => 300,
        "cache.driver" => "array",
        "cache.options" => [
            "namespace" => "singo",
        ],
        "use.module" => true,
    ]
);

/**
 * return false when requesting static asset when on built-in PHP web server
 */
if (php_sapi_name() === 'cli-server') {
    $filename = __DIR__ . preg_replace('#(\?.*)$#', '', $_SERVER['REQUEST_URI']);
    if (is_file($filename)) {
        return false;
    }
}

/**
 * bootstrap our apps
 */
$app->init($app);

/**
 * run our apps
 */
$app->run();
