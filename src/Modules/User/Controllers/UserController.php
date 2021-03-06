<?php

namespace App\Modules\User\Controllers;

use App\Modules\User\Commands\LoginCommand;
use DDesrosiers\SilexAnnotations\Annotations as SLX;
use League\Tactician\CommandBus;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @SWG\Resource(
 *      apiVersion="0.0.1",
 *      swaggerVersion="1.1",
 *      resourcePath="/user",
 *      basePath="http://singo-app.dev"
 * )
 * @SLX\Controller(prefix="/user/")
 * Class UserController
 * @package App\Modules\User\Controllers
 */
class UserController
{
    /**
     * @var CommandBus
     */
    protected $bus;

    /**
     * @param CommandBus $bus
     */
    public function __construct(CommandBus $bus)
    {
        $this->bus = $bus;
    }

    /**
     * @SWG\Api(
     *      path="/user/login",
     *      description="User login API",
     *      @SWG\Operation(
     *          method="POST",
     *          summary="User login API",
     *          notes="Return JSON",
     *          type="User",
     *          nickname="login",
     *          @SWG\Parameter(
     *              name="username",
     *              description="Username",
     *              paramType="query",
     *              required=true,
     *              allowMultiple=false,
     *              type="string"
     *          ),
     *          @SWG\Parameter(
     *              name="password",
     *              description="Password",
     *              paramType="query",
     *              required=true,
     *              allowMultiple=false,
     *              type="string"
     *          ),
     *          @SWG\ResponseMessage(
     *              code=200,
     *              message="Succes"
     *          ),
     *          @SWG\ResponseMessage(
     *              code=400,
     *              message="Invalid username or password"
     *          )
     *      )
     * )
     * @SLX\Route(
     *      @SLX\Request(method="POST", uri="login")
     * )
     * @param Request $request
     * @return JsonResponse
     */
    public function loginAction(Request $request)
    {
        $command = new LoginCommand();
        $command->setUsername($request->get("username"));
        $command->setPassword($request->get("password"));

        $token = $this->bus->handle($command);

        $object = new \ArrayObject();

        $object->offsetSet("data", ["token" => $token]);

        $response = new JsonResponse($object);
        return $response;
    }

    /**
     * @SWG\Api(
     *      path="/user/secure",
     *      description="User Secure Area",
     *      @SWG\Operation(
     *          method="GET",
     *          summary="User Secure Area",
     *          notes="Return secure area",
     *          type="User",
     *          nickname="secure",
     *          @SWG\ResponseMessage(
     *              code=200,
     *              message="success"
     *          ),
     *          @SWG\ResponseMessage(
     *              code=401,
     *              message="Unauthorized"
     *          )
     *      )
     * )
     * @SLX\Route(
     *      @SLX\Request(method="GET", uri="secure")
     * )
     * @param Request $request
     * @return JsonResponse
     */
    public function secureAction(Request $request)
    {
        return new JsonResponse(
            [
                "success" => true
            ]
        );
    }
}
