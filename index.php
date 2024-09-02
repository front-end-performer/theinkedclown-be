<?php
include_once "router.php";
$router = new Router();

$query = $_SERVER['QUERY_STRING'];
$url = '/?' . $query;

$router->addRoute('GET', $url, function () {
    // header('Access-Control-Allow-Headers: *');
    // header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json');

    include('locale/' . $_GET['lang'] . '.php');
    echo json_encode($langArray);
    exit;
});

// Now, we can test our router with parameters.
// $router->addRoute('GET', '/blogs/:blogID', function ($blogID) {
//     echo "My route is working with blogID => $blogID !";
//     exit;
// });

$router->matchRoute();
