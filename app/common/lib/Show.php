<?php
namespace app\common\lib;
//通用的api返回格式
class Show {
    public static function success($message='OK',$data=[]){
        $result = [
            'status'=>config('status.success'),
            'message'=>$message,
            'result'=>$data
        ];
        return json($result);
    }
    public static function error($message,$status=0,$data=[]){
        $result = [
            'status'=>$status,
            'message'=>$message,
            'result'=>$data
        ];
        return json($result);
    }
}