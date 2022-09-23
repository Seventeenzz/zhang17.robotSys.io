<?php
/**
 * Created by PhpStorm.
 * User: James
 * Date: 2019/4/21
 * Time: 13:36
 */

namespace app\admins\controller;
use think\Controller;
use Util\data\Sysdb;


class uploads extends BaseAdmin
{
    //图片上传
    public function upload_img(){
        $file = request()->file('file');
        if ($file == null){
            exit(json_encode(array('code'=>1, 'msg'=>'没有文件上传')));
        }
        $info = $file->move(ROOT_PATH.'public'.DS.'uploads');
        $ext = ($info->getExtension());
        if (!in_array($ext, array('jpg', 'jpeg', 'gif', 'png'))){
            exit(json_encode(array('code'=>1, 'msg'=>'文件格式不支持')));
        }
        $img = '/uploads/'.$info->getSaveName();
        exit(json_encode(array('code'=>1, 'msg'=>$img)));
    }
}