<?php
/**
 * Created by PhpStorm.
 * User: Ellon_Wong
 * Date: 14-3-19
 * Time: 上午12:16
 */

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Max-Age: 1000');

include_once dirname(__FILE__) . '/CateringInfo_func.php';


function RequestSolve(){
switch ($_SERVER["REQUEST_METHOD"]){
    case "GET":$result = CateringInfo_Route($_GET);break;
    case "POST":$result = CateringInfo_Route($_POST);break;
    default :$result =CateringInfo_Route($_POST);break;
}
echo json_encode($result);
}

RequestSolve();

?>