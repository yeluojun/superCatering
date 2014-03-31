<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jun
 * Date: 14-3-20
 * Time: 下午12:27
 * To change this template use File | Settings | File Templates.
 */


include_once( "../common/dbConn.php");
include_once( "../constant/constant.php");
include_once("sqlDeal.php");



$msgArray = new MsgArray();
$log = Log4PHP::getLogger("CateringInfoLog");

class getMtMsg{

    //获取商家信息
    public function getMerchant(){
        global $log;
        global $msgArray;
        try{
            $crud = new DbCrud();
            $arg_sql = "select id, name,phone from merchant_list ";
            $rs =$crud->dbSelect($arg_sql);//连同id返回
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

//更新商店(电话号码不能相同)
   public  function updateMerchant($arg_request){
        global $log;
        global $msgArray;
        try{

            if(!array_key_exists("STORE_ID",$arg_request)||!is_numeric($arg_request["STORE_ID"])){
                $log->error("参数错误:"."STORE_ID error");
                $rsl = $msgArray->getMsgArray(1,"参数错误!",[],"Warn");
                return $rsl;

            }
            if(array_key_exists("STORE_NAME",$arg_request)&&($arg_request["STORE_NAME"]==""||$arg_request["STORE_NAME"]==null)){
                $log->error("参数错误:"."STORE_NAME error");
                $rsl = $msgArray->getMsgArray(1,"参数错误!",[],"Warn");
                return $rsl;
            }
            if(array_key_exists("STORE_PHONE",$arg_request)&&($arg_request["STORE_PHONE"]==""||$arg_request["STORE_PHONE"]==null||!is_numeric($arg_request["STORE_PHONE"]))){
                $log->error("参数错误:"."STORE_PHONE error");
                $rsl = $msgArray->getMsgArray(1,"参数错误!",[],"Warn");
                return $rsl;
            }
            $id= $arg_request["STORE_ID"];

            $crud = new DbCrud();

            $arg_sql = "update merchant_list set id =$id";
            if(array_key_exists("STORE_NAME",$arg_request)){
                $name = $arg_request["STORE_NAME"];
                $arg_sql = $arg_sql.",name='$name'";
            }
            if(array_key_exists("STORE_PHONE",$arg_request)){

                //校验电话号码
                $phone = $arg_request["STORE_PHONE"];
                $checkSql = "select count(*) AS COUNT from merchant_list where phone='$phone'";
                $res = $crud->dbSelect($checkSql) ;
                if($res[0]["COUNT"]>0){
                    $log->error("参数错误:"."STORE_PHONE:电话号码不能相同 ");
                    $rsl = $msgArray->getMsgArray(1,"电话号码不能相同!",[],"error");
                    return $rsl;
                }
                $arg_sql = $arg_sql.",phone = '$phone'";
            }
            $arg_sql=  $arg_sql."where id = $id";
            $rs =$crud->dbExec($arg_sql);
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


//删除商店
   public  function deleteMerchant($arg_request){
        global $log;
        global $msgArray;
        try{
            if(!array_key_exists("STORE_ID",$arg_request)){
                $log->error("参数错误:"."STORE_ID error");
                $rsl = $msgArray->getMsgArray(1,"参数错误!",[],"Warn");
                return $rsl;
            }
            if(!preg_match("/^[0-9]*[1-9][0-9]*$/",$arg_request["STORE_ID"])){
                $log->error("参数错误:"."STORE_ID error(不能通过正则验证)");
                $rsl = $msgArray->getMsgArray(1,"参数错误!",[],"Warn");
                return $rsl;
            }

            $crud = new DbCrud;
            $arg_sql = "delete from merchant_list where id = " .$arg_request["STORE_ID"];
            $rs = $crud->dbExec($arg_sql);
            if($rs=="error"){
                $rsl = $msgArray->getMsgArray(1,"数据库操作异常!",[],"error");
            }else{
                $rsl = $msgArray->getMsgArray(0,"操作成功!",[],"success");
            }

        }catch (Exception $e){
            $log->error("抛出异常:".$e->getMessage());
            $rsl = $msgArray->getMsgArray(1,"db error!",[],"error");

        }
        return $rsl;
    }

//增加商店
    public function addMerchant($arg_request){
        global $log;
        global $msgArray;
        try{

            //参数校验
            if(!array_key_exists("STORE_NAME",$arg_request)||(strlen($arg_request["STORE_NAME"])<=0)){
                $log->error("参数错误:"."STORE_NAME error");
                $rsl = $msgArray->getMsgArray(1,"参数错误!",[],"Warn");
                return $rsl;
            }
            if(!array_key_exists("STORE_PHONE",$arg_request)||strlen($arg_request["STORE_PHONE"])<=0){
                $rsl = $msgArray->getMsgArray(1,"参数错误!",[],"Warn");
                $log->error("参数错误:"."STORE_PHONE error");
                return $rsl;
            }

            if(!preg_match("/^\d+$/",$arg_request["STORE_PHONE"])){
                $log->error("参数错误:"."STORE_PHONE error(不能通过正则验证)");
                $rsl = $msgArray->getMsgArray(1,"参数错误!",[],"Warn");
                return $rsl;
            }

            $crud = new DbCrud;

            //校验商店电话号码是否存在
            $arg_sql = "select count(*) as count from merchant_list where  phone=".$arg_request["STORE_PHONE"];
            $rs =  $crud->dbSelect($arg_sql);

            if($rs[0]["count"]>0){
                $log->error("参数错误:"."商店已经存在(存在相同电话号码的商店)");
                $rsl = $msgArray->getMsgArray(1,"商店已经存在!",[],"error");
                return $rsl;
            }

            $arg_sql = "insert merchant_list (name,phone) value ('".$arg_request["STORE_NAME"]."',".$arg_request["STORE_PHONE"].")";
            $rs = $crud->dbExec($arg_sql);
            if($rs!="error"){
                $rsl = $msgArray->getMsgArray(0,"操作成功!",[],"success");
            }else{
                $log->error("数据库异常：可能sql语句错误:");
                $rsl = $msgArray->getMsgArray(1,"数据库操作异常!",[],"error");
            }

        }catch (Exception $e){
            $log->error("抛出异常:".$e->getMessage());
            $rsl = $msgArray->getMsgArray(1,"db error!",[],"error");

        }
        return $rsl;

    }
}

