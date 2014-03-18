superCatering
=============

url：http://127.0.0.1:8765/CateringInfo/getCateringInfo/
请求方式：POST
请求参数：
{
    "cateringId" : 1,
    "userPhoneNum": "18825419508",
}
返回：
成功：
{
    "code": 0,
    "msg":"Success",
    "data" : [
                       {
             	     "id":1,
             	     "name":"麦当劳" ,//商店名称
             	     "mark":"麦当劳快餐",  //商店描述
             	     "phone":"13826480235" //商店电话
             	     "url":"",       //图片url
                       }
                    ],
    "status":"Success"
}
失败：
{
   "code" : 1,
   "msg" : "返回信息",
   "data " : []
   "status": "Warn"
}


