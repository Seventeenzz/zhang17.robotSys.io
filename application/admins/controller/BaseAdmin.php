<?php
/**
 * Created by PhpStorm.
 * User: James
 * Date: 2019/4/13
 * Time: 22:02
 */

namespace app\admins\controller;


use think\Controller;
use Util\data\Sysdb;

class BaseAdmin extends Controller
{
    public function __construct(){
        parent::__construct();
        $this->_admin = session('admin');
        //未登录的用户不允许访问
        if (!$this->_admin){
            header('Location: /admins.php/admins/Account/login');
            exit;
        }
        $this->assign('admin',$this->_admin);
        $this->db = new Sysdb;

        //判断用户是否有权限
    }
}