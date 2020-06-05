<?php
use Woo\Router\Router;

try
{
    $r = new Router();

    /* ROUTES */

    // Redirect from / to /login
    $r->Redirect('/index', '/login');

    // Home page /index , default methods: GET, POST, PUT
    $r->Set("/index", "Woo/Page/Home/Homepage", "Index");

    // Api route
    $r->Set("/api/user/{id}", "Woo/Page/User/User", "GetId");

    // Add route: url, class path, class method
    $r->Set("/welcome/email/{id}", "Woo/Page/Sample/SampleClass", "Index");

    // Only GET
    $r->Set('/route1', function($p) {
        echo "WORKS WITH GET " . $p[0] . ' ' .$_GET['id'];
    }, ['Param 1'], ['GET']);

    // Only POST, PUT
    $r->Set('/route2', function($p) {
        echo "WORKS WITH POST " . ' ' . implode(' ', $_POST);
    }, 'Func params here', ['POST', 'PUT']);

    // Or load from controller route.php file
    $r->Include('Page/Sample/route');

    /* END ROUTES */

    // Error Page
    $r->ErrorPage();
}
catch(Exception $e)
{
    echo json_encode(["errorMsg" => $e->getMessage(), "errorCode" => $e->getCode()]);
}
?>