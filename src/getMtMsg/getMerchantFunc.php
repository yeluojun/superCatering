<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jun
 * Date: 14-3-21
 * Time: 上午2:29
 * To change this template use File | Settings | File Templates.
 */
include_once dirname(__FILE__) . '/../constant/constant.php';
include_once dirname(__FILE__) . '/../../lib/Log4PHP/Log4PHP.php';
include_once '../common/dbConn.php';
include_once  "sqlDeal.php";
include_once "getMerchant.php";
include_once "getMerchantDetail.php";

$log = Log4PHP::getLogger("CateringInfoLog");
$msgArray = new MsgArray();

function Receive_Route($arg_server,$arg_request){
    try{
        global $log;
        global $msgArray;
        $merchant = new getMtMsg();
        $merchantDetail = new getMtMsgDetail();
        $rsl = "";
        $log->info("===================CateringInfo_Route begin ye=====================");
        $log->info($arg_server);

        if(!array_key_exists("PATH_INFO",$arg_server)){
            $rsl = $msgArray->getMsgArray(1,"路径错误!",[],"Warn");
            return $rsl;
        }
        switch ($arg_server["PATH_INFO"]){
            //商店的增删改查
            case "/getMerchant":$rsl=$merchant->getMerchant();break;
            case "/updateMerchant";$rsl=$merchant->updateMerchant($arg_request);break;
            case "/deleteMerchant";$rsl=$merchant->deleteMerchant($arg_request);break;
            case "/addMerchant";$rsl=$merchant->addMerchant($arg_request);break;

            //菜品的增删改查
            case "/getMerchantDetail":$rsl=$merchantDetail->getMerchantDetail($arg_request);break;
            case "/getMerchantDetail":$rsl=$merchantDetail->getMerchantDetail($arg_request);break;
            case "/updateMerchantDetail":$rsl=$merchantDetail->updateMerchantDetail($arg_request);break;
            case "/addMerchantDetail":$rsl=$merchantDetail->addMerchantDetail($arg_request);break;
            case "/deleteMerchantDetail":$rsl=$merchantDetail->deleteMerchantDetail($arg_request);break;
            default;break;
        }
        return $rsl;
    }catch (Exception $e){
        $log->error("抛出异常:".$e->getMessage());
        return $msgArray->getMsgArray(100001,"系统异常",[],"Error");
    }
}







