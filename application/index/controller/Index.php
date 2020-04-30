<?php

namespace app\index\controller;

use app\common\controller\Base;
use utils\Page;

class Index extends Base {

    /**
     * @title 论坛首页
     * @return type
     */

    public function index(){

        $wheres = [
            ['a.isbanner', '=', 1]
        ];
        $banner=db('thread')
            ->where('isbanner',1)
//            ->alias('a')
//            ->join('member m', 'm.id = a.member_id')
            ->limit(9)->order('hits','desc')->select();
        $this->assign('banner', $banner);
//        dump($banner);
        return view('index/welcome');
    }

    public function main() {
        // 推荐5条
        $wheres = [
                ['a.recommend', '=', 1]
        ];
        $banner=model('thread')->model_where($wheres)->limit(5)->order('hits','desc')->select();
        $this->assign('banner', $banner);


        // 回帖周榜12
//        $lists_member12 = model('thread_comment')
//                ->alias('a')
//                ->where('a.create_time', '>', time() - 604800)
//                ->group('a.member_id,m.avatar,m.nickname,m.sex')
//                ->field('a.member_id,m.avatar,m.nickname,m.sex,count(a.member_id) as count')
//                ->join('member m', 'm.id = a.member_id')
//                ->limit(12)
//                //->cache('lists_member13', 3600)
//                ->select();
//        $this->assign('lists_member12', $lists_member12);

        // 综合20条帖子
        $lists_thread20 = model('thread')->model_where()
            ->alias('a')->order('a.top desc,a.recommend desc,a.hits desc')
            ->where('thumb','<>','/uploads/thumb.png')
            ->limit(20)->select();
        $this->assign('lists_thread20', $lists_thread20);



        // 加载签到的初始化状态
        $member = member_is_login();
        $member_id = (is_array($member)) ? $member['id'] : -1;

        $sign_info = getSignTip($member_id);
        $sign_tip = $sign_info['tip'];

        $canlendars = getCanlendar();
        $start_time = strtotime(date("Y-m-01"));
        $end_time = time();
        $signs = db("member_sign")->field("sign_time")->where("member_id", $member_id)->where('sign_time', 'between', [$start_time, $end_time])->select();

        $signs_dates = array();
        foreach ($signs as $v) {
            $signs_dates[] = date("Y-m-d", $v['sign_time']);
        }

        $this->assign("canlendars", $canlendars);
        $this->assign("days", date('t', strtotime("Y-m-1")));
        $this->assign("today", date("Y-m-d"));
        $this->assign("signs_dates", $signs_dates);
        $this->assign("sign_info", $sign_info);
        $this->assign("sign_tip", $sign_tip);

        return view('index/index');
    }

    /**
     * @title 论坛栏目查看权限
     * cid 栏目的id
     */
    public function _thread_access($cid) {
        // 权限验证
        $thread_column = db('thread_column')->where('id', $cid)->find();
        // 会员积分和VIP级别
        $member = member_is_login();
        // print_r($member);
        if (!is_array($member)) {
            $vip = 0;
            $points = 0;
        } else {
            $vip = $member['vip'];
            $points = $member['points'];
        }
        // 没有权限，则阻止继续浏览
        if ($thread_column['join_type'] == 1) {
            // 没有达到VIP级别，展示一个无权访问页面
            if ($vip < $thread_column['vip_limit']) {
                return '无法进入该会员专区，至少VIP' . $thread_column['vip_limit'] . '级会员可访问';
            }
        } elseif ($thread_column['join_type'] == 2) {
            if ($points < $thread_column['points_limit']) {
                return '无法进入该会员专区，至少' . $thread_column['points_limit'] . '积分的会员可访问';
            }
        }
        $this->assign('mytitle', '访问受限');

    }

    public function ce(){
        $alias=request()->param('id');
//        $son= db('thread')->where('id', $alias)->find();
//        dump($son);
        $t='1584626445';
        $t=(int)$t;
        dump(date('Y-m-d',$t));
    }

