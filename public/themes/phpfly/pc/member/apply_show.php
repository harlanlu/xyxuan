{extend name="base:base" /}
{block name="body"}
<div class="layui-container fly-marginTop">
    <style>
        .mytitle:hover{
            cursor: pointer;
        }
        .orange{color: orange;}
        .green{color: green;}
        .red{color: red;}
    </style>
    <div class="fly-panel" pad20 style="padding-top: 5px;">
        <!--<div class="fly-none">没有权限</div>-->
        <div class="layui-form layui-form-pane">
            <div class="layui-tab layui-tab-brief" lay-filter="user">

                <div class="layui-form layui-tab-content" id="LAY_ucm" style="padding: 10px 0;">
                    <div class="layui-tab-item layui-show">
                        <div class="layui-card-body layui-table-body layui-table-main" style="">
                            <h3 style="text-align:center;padding-bottom: 10px;">标题：{$info.utitle}</h3>
                            <h3 style="text-align:center;padding-bottom: 10px;">申请人：{$info.user_id|getUserName}</h3>
                            <h3 style="text-align:center;padding-bottom: 30px;">状态：
                                <td>
                                    <?php if ($info['status']==0){echo '<span class="orange">待处理</span>';}
                                    if ($info['status']==1){echo '<span class="green">已同意</span>';}
                                    if ($info['status']==-1){echo '<span class="red">已拒绝 , 原因： '.$info['msg'].'</span>';}; ?></td>

                            </h3>
                            {$info.content}

                        </div>
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