<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jun
 * Date: 14-3-26
 * Time: 下午5:13
 * To change this template use File | Settings | File Templates.
 */

include_once( "../common/dbConn.php");
include_once( "../constant/constant.php");
include_once("sqlDeal.php");

class getMtMsgDetail
{
    //获取菜品
    public function getMerchantDetail($arg_request){
        global $log;
        global $msgArray;
        try{
            if(!array_key_exists("STORE_ID",$arg_request)){
                $log->error("参数错误:"."STORE_ID ERROR)");
                $rsl = $msgArray->getMsgArray(1,"参数错误!",[],"Warn");
                return $rsl;
            }
            if(!preg_match("/^[0-9]*[1-9][0-9]*$/",$arg_request["STORE_ID"])){
                $log->error("参数错误:"."STORE_ID error(不能通过正则验证)");
                $rsl = $msgArray->getMsgArray(1,"参数错误!",[],"Warn");
                return $rsl;
            }
            $st_id = $arg_request["STORE_ID"];
            $crud = new DbCrud;
            $arg_sql = "select id,phote,name,price from dish_list where belong = $st_id";//连同id返回
            $rs =$crud->dbSelect($arg_sql);
            if($rs!="error"){
                $rsl = $msgArray->getMsgArray(0,"操作成功!",$rs,"success");
            }else{
                $rsl = $msgArray->getMsgArray(1,"数据库操作失败!",[],"error");
            }

        }catch (Exception $e){
            $log->error("抛出异常:".$e->getMessage());
            $rsl = $msgArray->getMsgArray(1,"db error!",[],"error");

        }
        return $rsl;
    }

    //更新菜单
    public  function updateMerchantDetail($arg_request){
        global $log;
        global $msgArray;
        try{

            if(!array_key_exists("DISH_ID",$arg_request)){
                $log->error("参数错误:"."DISH_ID error");
                $rsl = $msgArray->getMsgArray(1,"参数错误!",[],"Warn");
                return $rsl;
            }
            if(!preg_match("/^[0-9]*[1-9][0-9]*$/",$arg_request["DISH_ID"])){
                $log->error("参数错误:"."DISH_ID error(不能通过正则验证)");
                $rsl = $msgArray->getMsgArray(1,"参数错误!",[],"Warn");
                return $rsl;
            }

//            if(array_key_exists("DISH_PHOTO_URL",$arg_request)&&($arg_request["PHOTO_URL"]==""||$arg_request["PHOTO_URL"]==null)){
//                $log->error("参数错误:"."PHOTO_URL error");
//                $rsl = $msgArray->getMsgArray(1,"参数错误!",[],"Warn");
//                return $rsl;
//            }
            if(array_key_exists("DISH_NAME",$arg_request)&&($arg_request["DISH_NAME"]==""||$arg_request["DISH_NAME"]==null)){
                $log->error("参数错误:"."DISH_NAME error");
                $rsl = $msgArray->getMsgArray(1,"参数错误!",[],"Warn");
                return $rsl;
            }

            if(array_key_exists("DISH_PRICE",$arg_request)&&($arg_request["DISH_PRICE"]==""||$arg_request["DISH_PRICE"]==null)){
                $log->error("参数错误:"."DISH_PRICE error");
                $rsl = $msgArray->getMsgArray(1,"参数错误!",[],"Warn");
                return $rsl;
            }
//            if(!preg_match("/^\d+$/",$arg_request["DISH_PRICE"])){
//                $log->error("参数错误:"."PRICE error(不能通过正则验证)");
//                $rsl = $msgArray->getMsgArray(1,"参数错误!",[],"Warn");
//                return $rsl;
//            }

            if(array_key_exists("DISH_MARK",$arg_request)&&($arg_request["DISH_MARK"]==""||$arg_request["DISH_MARK"]==null)){
                $log->error("参数错误:"."DISH_MARK error");
                $rsl = $msgArray->getMsgArray(1,"参数错误!",[],"Warn");
                return $rsl;
            }

            if(array_key_exists("DISH_MARK",$arg_request)&&!preg_match("/^[0-9]*[1-9][0-9]*$/",$arg_request["DISH_MARK"])){
                $log->error("参数错误:"."DISH_MARK error(不能通过正则验证)");
                $rsl = $msgArray->getMsgArray(1,"参数错误!",[],"Warn");
                return $rsl;
            }


            $id= $arg_request["DISH_ID"];

            $crud = new DbCrud();

            $arg_sql = "update dish_list set id =$id";
            if(array_key_exists("DISH_PHOTO_URL",$arg_request)){
                $url = $arg_request["DISH_PHOTO_URL"];
                $arg_sql = $arg_sql.",phote='$url'";
            }
            if(array_key_exists("DISH_NAME",$arg_request)){
                $name = $arg_request["DISH_NAME"];
                $arg_sql = $arg_sql.",name = '$name'";
            }
            if(array_key_exists("DISH_PRICE",$arg_request)){
                $price = $arg_request["DISH_PRICE"];
                $arg_sql = $arg_sql.",price = '$price'";
            }
            if(array_key_exists("DISH_MARK",$arg_request)){

                $mark = $arg_request["DISH_MARK"];
                $arg_sql = $arg_sql.",mark = $mark";
            }


            $arg_sql=  $arg_sql." where id = $id";
            $rs =$crud->dbExec($arg_sql);
            if($rs!="error"){
                $rsl = $msgArray->getMsgArray(0,"操作成功!",$rs,"success");
            }else{
                $log->error("数据库操作异常");
                $rsl = $msgArray->getMsgArray(1,"数据库操作异常!",$rs,"error");
            }
        }catch (Exception $e){
            $log->error("抛出异常:".$e->getMessage());
            $rsl = $msgArray->getMsgArray(1,"db error!",[],"error");
        }
        return $rsl;
    }

