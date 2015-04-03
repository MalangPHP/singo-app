<?php

require_once "../vendor/autoload.php";

$app = new \Singo\Application(
    [
        "app.path" => __DIR__ . "/../src",
        "app.public.path" => __DIR__,
        "config.path" => __DIR__ . "/../src/Config/config.yml"
    ]
);

require_once __DIR__ . "/../src/bootstrap.php";

$app->run();
