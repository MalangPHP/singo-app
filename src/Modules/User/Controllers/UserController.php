<?php


namespace App\Modules\User\Controllers;

use App\Modules\User\Commands\LoginCommand;
use Singo\Contracts\Controller\ControllerAbstract;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UserController
 * @package App\Modules\User\Controllers
 */
class UserController extends ControllerAbstract
{
    /**
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

