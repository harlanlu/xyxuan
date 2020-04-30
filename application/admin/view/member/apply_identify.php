{extend name="base:base" /}


{block name="body"}
<style>
    .btnn{margin-left: 10px;}
    .layui-btn{margin-top: 5px;}
    .mytitle:hover{
        cursor: pointer;
    }
    .orange{color: orange;}
    .green{color: #009688;}
    .red{color: red;}
    .kong{text-align: center;height: 90px;}
</style>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <h2 style="text-align: center">申请认证摄影师</h2>
            <div class="layui-card layui-form">
                <div class="layui-card-body ">
                    <form class="layui-col-space5">
                        <h3>点击标题查看具体内容</h3>
                        <div class="layui-inline layui-show-xs-block" style="float:right;">
                            <button type="button" title="刷新" onclick="javascript:window.location.reload();" class="layui-btn  layui-btn-sm">
                                <i class="layui-icon">&#xe669;</i>
                            </button>
                        </div>
                    </form>

                </div>

                <div class="layui-tab layui-tab-brief"  style="margin-top: 30px;">
                    <ul class="layui-tab-title" style="width: 100%">
                        <li  class="layui-this" style="width: 20%">待处理<span class="layui-badge layui-bg-orange"><?php echo $c1; ?></span></li>
                        <li  style="width: 20%">已同意<span class="layui-badge layui-bg-green"><?php echo $c2; ?></span></li>
                        <li    style="width: 20%">已拒绝<span class="layui-badge "><?php echo $c3; ?></span></li>
                    </ul>

                    <div class="layui-tab-content" style="height: 100px;">
                        <!-- 待处理-->
                        <div class="layui-tab-item layui-show">
                            <div class="layui-card-body layui-table-body layui-table-main">
                                <table class="layui-table layui-form">
                                    <thead>
                                    <tr>
                                        <th   class="ck" ><input type="checkbox" name="" lay-skin="primary" lay-filter="allChoose" value="0"></th>
                                        <th>ID</th>
                                        <th>标题</th>
                                        <th>用户</th>
                                        <th>内容</th>
                                        <th>申请时间</th>
                                        <th>是否同意</th>
                                        <th>操作时间</th>
                                        <th>管理员回复</th>
                                        <th>回复时间</th>
                                        <th>管理操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if ($c1==0){
                                        echo '<tr><td class="kong" colspan="11"><span class="red">数据为空🙂</span></td></tr>';
                                    }else{
                                    foreach ($lists1 as $key=>$v){
                                        ?>
                                        <tr>
                                            <td   class="ck"> <input type="checkbox" name="ids[]" title="" lay-skin="primary"  /></td>
                                            <td><?php echo $v['id']; ?></td>
                                            <td><a class="mytitle orange" onclick="parent.xadmin.add_tab('认证信息', '<?php echo url('admin/member/see_apply_info',['id'=>$v['id']]) ?>')">
                                                    <?php echo $v['utitle']; ?></a> </td>
                                            <td><?php echo getUserName($v['user_id']); ?></td>
                                            <td><?php echo subtext($v['content'],10);  ?></td>
                                            <td><?php echo date('Y-m-d H:i:s',$v['write_time']); ?></td>
                                            <td>
                                                <?php if ($v['status']==0){echo '<span class="orange">待处理</span>';}
                                                if ($v['status']==1){echo '<span class="green">已同意</span>';}
                                                if ($v['status']==-1){echo '<span class="red">已拒绝</span>';}; ?></td>
                                            <td><?php if ($v['dotime']==-1){echo '';}else echo date('Y-m-d H:i:s',$v['dotime']); ?></td>

                                            <td><?php echo $v['msg']; ?></td>
                                            <td><?php if ($v['reply_time']==-1){echo '';}else echo date('Y-m-d H:i:s',$v['reply_time']); ?></td>
                                            <td>
                                                <a class="layui-btn btnn layui-btn-xs  openbox layui-bg-orange btnn" href="<?php echo url('/member/apply_refuse/id/' . $v['id']) ?>" title="拒绝"> 拒绝</a>
                                                <a class="layui-btn btnn layui-btn-xs openbox layui-btn-success" href="<?php echo url('/member/ident/id/' . $v['user_id'].'/tid/'.$v['id']) ?>" title="认证"  > 认证</a>
                                                <a class="layui-btn btnn layui-btn-xs ajax-get confirm layui-btn-danger btnn" href="<?php echo url('/member/apply_delete/id/' . $v['id']) ?>" title="删除"  onclick="del(this)"  > 删除</a>

                                            </td>
                                        </tr>
                                        <?php
                                    }}
                                    ?>
                                    </tbody>
                                    <thead>
                                    <tr>
                                        <th   class="ck" ><input type="checkbox" name="" lay-skin="primary" lay-filter="allChoose" value="0"></th>
                                        <th>ID</th>
                                        <th>标题</th>
                                        <th>用户</th>
                                        <th>内容</th>
                                        <th>申请时间</th>
                                        <th>是否同意</th>
                                        <th>操作时间</th>
                                        <th>管理员回复</th>
                                        <th>回复时间</th>
                                        <th>管理操作</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="layui-card-body ">
                                <div class="page" style="float: right">
                                    {$pager1}
                                </div>
                            </div>
                        </div>

                        <!-- 已同意-->
                        <div class="layui-tab-item">
                            <div class="layui-card-body layui-table-body layui-table-main">
                                <table class="layui-table layui-form">
                                    <thead>
                                    <tr>
                                        <th   class="ck" ><input type="checkbox" name="" lay-skin="primary" lay-filter="allChoose" value="0"></th>
                                        <th>ID</th>
                                        <th>标题</th>
                                        <th>用户</th>
                                        <th>内容</th>
                                        <th>申请时间</th>
                                        <th>是否同意</th>
                                        <th>操作时间</th>
                                        <th>管理员回复</th>
                                        <th>回复时间</th>
                                        <th>管理操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if ($c2==0){
                                        echo '<tr><td class="kong" colspan="11"><span class="red">数据为空🙂</span></td></tr>';
                                    }else{
                                    foreach ($lists2 as $key=>$v){
                                        ?>
                                        <tr>
                                            <td   class="ck"> <input type="checkbox" name="ids[]" title="" lay-skin="primary"  /></td>
                                            <td><?php echo $v['id']; ?></td>
                                            <td><a class="mytitle green" onclick="parent.xadmin.add_tab('认证信息', '<?php echo url('admin/member/see_apply_info',['id'=>$v['id']]) ?>')">
                                                    <?php echo $v['utitle']; ?></a> </td>
                                            <td><?php echo getUserName($v['user_id']); ?></td>
                                            <td><?php echo subtext($v['content'],10);  ?></td>
                                            <td><?php echo date('Y-m-d H:i:s',$v['write_time']); ?></td>
                                            <td>
                                                <?php if ($v['status']==0){echo '<span class="orange">待处理</span>';}
                                                if ($v['status']==1){echo '<span class="green">已同意</span>';}
                                                if ($v['status']==-1){echo '<span class="red">已拒绝</span>';}; ?></td>
                                            <td><?php if ($v['dotime']==-1){echo '';}else echo date('Y-m-d H:i:s',$v['dotime']); ?></td>

                                            <td><?php echo $v['msg']; ?></td>
                                            <td><?php if ($v['reply_time']==-1){echo '';}else echo date('Y-m-d H:i:s',$v['reply_time']); ?></td>
                                            <td>
                                                <a class="layui-btn btnn layui-btn-xs  openbox layui-bg-orange btnn" href="<?php echo url('/member/apply_refuse/id/' . $v['id']) ?>" title="拒绝"> 拒绝</a>
                                                <a class="layui-btn btnn layui-btn-xs openbox layui-btn-success" href="<?php echo url('/member/ident/id/' . $v['user_id'].'/tid/'.$v['id']) ?>" title="认证"  > 认证</a>
                                                <a class="layui-btn btnn layui-btn-xs ajax-get confirm layui-btn-danger btnn" href="<?php echo url('/member/apply_delete/id/' . $v['id']) ?>" title="删除"  onclick="del(this)"  > 删除</a>

                                            </td>
                                        </tr>
                                        <?php
                                    }}
                                    ?>
                                    </tbody>
                                    <thead>
                                    <tr>
                                        <th   class="ck" ><input type="checkbox" name="" lay-skin="primary" lay-filter="allChoose" value="0"></th>
                                        <th>ID</th>
                                        <th>标题</th>
                                        <th>用户</th>
                                        <th>内容</th>
                                        <th>申请时间</th>
                                        <th>是否同意</th>
                                        <th>操作时间</th>
                                        <th>管理员回复</th>
                                        <th>回复时间</th>
                                        <th>管理操作</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="layui-card-body ">
                                <div class="page" style="float: right">
                                    {$pager2}
                                </div>
                            </div>
                        </div>

                        <!--已拒绝-->
                        <div class="layui-tab-item">
                            <div class="layui-card-body layui-table-body layui-table-main">
                                <table class="layui-table layui-form">
                                    <thead>
                                    <tr>
                                        <th   class="ck" ><input type="checkbox" name="" lay-skin="primary" lay-filter="allChoose" value="0"></th>
                                        <th>ID</th>
                                        <th>标题</th>
                                        <th>用户</th>
                                        <th>内容</th>
                                        <th>申请时间</th>
                                        <th>是否同意</th>
                                        <th>操作时间</th>
                                        <th>管理员回复</th>
                                        <th>回复时间</th>
                                        <th>管理操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if ($c3==0){
                                        echo '<tr><td class="kong" colspan="11"><span class="red">数据为空🙂</span></td></tr>';
                                    }else{
                                    foreach ($lists3 as $key=>$v){
                                        ?>
                                        <tr>
                                            <td   class="ck"> <input type="checkbox" name="ids[]" title="" lay-skin="primary"  /></td>
                                            <td><?php echo $v['id']; ?></td>
                                            <td><a class="mytitle red" onclick="parent.xadmin.add_tab('认证信息', '<?php echo url('admin/member/see_apply_info',['id'=>$v['id']]) ?>')">
                                                    <?php echo $v['utitle']; ?></a> </td>
                                            <td><?php echo getUserName($v['user_id']); ?></td>
                                            <td><?php echo subtext($v['content'],10);  ?></td>
                                            <td><?php echo date('Y-m-d H:i:s',$v['write_time']); ?></td>
                                            <td>
                                                <?php if ($v['status']==0){echo '<span class="orange">待处理</span>';}
                                                if ($v['status']==1){echo '<span class="green">已同意</span>';}
                                                if ($v['status']==-1){echo '<span class="red">已拒绝</span>';}; ?></td>
                                            <td><?php if ($v['dotime']==-1){echo '';}else echo date('Y-m-d H:i:s',$v['dotime']); ?></td>

                                            <td><?php echo $v['msg']; ?></td>
                                            <td><?php if ($v['reply_time']==-1){echo '';}else echo date('Y-m-d H:i:s',$v['reply_time']); ?></td>
                                            <td>
                                                <a class="layui-btn btnn layui-btn-xs  openbox layui-bg-orange btnn" href="<?php echo url('/member/apply_refuse/id/' . $v['id']) ?>" title="拒绝"> 拒绝</a>
                                                <a class="layui-btn btnn layui-btn-xs openbox layui-btn-success" href="<?php echo url('/member/ident/id/' . $v['user_id'].'/tid/'.$v['id']) ?>" title="认证"  > 认证</a>
                                                <a class="layui-btn btnn layui-btn-xs ajax-get confirm layui-btn-danger btnn" href="<?php echo url('/member/apply_delete/id/' . $v['id']) ?>" title="删除"  onclick="del(this)"  > 删除</a>

                                            </td>
                                        </tr>
                                        <?php
                                    }}
                                    ?>
                                    </tbody>
                                    <thead>
                                    <tr>
                                        <th   class="ck" ><input type="checkbox" name="" lay-skin="primary" lay-filter="allChoose" value="0"></th>
                                        <th>ID</th>
                                        <th>标题</th>
                                        <th>用户</th>
                                        <th>内容</th>
                                        <th>申请时间</th>
                                        <th>是否同意</th>
                                        <th>操作时间</th>
                                        <th>管理员回复</th>
                                        <th>回复时间</th>
                                        <th>管理操作</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="layui-card-body ">
                                <div class="page" style="float: right">
                                    {$pager3}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <script>
                    function del(obj) {
                        obj.parentNode.parentNode.parentNode.removeChild(obj.parentNode.parentNode);
                    }
                </script>




            </div>
        </div>
    </div>
</div>

{/block}

{block name="foot_js"}

<script>
    layui.use(['laydate', 'form'], function () {
        var laydate = layui.laydate;
        var form = layui.form;


        // 监听全选
        form.on('checkbox(checkall)', function (data) {

            if (data.elem.checked) {
                $('tbody input').prop('checked', true);
            } else {
                $('tbody input').prop('checked', false);
            }
            form.render('checkbox');
        });

        //执行一个laydate实例
        laydate.render({
            elem: '#start' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
            elem: '#end' //指定元素
        });


    });

    /*用户-停用*/
    function member_stop(obj, id) {
        layer.confirm('确认要停用吗？', function (index) {

            if ($(obj).attr('title') == '启用') {

                //发异步把用户状态进行更改
                $(obj).attr('title', '停用')
                $(obj).find('i').html('&#xe62f;');

                $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn-disabled').html('已停用');
                layer.msg('已停用!', {icon: 5, time: 1000});

            } else {
                $(obj).attr('title', '启用')
                $(obj).find('i').html('&#xe601;');

                $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-disabled').html('已启用');
                layer.msg('已启用!', {icon: 5, time: 1000});
            }

        });
    }

    /*用户-删除*/
    function member_del(obj, id) {
        layer.confirm('确认要删除吗？', function (index) {
            //发异步删除数据
            $(obj).parents("tr").remove();
            layer.msg('已删除!', {icon: 1, time: 1000});
        });
    }



    function delAll(argument) {
        var ids = [];

        // 获取选中的id 
        $('tbody input').each(function (index, el) {
            if ($(this).prop('checked')) {
                ids.push($(this).val())
            }
        });

        layer.confirm('确认要删除吗？' + ids.toString(), function (index) {
            //捉到所有被选中的，发异步进行删除
            layer.msg('删除成功', {icon: 1});
            $(".layui-form-checked").not('.header').parents('tr').remove();
        });
    }
</script>

{/block}