superCatering
=============
获取全部商家信息接口
url："../src/CateringInfo/CateringInfo_Handle.php"
请求方式：GET
请求参数：
{
    "route" : "CateringInfo/getAllCateringInfo"
}
返回：
成功：
{
    "code": 0,
    "msg":"获取成功",
    "data" : [
                       {
             	     "ID":1,
             	     "NAME":"麦当劳" ,     //商店名称
             	     "MARK":12,            //商店描述
             	     "PHONE":"13826480235" //商店电话
             	     "URL":"",             //图片url
                       }
                    ],
    "status":"Success"
}
失败：
{
   "code" : 1,
   "msg" : "返回信息",
   "data " : []
   "status": "Warn/Error"
}

获取商店菜色接口
url："../src/CateringInfo/CateringInfo_Handle.php"
请求方式：POST
请求参数：
{
    "route" : "CateringInfo/getCateringInfo",
    "cateringId" : 1,
}
返回：
成功：
{
    "code": 0,
    "msg":"获取成功",
    "data" : [
                         "ID":90001,
                 	     "phote":".\/dish_photo\/maixiangji_90001." ,     //图片url
                 	     "name":"苹果派",            //菜色名称
                 	     "price":"7元" //菜色价格

             ],
    "status":"Success"
}
失败：
{
   "code" : 1,
   "msg" : "返回信息",
   "data " : []
   "status": "Warn/Error"
}


