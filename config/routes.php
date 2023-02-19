<?php

/**
 * Feel free to remove those routes and define your own
 */
return [
    'users\/([0-9]+)' => 'users/view/$1',
    'users\/create' => 'users/create',
    'users' => 'users/index',
    'messages\/create' => 'messages/create',
    'messages' => 'messages/index',
];
