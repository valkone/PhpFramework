<?php

namespace Framework;

require_once 'Route.php';

$customRouters = [
    new Route("Administrator/Products/Edit", "Administrator", "productEdit"),
    new Route("Home", "Home", "home")
];