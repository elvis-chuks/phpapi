<?php 
    require_once __DIR__.'/src/db.php';
    require_once __DIR__.'/src/controller.php';

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri = explode( '/', $uri );
    class API {
        function Start(){
            switch ($_GET['endpoint']){
                case '/v1/test':
                    $test = new Test;
                    echo $test->Users($_SERVER['REQUEST_METHOD'],$_REQUEST);
                    // add a request method field
                    return;
                default:
                    header("HTTP/1.1 404 Not Found");
                    $obj = (object) array('status' => 'error','status_code' => 404, 'msg' => 'Page not found');
                    return json_encode($obj);
                    exit();
            }
        }
    }
    $API = new API;
    echo $API->Start();
?>