<?php
/**
 * Created by PhpStorm.
 * User: Ellon_Wong
 * Date: 14-3-15
 * Time: 下午3:31
 */

function MsgReturn($arg_code,$arg_msg,$arg_data,$arg_status){
    return array("code"=>$arg_code,"msg"=>$arg_msg,"data"=>$arg_data,"status"=>$arg_status);
}