<?php

namespace App\Tests;

use Singo\Application;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ApplicationTest
 * @package App\Tests
 */
class ApplicationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Application
     */
    protected $app;

    public function setUp()
    {
        $this->app = new Application(
            [
                "app.path" => __DIR__ . "/../../../src",
                "app.public.path" => __DIR__,
                "config.path" => __DIR__ . "/../../../src/Config/config.yml",
                "config.cache.lifetime" => 300,
                "cache.driver" => "array",
                "cache.options" => [
                    "namespace" => "singo",
                ],
                "use.module" => true,
            ]
        );

        $this->app->init($this->app);
    }

    public function testLogin()
    {

        $req = Request::create("/user/login", "POST", [
            "username" => "admin",
            "password" => "singo"
        ]);

        $response = $this->app->handle($req);

        $this->assertContains("data", $response->getContent());
    }
}

