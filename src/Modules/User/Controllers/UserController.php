<?php

namespace App\Modules\User\Controllers;

use App\Modules\User\Commands\LoginCommand;
use Singo\Contracts\Controller\ControllerAbstract;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Swagger\Annotations as SWG;
use DDesrosiers\SilexAnnotations\Annotations as SLX;

/**
 * @SWG\Resource(
 *      apiVersion="0.0.1",
 *      swaggerVersion="1.1",
 *      resourcePath="/user",
 *      basePath="http://singo-app.dev"
 * )
 * @SLX\Controller(prefix="/")
 * Class UserController
 * @package App\Modules\User\Controllers
 */
class UserController extends ControllerAbstract
{
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

        try {
            $token = $this->bus->handle($command);

            $object = new \ArrayObject();

            $object->offsetSet("data", ["token" => $token]);

            $response = new JsonResponse($object);
        } catch (\InvalidArgumentException $e) {
            $response =  new JsonResponse(
                [
                    "error" => [
                        "message" => $e->getMessage()
                    ]
                ],
                Response::HTTP_BAD_REQUEST
            );
        } catch (\Exception $e)
        {
            $response = new JsonResponse(
                [
                    "error" => [
                        "message" => $e->getMessage()
                    ]
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }

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
