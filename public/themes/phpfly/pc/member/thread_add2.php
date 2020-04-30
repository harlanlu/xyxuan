{extend name="base:base" /}
{block name="body"}
<div class="layui-container fly-marginTop">
    <div class="fly-panel" pad20 style="padding-top: 5px;">
        <!--<div class="fly-none">没有权限</div>-->
        <div class="layui-form layui-form-pane">
            <div class="layui-tab layui-tab-brief" lay-filter="user">
                <ul class="layui-tab-title">
                    <li class="layui-this"><?php
                        if ($id) {
                            echo '编辑帖子';
                        } else {
                            echo '发表新帖';
                        }
                        ?><!-- 编辑帖子 -->                       
                    </li>
                </ul>
                <div class="layui-form layui-tab-content" id="LAY_ucm" style="padding: 20px 0;">
                    <div class="layui-tab-item layui-show">
                        <form action="" method="post">
                            <input type="hidden" name="id" value="{$id}" />
                            <div class="layui-row layui-col-space15 layui-form-item">
                                <div class="layui-col-md6">
                                    <label class="layui-form-label">栏目父类</label>
                                    <div class="layui-input-block">
                                        <select lay-verify="required" name="cid" lay-filter="column">
                                            <option value="" selected>--请选择父类--</option>
                                            <?php echo html_select(model('thread_column')->dict(), $cid) ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="layui-col-md6">
                                    <label class="layui-form-label">栏目子类</label>
                                    <div class="layui-input-block">
                                        <select lay-verify="required" name="cid" lay-filter="column">
                                            <?php echo html_select(model('thread_column')->dict(), $cid) ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="layui-col-md12">
                                    <label for="L_title" class="layui-form-label">标题</label>
                                    <div class="layui-input-block">
                                        <input type="text" id="L_title" name="title" required lay-verify="required" autocomplete="off" class="layui-input" value="{$title}">
                                        <input type="hidden"  name="thumb"  autocomplete="off" class="layui-input" id="mythumb" value="{$thumb}">
                                    </div>
                                </div>
                                <div class="layui-col-md12">
                                    <label for="L_title" class="layui-form-label">简介</label>
                                    <div class="layui-input-block">
                                        <input type="text" id="L_title" name="banner_des"  placeholder="150字以内，可不填..." class="layui-input" value="{$banner_des}">
                                    </div>
                                </div>
                            </div>
                            <div class="layui-tab layui-tab-brief" lay-filter="con">
                                <ul class="layui-tab-title" id="LAY_mine">
                                    <li class="layui-this" lay-id="info">内容</li>
                                    <li lay-id="pic">封面</li>
                                </ul>
                                <div class="layui-tab-content" style="padding: 20px 0;">
                                    <div class="layui-form-item layui-form-text layui-form-pane layui-tab-item layui-show">
                                        <div class="layui-input-block">
                                            <textarea id="L_content" name="content" required lay-verify="required" placeholder="详细描述" class="layui-textarea fly-editor" style="height: 250px" >{$content}</textarea>
                                        </div>
                                    </div>
                                    <style>
                                        .pic-add>img {
                                            width: 320px;
                                            height: 240px;
                                            margin-top: 40px;
                                            /*margin: -50px 0 0 -108px;*/
                                            /*border-radius: 100%;*/
                                        }
                                    </style>

                                    <div class="layui-form layui-form-pane layui-tab-item">
                                        <div class="layui-form-item">
                                            <div class="pic-add" style="width: 100%;text-align:center;height: 373px;background-color: #F2F2F5;">
                                                <p style="padding-top: 30px">支持jpg、jpeg、png，最大不能超过3M</p>
                                                <img src="<?php
                                                if ($thumb)
                                                    echo $thumb;
                                                ?>" id="myImg" class="pic_select" data-src="holder.js/320x240?text=上传封面" style="max-width:100%; cursor: pointer;" />
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>






                            <div class="layui-form-item">
                                <div class="layui-inline">
                                    <label class="layui-form-label">悬赏积分</label>
                                    <div class="layui-input-inline" style="width: 190px;">
                                        <select name="points">
                                            <?php
                                            echo html_select([
                                                '0' => 0,
                                                '10' => 10,
                                                '20' => 20,
                                                '30' => 30,
                                                '50' => 50,
                                                '80' => 80,
                                                '100' => 100,
                                                    ], $points)
                                            ?>
                                        </select>
                                    </div>
                                    <div class="layui-form-mid layui-word-aux"></div>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label for="L_vercode" class="layui-form-label">人类验证</label>
                                <div class="layui-input-inline">
                                    <input type="text" id="L_vercode" name="vercode" required lay-verify="required" placeholder="4位数字验证码" autocomplete="off" class="layui-input">
                                </div>
                                <div class="layui-form-mid" style="padding: 0!important;">
                                  <img src="{:captcha_src()}" alt="验证码，点击图片可更换" style="cursor: pointer" onclick="this.src='{:captcha_src()}?r='+Math.random() " />
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <button class="layui-btn" lay-filter="myform" lay-submit>立即发布</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--<script type="text/javascript">-->
<!---->
<!--</script>-->

