{extend name="base:base" /}
{block name="body"}
<div class="layui-container fly-marginTop">
    <!-- 编辑器源码文件 -->
    {load href="__PUBLIC__/plus/ueditor/ueditor.config.js" /}
    <!-- 实例化编辑器 -->
    {load href="__PUBLIC__/plus/ueditor/ueditor.all.js" /}
    <div class="fly-panel" pad20 style="padding-top: 5px;">
        <!--<div class="fly-none">没有权限</div>-->
        <div class="layui-form layui-form-pane">
            <div class="layui-tab layui-tab-brief" lay-filter="user">

                <div class="layui-form layui-tab-content" id="LAY_ucm" style="padding: 20px 0;">
                    <div class="layui-tab-item layui-show">
                        <form action="" method="post">
                            <input type="hidden" name="id" value="{$apply.id}" />
                            <input type="hidden" name="user_id" value="{$apply.user_id}" />

                            <div class="layui-row layui-col-space15 layui-form-item">
                                <div class="layui-col-md12 layui-form-item">
                                    <label for="L_title" class="layui-form-label">认证名称：</label>
                                    <div class="layui-input-block">
                                        <input type="text" value="{$apply.utitle}" id="L_title" name="utitle" required lay-verify="required" autocomplete="off" class="layui-input">
                                    </div>
                                </div>
                                <div class="layui-col-md12 layui-form-item">
                                    <label for="L_title" class="layui-form-label">具体内容：</label>
                                    <div class="layui-input-block">
                                        <script id="content" name="content" type="text/plain">{$apply.content}</script>
                                    </div>
                                </div>

                                <div class="layui-form-item" style="text-align:right;;">
                                    <div class="col-md-12" style="text-align: right;">
                                        <button class="layui-btn" style="width: 200px;" lay-filter="myform" lay-submit>提交</button>

                                    </div>
                                </div>
                            </div>

                            <div class="layui-form-item">
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

<script type="text/javascript">
    var ue = UE.getEditor('content',{initialFrameHeight:400});
    toolbars: [
        ['fullscreen', 'source', 'undo', 'redo'],
        // ['bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc']
    ]
</script>
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