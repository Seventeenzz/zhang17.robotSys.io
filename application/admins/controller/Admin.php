<?php
/**
 * Created by PhpStorm.
 * User: James
 * Date: 2019/4/14
 * Time: 12:24
 * 管理员列表
 */

namespace app\admins\controller;

use think\Controller;
use Util\data\Sysdb;

class Admin extends BaseAdmin
{
    //管理员列表
    public function index(){
        $data['lists'] = $this->db->table('user_admin')->lists();
        //加载角色
        $data['groups'] = $this->db->table('admin_groups')->cates('gid');
        $this->assign('data', $data);
        return $this->fetch();
    }

    //添加管理员
    public function add(){
        $id = (int)input('get.id');
        //加载管理员
        $data['item'] = $this->db->table('user_admin')->where(array('id'=>$id))->item();
        //加载角色
        $data['groups'] = $this->db->table('admin_groups')->cates('gid');
        $this->assign('data', $data);
        return $this->fetch();
    }

//    保存管理员
    public function save(){
        $id = (int)input('post.id');
        $data['username'] = trim(input('post.username'));
        $data['gid'] = (int)input('post.gid');
        $password = trim(input('post.pwd'));
        $data['truename'] = trim(input('post.truename'));
        $data['user_img'] = trim(input('post.img'));
        $data['status'] = (int)input('post.status');

        if (!$data['username']){
            exit(json_encode(array('code' => 1, 'msg' => '用户名不能为空')));
        }
        if (!$data['gid']){
            exit(json_encode(array('code' => 1, 'msg' => '角色不能为空')));
        }
        if ($id==0 && !$password){
            exit(json_encode(array('code' => 1, 'msg' => '密码不能为空')));
        }
        if (!$data['truename']){
            exit(json_encode(array('code' => 1, 'msg' => '姓名不能为空')));
        }

        //密码处理
        if ($password){
            $data['password'] = md5($data['username'].$password);
        }

        $res = true;
        if ($id == 0){
            //检查用户是否存在
            $item = $this->db->table('user_admin')->where(array('username'=>$data['username']))->item();
            if ($item){
                exit(json_encode(array('code' => 1, 'msg' => '该用户已存在')));
            }
            //保存用户
            $data['add_time'] = time();
            $res = $this->db->table('user_admin')->insert($data);
        }else{
            $this->db->table('user_admin')->where(array('id'=>$id))->update($data);
        }

        if (!$res){
            exit(json_encode(array('code' => 1, 'msg' => '保存失败')));
        }
        exit(json_encode(array('code' => 0, 'msg' => '保存成功')));
    }

    //删除管理员
    public function delete(){
        $id = (int)input('post.id');
        $res = $this->db->table('user_admin')->where(array('id'=>$id))->delete();
        if (!$res){
            exit(json_encode(array('code' => 1, 'msg' => '删除失败')));
        }
        exit(json_encode(array('code' => 0, 'msg' => '删除成功')));
    }

}