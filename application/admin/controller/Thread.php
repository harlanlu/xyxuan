<?php

namespace app\admin\controller;

class Thread extends Admin {

    /**
     * @title 文章框架
     */
    public function iframe() {
        // 加载内容
        $this->assign('iframe_src', url('admin/thread/index'));
        // 加载分类
        $this->assign('nodes', model('thread_column')->json_category_nav('title'));
        return $this->fetch('base:iframe');
    }


    /**
     * @title 帖子单条删除
     * @param type $id
     */
    public function delete($id){
        
        empty($id) && $this->error('帖子不存在');
        
        $affect_row = db('thread')->where('id', $id)->setField('delete_time', time());
        if($affect_row){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
        
    }
    /**
     * @title 帖子多条删除
     * @param type $id
     */
    public function deletes($ids) {

        empty($ids) && $this->error('帖子不存在');

        $affect_row = db('thread')->where('id', 'in', $ids)->setField('delete_time', time());
        if ($affect_row) {
            $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }
    }
    /**
     * @title 帖子列表
     * @return type
     */
    public function index() {
        $cid = input('get.category', NULL);
        session('category', $cid);

        if (is_null($cid)){
            $wheres = [];
        }else{
            $wheres = [
                ['a.cid', '=', $cid]
            ];
        }
        $count = model('thread')->model_wheres($wheres)->count();
        $this->assign('count', $count);
        $lists = model('thread')->model_wheres($wheres)->paginate(5, false, ['query' => request()->get()]);
        $this->assign('lists', $lists);
        $this->assign('pager', $lists->render());


        // 分类转移 
        // $this->assign('category_select', model('article_cat')->lists_select_tree());
        // 构建列表
//        builder('list')
//                ->addItem('id', 'ID')
//                ->addItem('column_title', '分类')
//                ->addItem('title', '标题')
//                ->addItem('hits', '热度')
//                ->addItem('nickname', '作者')
//                ->addItem('create_time', '时间')
//                ->addItem('isbanner', '欢迎页')
//                ->addItem('top', '置顶')
//                ->addItem('status', '精华')
//                ->addItem('recommend', '推荐')
//                ->addAction('编辑', 'edit_art', '', 'openbox_mid layui-btn-success mybox')
//                ->addAction('删除', 'delete', '<i class="layui-icon layui-icon-delete"></i>', 'ajax-get confirm layui-btn-danger')
//                ->build();

        return view();
    }




    public function edit_art($id) {
        empty($id) && $this->error('参数缺失');
        // 加载认证信息
        if (request()->isPost()) {
            $post = request()->post();
            $msg = db('thread')->where('id',$id)->update($post);
            if (!empty($msg)) {
                $this->success('更新成功！');
            } else {
                $this->success('内容未改变！');
            }
        } else {
            $one = db('thread')->where('id',$id)->find();
            $this->assign('one',$one);
            return view('thread/edit_art');
        }

    }

//    public function ff(){
//        $value=request()->param('id');
//        $c=db('thread_column')->where('id', $value)->find();
//        dump($c);
//        if ($c['pid']==0){
//            echo 'pid=0 cp_id='.$c['cp_id'];
//        }else{
//            echo 'pid='.$c['id'].'cp_id='.$c['cp_id'];
//        }
//    }

    /**
     * @title 推荐/置顶/分类转移
     */
    public function set_field() {

        $ids = input('post.ids');
        $field = input('get.field');
        $value = input('get.value');

        empty($field) && $this->error('更新的字段为空');
        $c=db('thread')->where('id', $value)->find();

        $ids_arr = explode(',', $ids);
        $ids_arr = array_filter($ids_arr);

        if (empty($ids_arr)) {
            $this->error('选择要操作的数据');
        }

//        $affect_rows = db('thread')->where('id', 'in', $ids)->setField($field, $value);
        $affect_rows = db('thread')->where('id', 'in', $ids)
            ->update([$field=>$value,'pid'=>$c['pid'],'cp_id'=>$c['cp_id']]);

        if ($affect_rows) {
            $this->success('操作成功');
        } else {
            $this->success('没有任何更新');
        }
    }

    /**
     * @title 论坛栏目管理员
     * 弹出打开
     * @param type $id
     */
    public function column_manager($id) {

        $cid=request()->param('id');
        // 加载所有会员
        $lists = model('thread_column_member')->model_where()->select();

        //每个栏目管理员
        $list_single = db('thread_column_member aa')->where('aa.column_id','=',$cid)
            ->join('member m', 'm.id = aa.member_id')->select();
        $this->assign('lists', $lists);
        $this->assign('listsingle', $list_single);

        return view();
    }

    /**
     * @title 新增论坛管理员
     */
    public function column_manager_add() {

        $thread_column_id = request()->post('thread_column_id');
        $member_id = request()->post('member_id');

        $data = [
            'member_id' => $member_id,
            'column_id' => $thread_column_id,
            'create_time' => time()
        ];
        db('thread_column_member')->insertGetId($data);

        $this->redirect(url('admin/thread/column_manager', ['id' => $thread_column_id]));
    }

    /**
     * @title 移除管理员
     */
    public function column_manager_remove($id) {

        if (empty($id)) {
            $this->error('参数不完整');
        }

        db('thread_column_member')->where('id', $id)->delete();

        $this->success('移除成功');
    }

    /**
     * @title 论坛栏目
     * @return type
     */
    public function column() {


        $lists = model('thread_column')->order('cp_id','asc')->paginate(10, false, ['query' => request()->get()]);
        $this->assign('page', $lists->render());
        $this->assign('lists', $lists);

        builder('list')
            ->addItem('id', 'ID')
            ->addItem('pid', '父类','c_pid')
                ->addItem('title', '名称')
                ->addItem('alias', '别名')
                ->addSortItem('listorder', '排序', 'thread_column')
                ->addItem('publish_type', '发布权限','publish_type')
                ->addItem('join_type', '浏览权限','join_type')
                ->addAction('编辑', 'column_edit', '<i class="layui-icon layui-icon-edit"></i>')
                ->addAction('删除', 'column_delete', '<i class="layui-icon layui-icon-delete"></i>', 'ajax-get confirm layui-btn-danger')
                ->addAction('管理员', 'column_manager', '<i class="layui-icon layui-icon-group"></i>', 'openbox layui-btn-success')
                ->build();

        return view();
    }

    /**
     * @title 批量删除栏目
     * 
     */
    public function column_delete() {


        $id = input('get.id', 0);
        empty($id) && $this->error('没有选择任何数据');

        // 如果栏目下有帖子也删除不了
        $thread_list = db('thread')->where('cid', $id)->select();
        if (count($thread_list) > 0) {
            $this->error('栏目下存在帖子，无法删除 ');
        }

        $affect_rows = db('thread_column')->where('id', $id)->delete();
        if ($affect_rows) {
//            $this->success('删除成功', url('thread/column'));
            return ['code'=>0,'msg'=>'删除成功','url'=>url('thread/column')];
        } else {
//            $this->error('删除成功');
            return ['code'=>1,'msg'=>'删除失败','url'=>url('thread/column')];
        }
    }

    /**
     * @title 栏目编辑
     * 
     */
    public function column_edit($id) {

        empty($id) && $this->error('参数不能为空');

        if (request()->isPost()) {
            $i=request()->post('id');
            $data['title'] = request()->post('title');
            $data['alias'] = request()->post('alias');
            $data['pid'] = request()->post('pid');

            $data['publish_type'] = request()->post('publish_type');
            $data['join_type'] = request()->post('join_type');
            $data['vip_limit'] = request()->post('vip_limit');
            $data['points_limit'] = request()->post('points_limit');
            if ($data['pid']==0){
                $data['cp_id'] =$i;
            }else{
                $data['cp_id'] =$data['pid'];
            }

            $affect_rows = db('thread_column')->where('id', $i)->update($data);
            if (is_numeric($affect_rows)) {
//                $this->success('编辑成功', url('thread/column'));
                return ['code'=>0,'msg'=>'编辑成功','url'=>url('thread/column')];
            } else {
//                $this->error('编辑失败');
                return ['code'=>1,'msg'=>'编辑失败','url'=>url('thread/column')];

            }
        } else {

            $one = db('thread_column')->where('id', $id)->find();           
            $this->view->assign('one',$one);

            $pid= db('thread_column')->where('pid',0)->select();
            $this->view->assign('pidList',$pid);

            return view();
        }
    }



    /**
     * @title 论坛栏目添加 
     * @return type
     */
//    public function do_column_add() {
//        if (request()->isPost()) {
//            // 验证
//            $post = request()->post();
//
//            $data['title'] = request()->post('title');
//            $data['alias'] = request()->post('alias');
//            $data['pid'] = request()->post('pid');
//            $data['publish_type'] = request()->post('publish_type');
//            $data['join_type'] = request()->post('join_type');
//            $data['vip_limit'] = request()->post('vip_limit');
//            $data['points_limit'] = request()->post('points_limit');
//
//            $insert_id = db('thread_column')->insertGetId($data);
//
//            if (is_numeric($insert_id)) {
//                $this->success('添加成功', 'admin/thread/column');
//            } else {
//                $this->error('添加失败');
//            }
//        }
//    }
    public function column_add() {


        if (request()->isPost()) {


            // 验证
            $post = request()->post();

            $data['title'] = request()->post('title');
            $data['alias'] = request()->post('alias');
            $data['pid'] = request()->post('pid');
            $data['publish_type'] = request()->post('publish_type');
            $data['join_type'] = request()->post('join_type');
            $data['vip_limit'] = request()->post('vip_limit');
            $data['points_limit'] = request()->post('points_limit');
            $insert_id = db('thread_column')->insertGetId($data);
            if ($data['pid']==0){
                $d=$insert_id;
            }else{
                $d=$data['pid'];
            }
            $res=db('thread_column')->where('id',$insert_id)->update(['cp_id'=>$d]);
            if ($res) {
//                $this->success('添加成功', url('thread/column'));
                return ['code'=>0,'msg'=>'添加成功','url'=>url('thread/column')];
            } else {
                return ['code'=>1,'msg'=>'添加失败','url'=>url('thread/column')];
            }
        } else {
            $pid= db('thread_column')->where('pid',0)->select();
            $this->view->assign('pidList',$pid);

            return view();
        }
    }

}