<div class="layui-card" style="display: none">
<!--    <div class="layui-card-header">卡片面板</div>-->
    <div class="layui-card-body up-frame-parent up-frame-radius">
        <input type="file" id="inputImage"  >
        <hr>
        <div style="overflow: hidden">
            <div class="up-pre-before up-frame-radius pull-left">
                <img alt="" src="" id="image" >
            </div>
            <div class="up-pre-after up-frame-radius pull-right">
            </div>
        </div>
    </div>
    <div class="layui-card-body">
        <button type="button"  class="layui-btn layui-btn-default" id="up-btn-ok" url="<?php echo url('index/member/thread_pic') ?>">保存</button>
    </div>
</div>

<style>
    .pull-left{
        float: left;
    }
    .pull-right{
        float: right;
    }

    @media screen and (max-width: 660px) {
        .pull-left{
            float: none;
        }
        .pull-right{
            float: none;
        }
    }
</style>
{/block}

{block name="foot_js"}
<script src="__PUBLIC__/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="__PUBLIC__/libs/holder/2.9.4/holder.min.js"></script>
<link href="__PUBLIC__/libs/cropper-master/dist/cropper.css" rel="stylesheet" />
<script src="__PUBLIC__/libs/cropper-master/dist/cropper.js"></script>

<script>
    layui.use(['jquery', 'layer', 'element'], function () {
        var $ = layui.$,
            layer = layui.layer,
            element = layui.element;
        //获取hash来切换选项卡，假设当前地址的hash为lay-id对应的值
        var layid = location.hash.replace(/^#con=/, '');
        element.tabChange('con', layid); //假设当前地址为：http://a.com#test1=222，那么选项卡会自动切换到“发送消息”这一项
        //监听Tab切换，以改变地址hash值
        element.on('tab(con)', function () {
            location.hash = 'con=' + this.getAttribute('lay-id');
        });
        $('.pic_select').on('click', function () {
            index = layer.open({
                type: 1,
                area: ['80%', '75%'], //宽高
                shade: false,
                title: '上传封面', //不显示标题
                content: $('.layui-card'), //捕获的元素，注意：最好该指定的元素要存放在body最外层，否则可能被其它的相对元素所影响
                cancel: function () {
                    // layer.msg('捕获就是从页面已经存在的元素上，包裹layer的结构', {time: 5000, icon: 6});
                }
            });
        });
    });
</script>
<link href="__THEME__/css/custom_up_img.css" rel="stylesheet" />
<script src="__THEME__/js/custom_up_img.js"></script>
<script>
//    layui.use('layedit', function () {
//        var layedit = layui.layedit;
//        layedit.set({
//            uploadImage: {
//                url: '{:url("index/member/upload_img")}'
//            }
//        });
//        var index = layedit.build('L_content', {
//            height: 280,
//        });
//        layedit.sync(index)
//    });
</script>
{/block}