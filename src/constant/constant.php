<?php
/**
 * Created by PhpStorm.
 * User: Ellon_Wong
 * Date: 14-3-15
 * Time: 下午3:31
 */

include_once dirname(__FILE__) . '/../../lib/Log4PHP/Log4PHP.php';
global $log;
$log=Log4PHP::getLogger("MsgArray");

class MsgArray
{

    public static function getMsgArray($arg_code,$arg_msg,$arg_data,$arg_status){
        global $log;
        if($arg_code!=0){
            if($arg_status=="Error"){
                $log->error("code:".$arg_code.",msg:".$arg_msg.",data:".json_encode($arg_data).",status:".$arg_status);
            }else{
                $log->warn("code:".$arg_code.",msg:".$arg_msg.",data:".json_encode($arg_data).",status:".$arg_status);
            }
        }else{
        $log->info("code:".$arg_code.",msg:".$arg_msg.",data:".json_encode($arg_data).",status:".$arg_status);
        }
        return array("code"=>$arg_code,"msg"=>$arg_msg,"data"=>$arg_data,"status"=>$arg_status);
    }
}