<?php
/**
 * Created by PhpStorm.
 * User: James
 * Date: 2019/4/12
 * Time: 17:03
 */
namespace app\admins\controller;
use think\Controller;
use Util\data\Sysdb;

class Account extends Controller
{

    public function login(){

        return $this->fetch();
    }

    //管理员登陆
    public function dologin(){
        $username = trim(input('post.username'));
        $pwd = trim(input('post.pwd'));
        $verirycode = trim(input('post.verirycode'));

//        return $verirycode;
        if ($username == ''){
            exit(json_encode(array('code' => 1, 'msg' => '用户名不能为空')));
        }
        if ($pwd == ''){
            exit(json_encode(array('code' => 1, 'msg' => '密码不能为空')));
        }
        if ($verirycode == ''){
            exit(json_encode(array('code' => 1, 'msg' => '验证码不能为空')));
        }
        //验证验证码

        if (!captcha_check($verirycode)){
            exit(json_encode(array('code' => 1, 'msg' => '验证码错误')));
        }

        //验证用户
        $this->db = new Sysdb;
        $admin = $this->db->table('user_admin')->where(array('username'=>$username))->item();

        if (!$admin){
            exit(json_encode(array('code' => 1, 'msg' => '用户不存在')));
        }
        if (md5($pwd) != $admin['password']){
            exit(json_encode(array('code' => 1, 'msg' => '密码错误')));
        }
        if ($admin['status'] == 1){
            exit(json_encode(array('code' => 1, 'msg' => '该用户已被禁用')));
        }
        //设置用户的session
        session('admin', $admin);
        exit(json_encode(array('code' => 0, 'msg' => '登录成功')));
    }

    //退出
    public function logout(){
        session('admin', null);
        exit(json_encode(array('code' => 0, 'msg' => '退出成功')));
    }

}

