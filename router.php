<?php
use Woo\App\Router\Router;

try
{
    $r = new Router();

	$r->Set("/", "Woo/Page/Home/Homepage", "Index");

    $r->ErrorPage();
}
catch(Exception $e)
{
    echo json_encode(["errorMsg" => $e->getMessage(), "errorCode" => $e->getCode()]);
}
?>

<?php

	// // Only GET
    // $r->Set('/route1', function($p) {
    //     echo "WORKS WITH GET " . $p[0] . ' ' .$_GET['id'];
    // }, ['Param 1'], ['GET']);

    // // Only POST, PUT
    // $r->Set('/route2', function($p) {
    //     echo "WORKS WITH POST " . ' ' . implode(' ', $_POST);
    // }, 'Func params here', ['POST', 'PUT']);

    // // Api route
    // $r->Set("/api/user/{id}", "PhpApix/Api/User/User", "GetId");

    // // Add route: url, class path, class method
    // $r->Set("/welcome/email/{id}", "PhpApix/Api/Sample/SampleClass", "Index");

    // // Or load from controller route.php file
    // $r->Include('Api/Sample/route');

?>