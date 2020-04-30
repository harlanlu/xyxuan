<?php

namespace app\index\controller;

use app\common\controller\Base;
use think\Request;
use PHPMailer\SendEmail;
class Everyone extends Base {
    
    
    public function test(){
        
        $lists = db('member')->select();
        
        foreach ($lists as $key => $value) {
            db('member')->where('id',$value['id'])->setField('password', my_md5($value['password']));
        }
        echo 'ok';
    }
    

    /**
     * @title 签到活跃榜（异步）
     */
    public function sign_top() {

        // 今天0点0分0秒时间戳
        $today = strtotime(date("Y-m-d", time()));

        // 最新签到
        $lists_new = db('member_sign')
                ->alias('a')
                ->field('a.member_id as uid,a.num as days,a.create_time as time,m.nickname,m.avatar,max(a.create_time) as max_time')
                ->where('a.create_time', '>', $today)
                ->join('member m', 'm.id = a.member_id', 'LEFT')
                ->order('a.create_time desc')
                ->group('a.member_id,a.num,a.create_time,m.nickname,m.avatar')
                ->limit(20)
                ->select();
        foreach ($lists_new as $key => $value) {
            if (!empty($value['avatar']))
                $lists_new[$key]['avatar'] = res_http($value['avatar']);
            else
                $lists_new[$key]['avatar'] = res_http('avatar.jpg');
        }
        // 今日最快
        $lists_new2 = db('member_sign')
                ->alias('a')
                ->field('a.member_id as uid,a.num as days,a.create_time as time,m.nickname,m.avatar,max(a.create_time) as max_time')
                ->where('a.create_time', '>', $today)
                ->join('member m', 'm.id = a.member_id', 'LEFT')
                ->order('a.create_time asc')
                ->group('a.member_id,a.num,a.create_time,m.nickname,m.avatar')
                ->limit(20)
                ->select();
        foreach ($lists_new2 as $key => $value) {
            if (!empty($value['avatar']))
                $lists_new2[$key]['avatar'] = res_http($value['avatar']);
            else
                $lists_new2[$key]['avatar'] = res_http('avatar.jpg');
        }


        // 签到最多
        $lists_new3 = db('member_sign')
                ->alias('a')
                ->field('a.member_id as uid,a.num as days,a.create_time as time,m.nickname,m.avatar,max(a.num) as max_num')
                ->where('a.create_time', '>', $today)
                ->join('member m', 'm.id = a.member_id', 'LEFT')
                ->order('a.num desc')
                ->group('a.member_id,a.num,a.create_time,m.nickname,m.avatar')
                ->limit(20)
                ->select();
        foreach ($lists_new3 as $key => $value) {
            if (!empty($value['avatar']))
                $lists_new3[$key]['avatar'] = res_http($value['avatar']);
            else
                $lists_new3[$key]['avatar'] = res_http('avatar.jpg');
        }

        return ['code' => 0, 'msg' => '', 'data' => [$lists_new, $lists_new2, $lists_new3]];
    }

    /**
     * @title 个人主页
     */
    public function portal($id) {



        $member = member_is_login();
        if (is_array($member)) {
            $member_id = $member['id'];
        } else {
            $member_id = 0;
        }

        if (empty($id)) {

            if ($member_id)
                $id = $member_id;
            else
                exit;
        }

        $wheres[] = ['a.id', '=', $id];
        $one = model('member')->model_where($wheres)->find()->toArray();

        $one['follow_type'] = model('member_follow')->follow_type($one['id'], $member_id);

        $this->assign($one);


        // 加载最近的帖子
        $recent_thread_lists = model('thread')->where('member_id', $id)->limit(20)->select();
        $this->assign('recent_thread_lists', $recent_thread_lists);


        // 加载最近的回答
        $where = [
                ['a.member_id', '=', $id]
        ];
        $recent_comment_lists = model('thread_comment')->model_where($where)->limit(10)->select();
        $this->assign('recent_comment_lists', $recent_comment_lists);
        $this->assign('mytitle', $one['nickname'].'的主页');

        return view();
    }

    public function index() {


        return view();
    }

