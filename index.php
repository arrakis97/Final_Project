<?php
/**
 * Controller
 */

/* Require composer autoloader */
require __DIR__ . '/vendor/autoload.php';

/* Include model.php */
include 'model.php';

/* Connect to DB */
$db = connect_db('localhost', 'final_project', 'ddwt21', 'ddwt21');

/* Create Router instance */
$router = new \Bramus\Router\Router();






/* Give a custom error message for the 404 error */
$router->set404(function () {
    header('HTTP/1.1 404 Not Found');
    echo "404 error: page was not found.";
});

/* Run the router */
$router->run();
