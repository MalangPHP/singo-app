<?php

/**
 * Register command handler
 */

$app->registerCommands(
    [
        \App\Modules\User\Commands\LoginCommand::class
    ],
    function () use ($app) {
        return new \App\Modules\User\Handlers\UserHandler($app["security.jwt.encoder"]);
    }
);
