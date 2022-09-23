<?php
/**
 * Created by PhpStorm.
 * User: James
 * Date: 2019/5/22
 * Time: 20:43
 */

namespace app\admins\controller;
use think\Controller;
use Util\data\Sysdb;

class Build extends BaseAdmin
{
    public function check(){
        $data['member'] = $this->db->table('user_member')->lists();
        $data['check'] = $this->db->table('check')->lists();
        $this->assign('check', $data['check']);
        return $this->fetch();
    }

    //添加数据
    public function add(){
//        $id = (int)input('get.id');
//        //加载数据
//        $data['item'] = $this->db->table('user_member')->where(array('id'=>$id))->item();
//        $this->assign('data', $data);
        return $this->fetch();
    }

    public function exhibit(){
        $this->fetch();
    }
}