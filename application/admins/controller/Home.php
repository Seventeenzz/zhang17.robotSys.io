<?php
/**
 * Created by PhpStorm.
 * User: James
 * Date: 2019/4/13
 * Time: 22:00
 * 后台首页
 */

namespace app\admins\controller;

use think\Controller;
use Util\data\Sysdb;

class Home extends BaseAdmin
{
//    主页面
    public function index(){
//        $menus = false;
        $data['role']= $this->db->table('admin_groups')->where(array('gid'=>$this->_admin['gid']))->item();
        $data['admin'] = $this->db->table('user_admin')->where(array('id'=>$this->_admin['id']))->item();
//        if ($role){
//            $role['rights'] = (isset($role['rights']) && $role['rights']) ? json_decode($role['rights'],true) : [];
//        }
//        if ($role['rights']){
////            $where = 'mid in('.implode(',',$role['rights']).') and ishidden=0 and status=0';
//            $menus = $this->db->table('admin_menus')->where(array('ishidden'=>0,'status'=>0))->cates('mid');
//            $menus && $menus = $this->gettreeitems($menus);
//        }
//        $site = $this->db->table('sites')->where(array('names'=>'site'))->item();
//        $site && $site['values'] = json_decode($site['values']);
//        $this->assign('site',$site);
        $this->assign('data',$data);
//        $this->assign('menus',$menus);
        return $this->fetch();
    }


//    欢迎页面
    public function welcome(){
        return $this->fetch();
    }
}