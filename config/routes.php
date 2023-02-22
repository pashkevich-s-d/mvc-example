<?php

/**
 * Feel free to remove those routes and define your own
 */
return [
    'GET' => [
        // API routes
        'api\/users\/([0-9]+)' => 'api/users/view/$1',
        'api\/users' => 'api/users/index',

        // WEB routes
        'users\/([0-9]+)' => 'web/users/view/$1',
        'users\/create' => 'web/users/create',
        'users' => 'web/users/index',
        '' => 'web/users/index',
        'messages\/create' => 'web/messages/create',
        'messages' => 'web/messages/index',
    ],
    'POST' => [
        // API routes
        'api\/users' => 'api/users/create',
    ],
    'PUT' => [],
    'DELETE' => [
        // API routes
        'api\/users\/([0-9]+)' => 'api/users/delete/$1',
    ],
];
