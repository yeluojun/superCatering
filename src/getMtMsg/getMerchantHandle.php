<?php
/**
 * Created by PhpStorm.
 * User: Ellon_Wong
 * Date: 14-3-19
 * Time: 上午12:16
 */

header('Access-Control-Allow-Origin: *');
//header('Access-Control-Allow-Methods: POST');
header('Access-Control-Max-Age: 1000');

include_once dirname(__FILE__) . '/getMerchantFunc.php';


function RequestSolve(){
//    $body = $_REQUEST->getBody();
//    $user = $_POST;
    $result = Receive_Route($_SERVER,$_REQUEST);

    echo json_encode($result);
}

RequestSolve();

?>