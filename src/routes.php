<?php

/**
 * Register application routes
 */

$app->post("/login", "user.controller:loginAction");
$app->get("/secure", "user.controller:secureAction");