<?php
/**
 * Created by PhpStorm.
 * User: Ellon_Wong
 * Date: 14-3-16
 * Time: 下午3:56
 */

require_once 'PHPUnit\Framework\TestCase.php';
include_once dirname(__FILE__) .'/../dbConn.php';
include_once dirname(__FILE__) .'/../../../lib/Log4PHP/Log4PHP.php';

class TestPemsTranc extends PHPUnit_Framework_TestCase{

    protected function setUp(){

    }

    function testConnectDatabase(){
        $unExpect = null;
        $actual=connectDatabase();
        $this->assertNotEquals($unExpect,$actual,"connectDatabase Success");
    }

}