    public function search(){
        $keywords = request()->param('wd');
        if(empty($keywords))
        {
            $keywords='';
        }
        $lists = db('thread')->where('title','like','%'.$keywords.'%')
            ->join('member m', 'm.id = a.member_id', 'LEFT')
            ->join('member_ident mi', 'mi.member_id = m.id', 'LEFT')
            ->alias('a')
            ->order('a.top desc,a.recommend desc,a.id desc')
            ->field('a.*,m.id as member_id,m.nickname,m.avatar,m.sex,m.vip,m.ident,mi.identification')
            ->paginate(10, false, ['query' => request()->get()]);
        $this->assign('lists', $lists);
        $this->assign('keywords', $keywords);
        $count = model('thread')->where('title','like','%'.$keywords.'%')->count();
        $pager = new Page();
        $page = input('param.page', 1);
        $url = url('/search/wd/'.$keywords).'/page/{page}/'  ;
        $pager->setUrl($url);
        $pager->setTotal($count);
        $pager->setLimit(10);
        $pager->setPage($page);
        $this->assign('pager', $pager->render());
        return view();
    }

    /**
     * @title 帖子列表
     * 进入论坛要验证
     */
    public function thread() {
        // 栏目别名
        $alias = input('param.alias');
        $type = input('param.type');
        $page = input('param.page', 1);
        $wherepid[] = [];
        if ($alias && $alias != 'all') {
            $cid = db('thread_column')->where('alias', $alias)->value('id');
        } else {
            $cid = 0;
        }
        // 浏览权限        
        if ($msg = $this->_thread_access($cid)) {
            return view('everyone/access_denied', ['msg' => $msg]);
            exit;
        }
        $wheres = [];
        //
        if ($cid) {
            $son= db('thread_column')->where('pid',$cid)->select();
            if ($son){
                //父类
                $wheres[] = ['a.cp_id', '=', $cid];
            }else{
                //子类
                $wheres[] = ['a.cid', '=', $cid];
            }
        }
        // 精华
        if ($type == 'wonderful') {
            $wheres[] = ['a.status', '=', 1];
        }
        $lists = model('thread')->model_where($wheres)->paginate(10, false, ['query' => request()->get()]);
        $this->assign('lists', $lists);
        //
        $count = model('thread')->model_where($wheres)->count();
        $cname=db('thread_column')->where('id',$cid)->find();
        //
        $pager = new Page();
        if ($type) {
            $url = url('/column/' . $alias . '/' . $type) . '/page/{page}/';
        } else {
            $url = url('/column/' . $alias) . '/page/{page}/';
        }

        $pager->setUrl($url);
        $pager->setTotal($count);
        $pager->setLimit(10);
        $pager->setPage($page);
        $this->assign('mytitle', $cname['title']);
        $this->assign('cname', $cname);

        $this->assign('count', $count);
        $this->assign('pager', $pager->render());

// 加载签到的初始化状态
        $member = member_is_login();
        $member_id = (is_array($member)) ? $member['id'] : -1;

        $sign_info = getSignTip($member_id);
        $sign_tip = $sign_info['tip'];

        $canlendars = getCanlendar();
        $start_time = strtotime(date("Y-m-01"));
        $end_time = time();
        $signs = db("member_sign")->field("sign_time")->where("member_id", $member_id)->where('sign_time', 'between', [$start_time, $end_time])->select();

        $signs_dates = array();
        foreach ($signs as $v) {
            $signs_dates[] = date("Y-m-d", $v['sign_time']);
        }

        $this->assign("canlendars", $canlendars);
        $this->assign("days", date('t', strtotime("Y-m-1")));
        $this->assign("today", date("Y-m-d"));
        $this->assign("signs_dates", $signs_dates);
        $this->assign("sign_info", $sign_info);
        $this->assign("sign_tip", $sign_tip);

        return view();
    }

