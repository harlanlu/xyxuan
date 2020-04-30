{extend name="base:base" /}


{block name="body"}
<style>
    .btnn{margin-left: 10px;}
    .layui-btn{margin-top: 5px;}
</style>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <h2 style="text-align: center">申请认证摄影师</h2>

            <div class="layui-card layui-form">
                <div class="layui-card-body ">
                    <form class="layui-col-space5">
<!--                        <div class="layui-inline layui-show-xs-block">-->
<!--                            <input type="text" name="keyword"  placeholder="请输入账号" autocomplete="off" class="layui-input" value="--><?php //echo input('get.keyword') ?><!--">-->
<!--                        </div>-->
<!--                        <div class="layui-inline layui-show-xs-block">-->
<!--                            <button class="layui-btn layui-btn-sm"  lay-submit="" lay-filter="search"><i class="layui-icon">&#xe615;</i></button>-->
<!--                        </div>-->

                        <div class="layui-inline layui-show-xs-block" style="float:right;">
                            <a class="layui-btn btnn layui-btn-sm  openbox layui-btn-danger btnn" href="<?php echo url('/member/apply_refuse/id/' . $info['id']) ?>" title="拒绝"> 拒绝</a>
                            <a class="layui-btn btnn layui-btn-sm openbox layui-btn-success" href="<?php echo url('/member/ident/id/' . $info['user_id'].'/tid/'. $info['id']) ?>" title="认证"  > 认证</a>
                            <button type="button" title="刷新" onclick="javascript:window.location.reload();" class="layui-btn  layui-btn-sm">
                                <i class="layui-icon">&#xe669;</i>
                            </button>
                        </div>
                    </form>

                </div>

                <style>
                    .mytitle:hover{
                        cursor: pointer;
                    }
                    .orange{color: orange;}
                    .green{color: green;}
                    .red{color: red;}
                </style>
                <div class="layui-card-body layui-table-body layui-table-main" style="margin-top: 30px;">
                    <h3 style="text-align:center;padding-bottom: 10px;">标题：{$info.utitle}</h3>
                    <h3 style="text-align:center;padding-bottom: 10px;">申请人：{$info.user_id|getUserName}</h3>
                    <h3 style="text-align:center;padding-bottom: 30px;">状态：
                        <td>
                            <?php if ($info['status']==0){echo '<span class="orange">待处理</span>';}
                        if ($info['status']==1){echo '<span class="green">已同意</span>';}
                        if ($info['status']==-1){echo '<span class="red">已拒绝</span>';}; ?></td>

                    </h3>
                    {$info.content}

                </div>

                <script>
                    function del(obj) {
                        obj.parentNode.parentNode.parentNode.removeChild(obj.parentNode.parentNode);
                    }
                </script>

                <div class="layui-card-body ">

                    

                    


                    
                </div>


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