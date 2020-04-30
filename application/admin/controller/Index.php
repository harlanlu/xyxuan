<?php

namespace app\admin\controller;

class Index extends Admin {

    public function index() {

        $admin = admin_is_login();

        $this->assign('admin', $admin);

        return view();
    }

    public function home() {
        $user=db('member')->count();
        $thread=db('thread')->count();
        $ident=db('member')->where('ident','=',1)->count();
        $apply_identify=db('apply_identify')->where('status','=',0)->count();
        $art=db('buy_art')->where('status','=',1)->count();
        $this->assign('user',$user);//用户总数
        $this->assign('thread',$thread);//作品总数
        $this->assign('ident',$ident);//已认证用户
        $this->assign('apply_identify',$apply_identify);//待处理认证
        $this->assign('art',$art);//售出作品
        return view();
    }

}