    /**
     * @title 帖子详情查看
     */
    public function thread_views() {


//        $id = input('param.id');
        $id = request()->param('id');
        if (!$id) {
            exit;
        }
        db('thread')->where('id','=',$id)->setInc('hits');
        $wheres = [
                ['a.id', '=', $id]
        ];
        $one = model('thread')->model_where_id($wheres)->find()->toArray();
        $cname=db('thread_column')->where('id',$one['cid'])->find();
        $this->assign('cname',$cname);
        // 浏览权限        
        if ($msg = $this->_thread_access($one['cid'])) {
            return view('everyone/access_denied', ['msg' => $msg]);
            exit;
        }


        // 删除 置顶 加精 是否能显示
        $one['display_del'] = 0;
        $one['display_top'] = 0;
        $one['display_status'] = 0;


        // 
        $member = member_is_login();
        if (is_array($member)) {
            $member_id = $member['id'];
        } else {
            $member_id = -1;
        }
        $this->assign('m_id',$member_id);



        // 当前会员是否是该版块的管理员
        $is_thread_column_manager = model('thread_column_member')->where('column_id', $one['cid'])->where('member_id', $member_id)->count();
        if ($is_thread_column_manager || $member_id == $one['member_id']) {
            $one['display_del'] = 1;
        }
        //
        if ($is_thread_column_manager) {
            $one['display_top'] = 1;
            $one['display_status'] = 1;
        }

        $this->assign($one);
        $this->assign('art',$one);
        $is_bbs_c=db('thread_column')->where('id','=',$one['cp_id'])->find();
        if ($is_bbs_c['alias']=='bbs'){
            $is_bbs=1;//是求助帖 直接显示链接
        }else{
            $is_bbs=0;//不是求助 隐藏链接
        }
        $this->assign('is_bbs',$is_bbs);
        // 回复的列表      
        $where = [
                ['a.thread_id', '=', $id]
        ];
        $lists_comment = model('thread_comment')->model_where($where)->paginate(10, false, ['query' => request()->get()]);
        foreach ($lists_comment as $key => $value) {
            // 评论的 编辑 删除 采纳 是否能显示 
            $lists_comment[$key]['display_comment_edit'] = ($member_id == $one['member_id'] || $member_id == $value['member_id']) ? 1 : 0;
            $lists_comment[$key]['display_comment_del'] = ($member_id == $one['member_id'] || $member_id == $value['member_id']) ? 1 : 0;
            $lists_comment[$key]['display_comment_accept'] = ($member_id == $one['member_id']) ? 1 : 0;
        }
        $this->assign('lists_comment', $lists_comment);

        $this->assign('mytitle', $one['title']);
        $this->assign('lianjie', $one['lianjie']);
        $this->assign('banner_des', $one['banner_des']);


        $lists_comment_count = model('thread_comment')->model_where($where)->count();
        $this->assign('lists_comment_count', $lists_comment_count);


        return view();
    }

    //购买作品
    public function buyArticle(){
        if (request()->isPost()){
            $data=request()->param();
            $data['dotime']=time();
            $is_user=db('member')->where('id','=',$data['buyer'])->find();
            $zuozhe=db('member')->where('id','=',$data['zuozhe'])->find();
            $gain=$data['jifen']+$zuozhe['points'];
            if ($is_user){
                $sheng=$is_user['points']-$data['jifen'];//剩余积分
                if ($sheng<0){
                   // $status=0;$msg='积分不足，请及时充值！';
                    return ['status'=>0,'msg'=>'积分不足，请及时充值！','lian'=>''];
                }else{
                    //购买者 减积分
                    db('member')->where('id','=',$data['buyer'])->update(['points'=>$sheng]);
                    $data['status']=0;
                    db('buy_art')->insert($data);
                    //作者 加积分
                    db('member')->where('id','=',$data['zuozhe'])->update(['points'=>$gain]);
                    $data['status']=1;
                    db('buy_art')->insert($data);
                    $art_lian=db('thread')->where('id','=',$data['art'])->find();
                    $status=1;$msg='购买成功！';$lian=$art_lian['lianjie'];
                }

            }else{
                $status=-1;$msg='请先登录！';$lian='';
            }
        }else{
            $status=-2;$msg='请求错误！';$lian='';
        }
        return ['status'=>$status,'msg'=>$msg,'lian'=>$lian];
    }


    /**
     * @title 帖子评论的添加 
     * 前置条件：登录后
     */
    public function thread_comment_add() {

        if (is_array($member = member_is_login())) {

            //
            $post = request()->post();
            if (empty($post['thread_id'])) {
                $this->error('找不到帖子');
            }

            //
            //print_r($member_id);
            $msg = model('thread_comment')->thread_comment_add($post);
            if (is_numeric($msg) || empty($msg)) {
                // 发布成功 ，跳转到所属的帖子
                $msg='发送成功';$code=0;$url=url('/thread/' . $post['thread_id']);
//                $this->success('发布成功', url('/thread/' . $post['thread_id']));
            } else {
                $this->error($msg);
            }
        } else {

            $this->error('请登录后进行操作');
        }
        return ['msg'=>$msg,'code'=>$code,'url'=>$url];
    }

}
