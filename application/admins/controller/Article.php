<?php
/**
 * Created by PhpStorm.
 * User: James
 * Date: 2019/4/21
 * Time: 15:10
 */

namespace app\admins\controller;
use think\Controller;
use Util\data\Sysdb;

class Article extends BaseAdmin
{
    public function index(){
        $data['article'] = $this->db->table('article')->lists();
        $data['type'] = $this->db->table('article_type')->cates('tid');
        $this->assign('data', $data);
        return $this->fetch();
    }
    //文章类型管理
    public function type(){
        $this->fetch();
    }

    //查看文章
    public function look(){
        $id = (int)input('get.id');
        //加载文章
        $data['article'] = $this->db->table('article')->where(array('aid'=>$id))->item();
        $data['type'] = $this->db->table('article_type')->cates('tid');
        //加载角色
        $this->assign('data', $data);
        $this->fetch();
    }

    //添加文章
    public function add(){
        $id = (int)input('get.id');
        //加载文章
        $data['article'] = $this->db->table('article')->where(array('aid'=>$id))->item();
        $data['type'] = $this->db->table('article_type')->cates('tid');
        //加载角色
        $this->assign('data', $data);
        return $this->fetch();
    }

    //    保存文章
    public function save(){
        $aid = (int)input('post.aid');
        $data['title'] = trim(input('post.title'));
        $data['author'] = trim(input('post.author'));
        $data['content'] = trim(input('post.content'));
        $data['tid'] = (int)input('post.tid');
        $data['status'] = (int)input('post.status');
        if (!$data['title']){
            exit(json_encode(array('code' => 1, 'msg' => '标题不能为空')));
        }
        if (!$data['author']){
            exit(json_encode(array('code' => 1, 'msg' => '作者不能为空')));
        }
        if (!$data['content']){
            exit(json_encode(array('code' => 1, 'msg' => '内容不能为空')));
        }
        if (!$data['tid']){
            exit(json_encode(array('code' => 1, 'msg' => '类型不能为空')));
        }

        $res = true;
        if ($aid == 0){
            //检查文章是否存在
            $item = $this->db->table('article')->where(array('title'=>$data['title']))->item();
            if ($item){
                exit(json_encode(array('code' => 1, 'msg' => '该标题已存在')));
            }
            //保存文章
            $data['add_time'] = time();
            $res = $this->db->table('article')->insert($data);
        }else{
            $this->db->table('article')->where(array('aid'=>$aid))->update($data);
        }

        if (!$res){
            exit(json_encode(array('code' => 1, 'msg' => '保存失败')));
        }
        exit(json_encode(array('code' => 0, 'msg' => '保存成功')));
    }

}