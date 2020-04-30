{extend name="base:base" /}
{block name="body"}



<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">



            <form class="layui-form" >
                <input type="hidden" name="id" value="{$Think.get.id}" />
                <div class="layui-card">

                    <div class="layui-card-header">

                        <a class="layui-btn layui-btn-primary" href="<?php echo url('index', ['category' => session('category')]) ?>"><i class="layui-icon layui-icon-left"></i>返回</a>
                        <button class="layui-btn layui-btn-normal" lay-filter="cateDemo" lay-submit=""><i class="layui-icon layui-icon-ok"></i>保存</button>
                    </div>
                    <div class="layui-card-body ">
                        <div class="layui-container">
                            <div class="layui-container">
                                <div class="layui-form-item">
                                    <label class="layui-form-label">分类</label>
                                    <div class="layui-input-inline">
                                        <select name="cid">
                                            {volist name="cat" id="c"}
                                            {if condition="$one['cid']==$c['id']"}
                                            <option selected value="{$c['id']}">{$c['title']}</option>
                                            {else/}
                                            <option  value="{$c['id']}">{$c['title']}</option>
                                            {/if}
                                            {/volist}
                                        </select>
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">标题<span  style="color:red;" >*</span></label>
                                    <div class="layui-input-block">
                                        <input type="text" class="layui-input" name="title" value="{$one.title}" lay-verify="required" placeholder="">
                                    </div>

                                </div><div class="layui-form-item">
                                    <label class="layui-form-label">图片</label>
                                    <div class="layui-input-inline">
                                        <?php
                                        if ($one['image']) {

                                           echo ' <img class="openbox_big"  src="/uploads/phpfly/'.$one['image'].'" title="图片选择" id="image" data-hidden="image_hidden" href="/sy-admin.php/res/index?hidden=image_hidden&amp;thumb=image" style="cursor: pointer; width: 200px; height: 100px;"  alt="选择图片 [200x100]" data-holder-rendered="true">';

                                        }else{
                                           echo ' <img class="openbox_big"     title="图片选择" id="image" data-hidden="image_hidden" href="/sy-admin.php/res/index?hidden=image_hidden&amp;thumb=image" style="cursor: pointer; width: 200px; height: 100px;" data-src="holder.js/200x100?text=选择图片" alt="选择图片 [200x100]" data-holder-rendered="true">';

                                        }
                                        ?>


                                        <input type="hidden" id="image_hidden" name="image" value="{$one.image}">
                                    </div>
                                </div>

                                <div class="layui-form-item">
                                    <label class="layui-form-label">链接</label>
                                    <div class="layui-input-block">
                                        <input type="text" class="layui-input" name="href" value="{$one.href}" placeholder="">
                                    </div>

                                </div><div class="layui-form-item">
                                    <label class="layui-form-label">打开方式</label>
                                    <div class="layui-input-inline">
                                        <select name="target">
                                            {if condition="$one['target']=='_self'"}
                                            <option selected value="_self">当前页</option>
                                            <option  value="_blank">新页面</option>
                                            {else/}
                                            <option  value="_self">当前页</option>
                                            <option selected value="_blank">新页面</option>
                                            {/if}
                                        </select>
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">图标</label>
                                    <div class="layui-input-block">
                                        <input type="text" class="layui-input" name="icon" value="{$one.icon}" placeholder="">
                                    </div>

                                </div><div class="layui-form-item">
                                    <label class="layui-form-label">描述</label>
                                    <div class="layui-input-block">
                                        <textarea name="description" id="description" class="layui-textarea" placeholder="">{$one.description}</textarea>
                                    </div>
                                </div><div class="layui-form-item">
                                    <label class="layui-form-label">过期时间</label>
                                    <div class="layui-input-inline">
                                        <input type="text" class="layui-input" id="expire_time" name="expire_time" readonly="" placeholder="点击选择时间" value="{$one.expire_time}" lay-key="1">
                                    </div>
                                </div>
                                <script>
                                    layui.use('laydate', function () {
                                        var laydate = layui.laydate;
                                        laydate.render({
                                            elem: '#expire_time' //指定元素
                                            , type: 'date'
                                        });
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>

            </form>



        </div>
    </div>
</div>

<script type="text/javascript">
    layui.use(['form','layer','jquery'], function () {

        // 操作对象
        var form = layui.form;
        var $ = layui.jquery;
        form.on('submit(cateDemo)',function (data) {
            // console.log(data.field);
            $.ajax({
                url:"{:url('nav/doedit')}",
                data:data.field,
                type:'post',
                dataType:'json',
                success:function (data) {
                    if (data.status==1){
                        layer.msg('修改成功!', {
                            // offset: '15px',
                            icon: 1
                            ,time: 1000
                        }, function(){
                            location.href = "{:url('nav/index')}"; //后台主页
                        });
                    }else {
                        layer.msg('修改失败!', {
                            // offset: '150px',
                            icon: 2
                            ,time: 1000
                        });
                    }
                }
            });
            return false;
        })

    });
</script>


{/block}


