<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jun
 * Date: 14-3-21
 * Time: 下午1:21
 * To change this template use File | Settings | File Templates.
 */
include_once(dirname(__FILE__) . "../common/dbConn.php");
include_once(dirname(__FILE__) . "../constant/constant.php");
include_once(dirname(__FILE__) . "sqlDeal.php");



$msgArray = new MsgArray();
$log = Log4PHP::getLogger("CateringInfoLog");
class dUsers
{
    //获取用户学校学校
    public function getUserSchool(){
        try{
            global $log;
            global $msgArray;

            $sql= 'select distinct  school from user_list ';
            $crud = new DbCrud();
            $rs =$crud->dbSelect($sql);
            $rsl = $msgArray->getMsgArray(0,"操作成功!",$rs,"success");
        }catch (Exception $e){
            $log->error("抛出异常:".$e->getMessage());
            $rsl = $msgArray->getMsgArray(1,"db error!",[],"error");
        }
        return $rsl;

    }

    //获取用户信息(包括收缩)
    public function getUserMsg($arg_param){
        try{
            global $log;
            global $msgArray;
            $sql = "select id,school,tel,name from user_list where 1=1";


        }catch (Exception $e){
            $log->error("抛出异常:".$e->getMessage());
            $rsl = $msgArray->getMsgArray(1,"db error!",[],"error");
        }
    }

    //更改用户信息
    /*
     * 用户名可以相同，电话不能相同
     *
     */
    public function updateUserMsg($arg_request){
        try{
            global $log;
            global $msgArray;
            $crud = new DbCrud();
            //参数校验
            if(!array_key_exists("USER_ID",$arg_request)){
                $rsl = $msgArray->getMsgArray(1,"参数错误!",[],"Warn");
                $log->error("用户id为空");
                return $rsl;
            }
            $id = $arg_request["USER_ID"];
            if(array_key_exists("USER_NAME",$arg_request)&&(strlen($arg_request["USER_NAME"]<=0))){
                $rsl = $msgArray->getMsgArray(1,"参数错误!",[],"Warn");
                 $log->error("用户名错误");
                return $rsl;
            }

            if(array_key_exists("USER_SCHOOL",$arg_request)&&(strlen($arg_request["USER_SCHOOL"]<=0))){
                $rsl = $msgArray->getMsgArray(1,"参数错误!",[],"Warn");
                $log->error("学校名错误");
                return $rsl;
            }

            if(array_key_exists("USER_TEL",$arg_request)&&(strlen($arg_request["USER_TEL"]<=0)||!is_numeric($arg_request["USER_TEL"]))){
                $rsl = $msgArray->getMsgArray(1,"参数错误!",[],"Warn");
                $log->error("电话信息错误");
                return $rsl;
            }

            //执行
            $sql = "update user_list set id = $id";

            if(array_key_exists("USER_NAME",$arg_request)){
                $user_name = $arg_request["USER_NAME"];
                $sql = $sql+",name='$user_name'";
            }

            if(array_key_exists("USER_SCHOOL",$arg_request)){
                $user_sc = $arg_request["USER_SCHOOL"];
                $sql = $sql+",school='$user_sc'";
            }

            if(array_key_exists("USER_TEL",$arg_request)){
                /*
                 * 差电话校验
                 */
                //校验商店电话号码是否存在
                $arg_sql = "select count(*)from user_list where phone="+$arg_request["STORE_PHONE"];
                $rs =  $crud->dbSelect($arg_sql);

                if($rs[0]>0){
                    $rsl = $msgArray->getMsgArray(1,"人员已经存在!",[],"error");
                    return $rsl;
                }
                $user_tel = $arg_request["USER_TEL"];
                $sql = $sql+",tel= '$user_tel'";
            }
            $sql = $sql+" where id = $id";
            $crud->dbExec($sql);
            $rsl = $msgArray->getMsgArray(0,"操作成功!",[],"success");
        }catch (Exception $e){
            $log->error("抛出异常:".$e->getMessage());
            $rsl = $msgArray->getMsgArray(1,"db error!",[],"error");
        }
        return $rsl;
    }

    //删除用户信息
    public function delUserMsg($arg_param){

    }

    //添加用户
    public function addUserMsg(){
    }

}
