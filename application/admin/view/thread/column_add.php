
{extend name="base:base" /}


{block name="body"}



<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">



            <form class="layui-form" action="{:url('thread/column_add')}">

                <div class="layui-card">

                    <div class="layui-card-header">
                        <a class="layui-btn layui-btn-primary" href="javascript:history.back();"><i class="layui-icon layui-icon-left"></i>返回</a>
                        <button class="layui-btn layui-btn-normal" lay-filter="myform" lay-submit=""><i class="layui-icon layui-icon-ok"></i>保存</button>
                    </div>
                    <div class="layui-card-body ">
                        <div class="layui-container">

                            <div class="layui-form-item">
                                <label class="layui-form-label">上级目录</label>
                                <div class="layui-input-inline">
                                    <select name="pid">
                                        <option value="0" selected="selected">顶级分类</option>
                                        {volist name="pidList" id="vo"}
                                        <option value="{$vo.id}">{$vo.title}</option>
                                        {/volist}
                                    </select>
                                </div>
                            </div>

                            <div class="layui-form-item">
                                <label class="layui-form-label">标题<span style="color:red;">*</span></label>
                                <div class="layui-input-block">
                                    <input type="text" class="layui-input" name="title" value="" lay-verify="required" placeholder="">
                                </div>
                            </div>

                            <div class="layui-form-item">
                                <label class="layui-form-label">英文<span style="color:red;">*</span></label>
                                <div class="layui-input-block">
                                    <input type="text" class="layui-input" name="alias" value="" lay-verify="required" placeholder="">
                                </div>
                            </div>

                            <div class="layui-form-item">
                                <label class="layui-form-label">发贴权限</label>
                                <div class="layui-input-block">
                                    <input type="radio" name="publish_type" id="publish_type0" value="0" title="所有人可发" checked="checked">
                                    <input type="radio" name="publish_type" id="publish_type1" value="1" title="管理员可发">
                                </div>
                            </div>
                            <hr>
                            <div class="layui-form-item">
                                <label class="layui-form-label">浏览权限</label>
                                <div class="layui-input-inline">
                                    <select name="join_type">
                                        <option value="0" selected="selected">所有人可进</option>
                                        <option value="1">按VIP级别进入</option>
                                        <option value="2">按积分值进入</option>
                                    </select>
                                </div>
                            </div>


                            <div class="layui-form-item" >
                                <label class="layui-form-label">VIP级别限制</label>
                                <div class="layui-input-inline">
                                    <select name="vip_limit">
                                        <option value="0" selected="selected">不限制级别</option>
                                        <option value="1">VIP1</option>
                                        <option value="2">VIP2</option>
                                        <option value="3">VIP3</option>
                                        <option value="4">VIP4</option>
                                        <option value="5">VIP5</option>
                                    </select>
                                </div>
                            </div>
                            <div class="layui-form-item ">
                                <label class="layui-form-label">积分限制</label>
                                <div class="layui-input-inline">
                                    <input type="text"  class="layui-input" name="points_limit" value="0" />
                                </div>
                            </div>


                        </div>
                    </div>
                </div>

            </form>



        </div>
    </div>
</div> 
{/block}

{block name="foot_js"}


<script>


    layui.use(['jquery', 'layer', 'form', 'element'], function () {
        var $ = layui.$,
                layer = layui.layer,
                form = layui.form,
                element = layui.element;


        //下拉选择监听
        form.on('select(join_type)', function (data) {
            if ('0' == data.value) {                
                $('.vip_group').hide();
                $('.points_group').hide();                
            } else if ('1' == data.value) {                
                $('.vip_group').show();
                $('.points_group').hide();                
            }else if ('2' == data.value) {                
                $('.vip_group').hide();
                $('.points_group').show();
            }
        });

        //表单提交监听
        form.on('submit(quick_add)', function (data) {
            //loading
            var load = layer.msg('请稍候', {
                icon: 16
                , shade: 0.01
            });
            var target, query;
            query = $('form.add').serialize();
            target = $('form.add').get(0).action;
            $.post(target, query, function (result) {

                if (result.code == 1) {
                    if (result.msg) {
                        layer.msg(result.msg);
                        setTimeout(function () {
                            if (result.url) {
                                location.href = result.url;
                            }
                        }, 1500);
                    } else {
                        if (result.url) {
                            location.href = result.url;
                        }
                    }
                } else {
                    layer.msg(result.msg);
                }
            });
            return false;
        });

    });

</script>


{/block}