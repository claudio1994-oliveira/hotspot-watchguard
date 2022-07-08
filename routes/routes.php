<?php

use App\Controller\AuthSoap;
use App\Controller\Hotspot;
use App\Controller\NotFound;

return array(

    '/' => [Hotspot::class, "create", "get"],
    '/hotspot' => [Hotspot::class, "create", "get"],
    '/404' => [NotFound::class, "notFound", "post"],
    '/auth' => [AuthSoap::class, "store", "post"],
);