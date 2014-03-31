<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jun
 * Date: 14-3-21
 * Time: 上午2:04
 * To change this template use File | Settings | File Templates.
 */
include_once dirname(__FILE__) . '/../constant/constant.php';
include_once dirname(__FILE__) . '/../../lib/Log4PHP/Log4PHP.php';
include_once( "../common/dbConn.php");

//获取数据库连接
$db = connectDatabase();
$log = Log4PHP::getLogger("CateringInfoLog");
class DbCrud{

    public function dbSelect($arg_sql){
        try{
            global $db;
            global $log;
            $rs_cursor = $db->query($arg_sql);
            $rs_cursor->setFetchMode(PDO::FETCH_ASSOC);
            $rs = $rs_cursor->fetchAll();

        }catch (Exception $e){
            $log->error("ywluojun异常代码:".$e->$e->getCode());
            $log->error("ywluojun异常:".$e->getMessage());
            $rs="error";
        }
        return $rs;
    }

    public  function dbExec($arg_sql){
        try{
            $msg = "success";
            global $db;
            global $log;
            $db->exec($arg_sql);
        }catch (Exception $e){
            $msg = "error";
            $log->error("ywluojun异常代码:".$e->getCode());
            $log->error("ywluojun异常:".$e->getMessage());
        }
        return $msg;
    }

}