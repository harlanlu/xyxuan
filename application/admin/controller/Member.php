<?php

namespace app\admin\controller;

class Member extends Admin {
    
    
    /**
     * @title 推荐/置顶/分类转移
     */
    public function set_field() {

        $ids = input('post.ids');
        $field = input('get.field');
        $value = input('get.value');

        empty($field) && $this->error('更新的字段为空');

        $ids_arr = explode(',', $ids);
        $ids_arr = array_filter($ids_arr);

        if (empty($ids_arr)) {
            $this->error('选择要操作的数据');
        }

        $affect_rows = db('member')->where('id', 'in', $ids)->setField($field, $value);

        if ($affect_rows) {
            $this->success('操作成功');
        } else {
            $this->error('没有任何更新');
        }
    }

    /**
     * @title 会员列表
     * @return type
     */
    public function index() {

        $lists = model('member')->model_where()->paginate(10, false, ['query' => request()->get()]);
        $this->assign('pager', $lists->render());
        $this->assign('lists', $lists);


        builder('list')
                ->addItem('id', 'ID')
                ->addItem('email', '账号')
                ->addItem('nickname', '昵称')
                ->addItem('avatar', '头像', 'image')
                ->addItem('sex', '性别','sex')
                ->addItem('points', '积分')
                ->addItem('vip', 'VIP')
                ->addItem('identification', '认证信息')
                ->addItem('create_time', '注册')
                ->addItem('update_time', '更新')
                ->addAction('删除', 'delete', '', 'ajax-get confirm layui-btn-danger btnn',' onclick="del(this)" ')
                ->addAction('积分', 'points', '', 'openbox layui-btn-normal')
                ->addAction('认证', 'ident_one', '', 'openbox layui-btn-success')
                ->build();


        return view();
    }

    /**
     * @title 前台会员认证
     */

    public function ident($id,$tid) {
        // id->user_id   tid->apply_article_id
        empty($id) && $this->error('参数缺失');
        empty($tid) && $this->error('参数缺失');
        // 加载认证信息
        if (request()->isPost()) {
            $ident_1=request()->param('ident');
            if ($ident_1==0){
                try {
                    // ju jue
                    db('apply_identify')->where('id',$tid)->update(['status'=>-1,'dotime'=>time()]);
                }catch (\Exception $e){}
                $u=db('member')->where('id',$id)->update(['ident'=>0]);
                $i=db('member_ident')->where('member_id',$id)->update(['identification'=>'']);
                if (!empty($u)&&!empty($i)) {
                    $this->success('更新成功...');
                } else {
                    $this->success('更新成功...');
                }
            }else{
                $post = request()->post();
                try {
                    //tong yi
                    db('apply_identify')->where('id',$tid)->update(['status'=>1,'dotime'=>time()]);
                }catch (\Exception $e){}
                if ($post['identification']==''){
                    $this->success('请填写认证信息！');exit();
                }
                $msg = model('member')->ident($post, $id);
                if (empty($msg)) {
                    $this->success('更新成功');
                } else {
                    $this->success('更新失败');
                }
            }

        } else {
            $wheres = [
                ['a.id', '=', $id]
            ];
            $one = model('member')->model_where($wheres)->find()->toArray();
            $this->assign($one);
            $this->assign('one',$one);
            return view();
        }
    }

    //原始---
    public function ident_one($id) {
        empty($id) && $this->error('参数缺失');
        // 加载认证信息
        if (request()->isPost()) {
                $post = request()->post();
                $msg = model('member')->ident($post, $id);
                if (empty($msg)) {
                    $this->success('更新成功');
                } else {
                    $this->success('更新失败');
                }
        } else {
            $wheres = [
                    ['a.id', '=', $id]
            ];
            $one = model('member')->model_where($wheres)->find()->toArray();
            $this->assign($one);
            return view('member/ident');
        }
    }


    /**
     * @title 会员申请认证列表
     * @return type
     */
    public function apply_identify() {
        //待处理
        $lists1 = db('apply_identify')->where('status',0)->order('write_time','desc')->paginate(10, false, ['query' => request()->get()]);
        $this->assign('pager1', $lists1->render());
        $this->assign('lists1', $lists1);
        $c1 = db('apply_identify')->where('status',0)->count();//sum
        $this->assign('c1', $c1);

        //已同意
        $lists2 = db('apply_identify')->where('status',1)->order('write_time','desc')->paginate(10, false, ['query' => request()->get()]);
        $this->assign('pager2', $lists2->render());
        $this->assign('lists2', $lists2);
        $c2 = db('apply_identify')->where('status',1)->count();//sum
        $this->assign('c2', $c2);

        //已拒绝
        $lists3 = db('apply_identify')->where('status',-1)->order('write_time','desc')->paginate(10, false, ['query' => request()->get()]);
        $this->assign('pager3', $lists3->render());
        $this->assign('lists3', $lists3);
        $c3 = db('apply_identify')->where('status',-1)->count();//sum
        $this->assign('c3', $c3);


        return view('member/apply_identify');
    }

    public function see_apply_info($id){
        $info=db('apply_identify')->where('id',$id)->find();
        $this->assign('info',$info);
        return view('member/see_apply_info');

    }

    public function apply_refuse($id) {
        empty($id) && $this->error('参数缺失');
        // 加载认证信息
        if (request()->isPost()) {
            $con['msg'] = request()->param('msg');
            $con['status']=-1;
            $con['dotime']=time();
            $msg = db('apply_identify')->where('id',$id)->update($con);
            if (!empty($msg)) {
                $this->success('发送成功');
            } else {
                $this->error('内容未改变');
            }
        } else {
            $one = db('apply_identify')->where('id',$id)->find();
            $this->assign('one',$one);
            return view();
        }
    }

    public function apply_delete($id){
        $one = db('apply_identify')->where('id',$id)->delete();
        $this->success('删除成功');

    }





    public function points($id) {
        empty($id) && $this->error('参数缺失');
        // 加载
        if (request()->isPost()) {
            $post = request()->post();
            $msg = model('member')->points($post, $id);
            if (empty($msg)) {
                $this->success('修改成功');
            } else {
                $this->success('修改失败');
            }
        } else {
            $wheres = [
                ['a.id', '=', $id]
            ];
            $one = model('member')->model_where($wheres)->find()->toArray();
            $this->assign($one);
            return view();
        }
    }

    public function delete() {
        // 加载

            $post = request()->param('id');
            $msg = db('member')->where('id','=',$post)->delete();
            $msg=1;
            if ($msg) {
                $this->success('删除成功','member/index');
            } else {
                $this->error('删除失败');
            }
            return view();

    }

    public function json() {

        return model('member')->json();
    }

    public function buy(){
        //收入
        $ru=db('buy_art')->where('status','=',1)->order('dotime','desc')->paginate(10, false, ['query' => request()->get()]);
        $ru_num=db('buy_art')->where('status','=',1)->count();
        $this->assign('ru',$ru);
        $this->assign('pager1', $ru->render());
        $this->assign('ru_num',$ru_num);
        //支出
//        $chu=db('buy_art')->where('status','=',0)->order('dotime','desc')->paginate(10, false, ['query' => request()->get()]);
//        $chu_num=db('buy_art')->where('status','=',0)->count();
//        $this->assign('chu',$chu);
//        $this->assign('pager2', $chu->render());
//        $this->assign('chu_num',$chu_num);
        return view('member/buy');
    }
}
