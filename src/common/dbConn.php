<?php
/**
 * Created by PhpStorm.
 * User: Ellon_Wong
 * Date: 14-3-16
 * Time: 下午3:40
 */



include_once dirname(__FILE__) . '/../../lib/Log4PHP/Log4PHP.php';


const db_ip="127.0.0.1";
const db_port="3306";
const db_account="superCatering";
const db_password="4superCatering";
const db_name="superCatering";

global $log;
$log = Log4PHP::getLogger("dbConnect");

function connectDatabase(){
    global $log;
    $log->info("start connect database");

    try {
        $dbHost = 'mysql:host='.db_ip.';port='.db_port.';dbname='.db_name.";charset=UTF8";
        $log->info("connect host:".$dbHost);
        $log->info("db user name:".db_account);
        $log->info("db user pwd:".db_password);
        $dbh = new PDO($dbHost,db_account, db_password, array( PDO::ATTR_PERSISTENT => false));
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        $log->error("connect database Catch error:".$e->getMessage());
        $dbh=null;
    }
    $log->info("finish connect database");
    return $dbh;
}



