<?php

namespace PashkevichSD\MvcExample\Controller;

use PashkevichSD\MvcExample\Component\View;
use PashkevichSD\MvcExample\Model\User;

/**
 * Feel free to remove this controller, it is just an example
 */
class UsersController
{
    public function actionIndex()
    {
        $users = User::getAll();

        View::build(
            'main',
            'users',
            [
                'users' => $users,
            ]
        );
    }

    public function actionCreate()
    {
        echo 'Hello from users create controller!';
    }

    public function actionView(string $userId)
    {
        echo "Hello from user (ID: $userId) view page!";
    }
}
