<?php

namespace app\admin\controller;

use app\common\controller\Base;
use think\Request;

class Everyone extends Base {

    /**
     * @title 退出
     */
    public function logout() {

        cookie('admin', null);

        session('admin', null);
        $host=Request::instance();
        $domain=$host->domain();
        $domainAll=$domain.'/sy-admin.php';
        return ['msg'=>'退出成功','code'=>0,'url'=>$domainAll];
    }

    /**
     * @title 登录
     * @return type
     */

    public function login() {
        return $this->view->fetch('everyone/login');
    }

    public function loginCheck()
    {
        $host=Request::instance();
        $domain=$host->domain();
        $domainAll=$domain.'/sy-admin.php';

        if (request()->isPost()) {
            //  后端验证
            $post = request()->param();

            $account = $post['account'] ;
            $password = $post['password'];
            $one = db('system_user')
                ->where('account', $account)
                ->where('password', my_md5($password))
                ->field('id,account,nickname')
                ->find();

            if ($one) {
                // 保存session
                session('admin_session_sign', data_auth_sign($one));
                // 保存cookie
                cookie('admin', authcode(json_encode($one), 'ENCODE', 'XinYiXuan'));
//                $this->success('登录成功!!!','index/index');

                $msg='登录成功';$url=$domainAll;$code=0;

            } else {
//                $this->error( '用户不存在');
                $msg='用户不存在';$url=$domainAll.'/everyone/login';$code=1;
            }

        }else {
            $msg='用户不存在';$url=$domainAll.'/everyone/login';$code=1;
        }
        return ['msg'=>$msg,'url'=>$url,'code'=>$code];
    }


    public function aaa(){
        $host=Request::instance();
        $domain=$host->domain();
        $domainAll=$domain.'/sy-admin.php';

        dump($domainAll);
    }

    public function loginA() {
        if (request()->isPost()) {
            //  后端验证
            $post = request()->post();
            dump($post);
            foreach ($post as $key => $value) {
                $post[$key] = trim($value);
            }
            $msg = model('system_user')->login($post);
            if ($msg) {
                $this->success('123', url('admin/index/index'));
            } else {
                $this->error($msg);
            }
        } else {

            return $this->view->fetch('everyone/login');
        }
    }






}