    //添加菜单
    public function addMerchantDetail($arg_request){
        global $log;
        global $msgArray;
        try{

            //参数校验
            if(!array_key_exists("STORE_ID",$arg_request)){
                $log->error("参数错误:"."STORE_ID ERROR)");
                $rsl = $msgArray->getMsgArray(1,"参数错误!",[],"Warn");
                return $rsl;
            }
            if(!preg_match("/^[0-9]*[1-9][0-9]*$/",$arg_request["STORE_ID"])){
                $log->error("参数错误:"."STORE_ID error(不能通过正则验证)");
                $rsl = $msgArray->getMsgArray(1,"参数错误!",[],"Warn");
                return $rsl;
            }
            if(!array_key_exists("DISH_PHOTO_URL",$arg_request)){
                $log->error("参数错误:"."DISH_PHOTO_URL error");
                $rsl = $msgArray->getMsgArray(1,"参数错误!",[],"Warn");
                return $rsl;
            }
            if(!array_key_exists("BELONG",$arg_request)){
                $log->error("参数错误:"."STORE_ID ERROR)");
                $rsl = $msgArray->getMsgArray(1,"参数错误!",[],"Warn");
                return $rsl;
            }
            if(!preg_match("/^[0-9]*[1-9][0-9]*$/",$arg_request["BELONG"])){
                $log->error("参数错误:"."STORE_ID error(不能通过正则验证)");
                $rsl = $msgArray->getMsgArray(1,"参数错误!",[],"Warn");
                return $rsl;
            }
            if(!array_key_exists("DISH_NAME",$arg_request)||strlen($arg_request["DISH_NAME"])<=0){
                $log->error("参数错误:"."DISH_NAME error");
                $rsl = $msgArray->getMsgArray(1,"参数错误!",[],"Warn");
                return $rsl;
            }
            if(!array_key_exists("DISH_PRICE",$arg_request)||(strlen($arg_request["DISH_PRICE"])<=0)){
                $log->error("参数错误:"."DISH_PRICE error");
                $rsl = $msgArray->getMsgArray(1,"参数错误!",[],"Warn");
                return $rsl;
            }
//            if(!preg_match("/^\d+$/",$arg_request["DISH_PRICE"])){
//                $log->error("参数错误:"."PRICE error(不能通过正则验证)");
//                $rsl = $msgArray->getMsgArray(1,"参数错误!",[],"Warn");
//                return $rsl;
//            }

            $crud = new DbCrud;
            $p_url = $arg_request["DISH_PHOTO_URL"];
            $name = $arg_request["DISH_NAME"];
            $price =  $arg_request["DISH_PRICE"];
            $belong =  $arg_request["BELONG"];
            $sql = "insert dish_list (phote,name,price,belong) value ('$p_url','$name','$price',$belong)";
            $rs =$crud->dbExec($sql);
            if($rs!="error"){
                $rsl = $msgArray->getMsgArray(0,"操作成功!",$rs,"success");
            }else{
                $log->error("数据库操作异常");
                $rsl = $msgArray->getMsgArray(0,"数据库操作异常!",$rs,"error");
            }
        }catch (Exception $e){
            $log->error("抛出异常:".$e->getMessage());
            $rsl = $msgArray->getMsgArray(1,"db error!",[],"error");
        }
        return $rsl;
    }

    //删除菜单
    public function deleteMerchantDetail($arg_request){
        global $log;
        global $msgArray;
        try{
            if(!array_key_exists("DISH_ID",$arg_request)){
                $log->error("参数错误:"."DISH_ID error");
                $rsl = $msgArray->getMsgArray(1,"参数错误!",[],"Warn");
                return $rsl;
            }
            if(!preg_match("/^[0-9]*[1-9][0-9]*$/",$arg_request["DISH_ID"])){
                $log->error("参数错误:"."DISH_ID error(不能通过正则验证)");
                $rsl = $msgArray->getMsgArray(1,"参数错误!",[],"Warn");
                return $rsl;
            }
            $id = $arg_request["DISH_ID"];
            $sql = "delete from dish_list where id = $id";
            $crud = new DbCrud;
            $rs =$crud->dbExec($sql);
            if($rs!="error"){
                $rsl = $msgArray->getMsgArray(0,"操作成功!",$rs,"success");
            }else{
                $log->error("数据库操作异常");
                $rsl = $msgArray->getMsgArray(0,"数据库操作异常!",$rs,"error");
            }
        }catch (Exception $e){
            $log->error("抛出异常:".$e->getMessage());
            $rsl = $msgArray->getMsgArray(1,"db error!",[],"error");
        }
        return $rsl;
    }
}