    /**
     * @title 忘记密码
     * @return type
     */
    public function forget() {

        return view();
    }

    public function send_mail(){

        if(request()->isPost()){
//            unset(request()->param('vercode'));
            $mail=request()->param('email');
            $email = $this->injectChk(stripslashes(trim($mail)));
//            dump($mail);
            $res=db('member')->where('email','=',$email)->find();
            if (is_null($res)) {//该邮箱尚未注册！
                 $msg='该邮箱尚未注册！';
                $code= -1;
                exit;
            } else {
                $uid = $res['id'];
                $token = md5($uid . $res['nickname'] . $res['password']);
                $request = Request::instance();
                $domain = $request->domain();
                $time = time();
                $url = $domain."/everyone/reset?key=".time() .'&e='. $email .'&value='.md5('123'). "&token=" . $token.'&rkey='.md5('456');
                $title='新意轩摄影-重置密码';
                $body="尊敬的".$res['nickname'].":<br>"."请点击链接： <a href='".$url."' style='color:red;text-decoration: none;' >".'重置密码</a><br><br><p>链接有效期为10分钟，请及时重置密码！</p><pre>'.$domain.'</pre>';
                $result = SendEmail::SendEmail($title, $body,$email );
                if ($result == 1) {//邮件发送成功
                    db('member')->where('email','=',$email)->update(['email_time'=>$time]);
                    $msg = '系统已向您的邮箱发送了一封邮件<br/>请登录到您的邮箱及时重置您的密码！';
                    $code= 0;
                } else {
                    $msg = $result;
                    $code=-1;
                }
            return json(['code'=>$code,'msg'=>$msg]);
            }
        }
    }
    public function reset()
    {
//        $a=Request::param();
        $request = Request::instance();
        $domain = $request->domain();
        $token = stripslashes(trim($_GET['token']));
        $email = stripslashes(trim($_GET['e']));
        $res=db('member')->where('email','=',$email)->find();
        $this->view->assign('user',$res);
//        dump($res);
        if($res){
            $mt = md5($res['id'].$res['nickname'].$res['password']);
            if($mt==$token){
                if(time()-$res['email_time']>10*60){
                    $msg = '<p style="text-align: center;margin-top: 200px;color:red;">该链接已过期,请重新获取！</p>';
                }else{
                    //重置密码...
                    $msg = '请重新设置密码，显示重置密码表单，<br/>这里只是演示，略过。';
                    $msg1=<<<EOF
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>重置密码</title>
    <style>
        body{background: url("/static/bg.png") no-repeat fixed center;}
    </style>
</head>
<body>
<div style="text-align: center;margin-top: 100px;">
    <h5>请输入新密码</h5>
EOF;
                    $msg2='<form action="'.$domain.'/everyone/doreset" method="post">';
                    $msg3='<p><span>姓名：</span><input name="name" type="text" value="'.$res['nickname'].'" readonly ></p><p><span >邮箱：</span><input name="email" type="text"  value="'.$email.'" readonly ></p>';
                    $msg4=<<<EOF
<p><span >密码：</span><input name="password" id="psd" type="text"  value="" ></p>
        <button id="sub" type="submit" style="width: 100px;background: #a8d1d6;">提交</button>
    </form>
</div>
</body>
<script src="/static/js/jquery-3.4.1.js"></script>
<script >
$('#psd').blur(function() {
            var reg = /^[\w]{6,20}$/;
            if(!($('#psd').val().match(reg))){
                document.getElementById("sub").disabled=true;
                alert('密码长度为6~20位，且不能含有特殊字符~'); 
                
            }else {
                document.getElementById("sub").disabled=false;
            }
        });
</script>
</html>
EOF;
                    $msg =$msg1.$msg2.$msg3.$msg4;
                }
            }else{
                $msg =  '<p style="text-align: center;margin-top: 200px;color:red;">无效的链接！</p><br/>';
            }
        }else{
            $msg =  '错误的链接！';
        }
        echo htmlspecialchars_decode($msg);
    }

    public function injectChk($sql_str) { //防止注入
        $getfilter='/select|insert|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile/';
        $check = preg_match($getfilter, $sql_str);
        if ($check) {
            echo('非法字符串');
            exit();
        } else {
            return $sql_str;
        }
    }

