<?php

namespace PashkevichSD\MvcExample\Controller\Api;

use PashkevichSD\MvcExample\Component\View;
use PashkevichSD\MvcExample\Model\User;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Feel free to remove this controller, it is just an example
 */
class UsersController
{
    public function actionIndex()
    {
        $users = User::getAll(false);

        $response = new JsonResponse($users);

        $response->send();
    }

    public function actionCreate()
    {
        $request = Request::createFromGlobals();
        $data = $request->toArray();

        if (empty($data['name']) || empty($data['surname']) || empty($data['password'])) {
            $errorResponse = new JsonResponse(['message' => 'Incorrect data given!']);
            $errorResponse->setStatusCode(JsonResponse::HTTP_BAD_REQUEST);

            $errorResponse->send();

            return;
        }

        User::create($data);

        $response = new JsonResponse($data);
        $response->setStatusCode(JsonResponse::HTTP_CREATED);

        $response->send();
    }

    public function actionDelete(string $userId)
    {
        $user = User::findById((int) $userId);

        if ($user === false) {
            $errorResponse = new JsonResponse(['message' => 'No such user!']);
            $errorResponse->setStatusCode(JsonResponse::HTTP_NOT_FOUND);

            $errorResponse->send();

            return;
        }

        User::delete($user->getId());

        $response = new JsonResponse();
        $response->setStatusCode(JsonResponse::HTTP_NO_CONTENT);

        $response->send();
    }

    public function actionView(string $userId)
    {
        $user = User::findById((int) $userId);

        if ($user === false) {
            $errorResponse = new JsonResponse(['message' => 'No such user!']);
            $errorResponse->setStatusCode(JsonResponse::HTTP_NOT_FOUND);

            $errorResponse->send();

            return;
        }

        $response = new JsonResponse(User::findById((int) $userId, false));
        $response->setStatusCode(JsonResponse::HTTP_OK);

        $response->send();
    }
}
