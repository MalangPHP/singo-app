<?php

/**
 * Bootstrapping application
 */

require_once __DIR__ . "/providers.php";

$app->init();

require_once __DIR__ . "/services.php";

require_once __DIR__ . "/events.php";

require_once __DIR__ . "/commands.php";

require_once __DIR__ . "/routes.php";