    public function doreset()
    {

        if(request()->isPost())
        {
            $data=request()->param();
            $email = stripslashes(trim($data['email']));
            $p = stripslashes(trim($data['password']));
            $rule = [
                'password'=>'require|alphaDash|length:6,20',
                'name'=>'require','email'=>'require',
            ];
            $msg = [
                'password.require'    => '密码不能为空','password.length'=>"密码请设置6~20个字符",
                'password.alphaDash'        => '密码格式只能是字母、数字'
            ];
            $validate = new \think\Validate($rule,$msg);
            if (!$validate->check($data)) {
                $this->error('重置失败：' . $validate->getError());
            }else{
                $psd=my_md5($p);
                $res=db('member')->where('email','=',$email)->find();
                if ($res) {
                    if(time()-$res['email_time']>10*60){
                        $this->error('链接已过期，请重新获取！','everyone/login');
                    }else{
                        //重置密码...
                        db('member')->where('email','=',$email)->update(['password'=>$psd]);
                        $this->success('修改成功！','everyone/login');
                    }
                }else{
                    $this->error('请求错误！','everyone/login');
                }
            }

        }else{
            $this->error('请求错误！','everyone/login');
        }

    }



    /**
     * @title 退出
     */
    public function logout() {

        cookie('member', null);

         session('member', null);

        $this->redirect('index/everyone/login');
    }

    /**
     * @title 登录
     * @return type
     */
    public function login() {


        if (request()->isPost()) {

            //  后端验证
            $post = request()->post();
            foreach ($post as $key => $value) {
                $post[$key] = trim($value);
            }

            // 验证码
//            if (!captcha_check($post['vercode'])) {
//            $msg='验证码输错了！';$code=1;$url=url('login');
//            }


            $msg = model('member')->login($post);
            if (empty($msg)) {
                    $msg='登录成功！';$code=0;$url=url('/member');
            } else {
                $msg='账号或密码错误！';$code=1;$url=url('login');
            }
        } else {
            return view();
        }
        $this->assign('mytitle', '登录');

        return ['msg'=>$msg,'code'=>$code,'url'=>$url];
    }

    /**
     * @title 新注册用户激活账号
     */
    public function activate() {

        $code = input('get.code', '');

        if ($code) {

            $affect_rows = db('member')->where('active_code', $code)->setField('status', 1);

            if ($affect_rows) {
                $this->success('激活成功', config('base.domain'));
            } else {
                $this->error('已经激活过了');
            }
        }
    }


    /**
     * @title 注册 
     */
    public function reg() {



        if (request()->isPost()) {
            $this->assign('mytitle', '注册');


            //  后端验证
            $post = request()->post();
            foreach ($post as $key => $value) {
                $post[$key] = trim($value);
            }

            // 验证码
            if (!captcha_check($post['vercode'])) {
                $this->error('验证码输错了');
            }

            //
            $email_count = db('member')->where('email', $post['email'])->count();
            if ($email_count) {
                $this->error('你填写的邮箱已经被注册了');
            }
            $nickname_count = db('member')->where('nickname', $post['nickname'])->count();
            if ($nickname_count) {
                $this->error('你填写的昵称已经被其他人使用了');
            }
            $msg = model('member')->reg($post);
//            if (is_numeric($msg)) {
//                $this->success('注册成功', url('index/everyone/login'));
            if (is_numeric($msg) && $msg > 0) {

                $nickname = $post['nickname'];
                $email = $post['email'];
                $active_code = substr(md5($msg . uniqid()), 8, 16);

                db('member')->where('id', $msg)->setField('active_code', $active_code);

                $returnEmail = sendRegEmail($nickname, $email, $active_code);

                if (is_bool($returnEmail) && $returnEmail) {
                    $mail = explode('@', $email)[1];
                    $this->success('注册成功，邮箱账号是：' . $email . '<br />请<a href="http://mail' . $mail . ' ">进入邮箱</a>完成激活', '');
                } else {
                    $this->error($returnEmail);
                }
            } else {
                $this->error($msg);
            }
        } else {
            return view();
        }
    }

}
