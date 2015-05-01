<?php

require "vendor/autoload.php";

$app = new \Singo\Application(
    [
        "app.path" => __DIR__ . "/src",
        "app.public.path" => __DIR__,
        "config.path" => __DIR__ . "/src/Config/config.yml",
        "config.cache.lifetime" => 300,
        "cache.driver" => "array",
        "cache.options" => [
            "namespace" => "singo",
        ],
        "use.module" => true,
    ]
);

$app->init($app);

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($app["orm.em"]);
