<?php

/**
 * Register custom service
 */

$app["user.controller"] = function(\Pimple\Container $container) {
    return new \App\Modules\User\Controllers\UserController(
        $container["request_stack"],
        $container["fractal.manager"],
        $container["command.bus"]
    );
};
