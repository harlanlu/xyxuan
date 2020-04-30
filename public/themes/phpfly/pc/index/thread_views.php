{extend name="base:base" /}
{block name="body"}
{include file="index/column_nav" /}
<div class="layui-container">
    <div style="margin: 20px auto">
                    <span class="layui-breadcrumb">
                      <a> 当前位置：</a>
                      <a href="{:url('index/main')}">首页</a>
                        <?php
                        if ($cname['pid']==0){
                            ?>
                            <a
                            <?php echo 'href="'.url('/column/' . $cname['alias']).'">'.$cname['title'].'</a>';}
                        else{
                            $p=db('thread_column')->where('id',$cname['pid'])->find();
                            ?>

                            <a
                            <?php echo 'href="'.url('/column/' . $p['alias']).'">'.$p['title'].'</a>';?>
                            <a
                            <?php echo 'href="'.url('/column/' . $cname['alias']).'">'.$cname['title'].'</a>' ;} ?>
                    </span>
    </div>
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md8 content detail">
            <div class="fly-panel detail-box">
                <h1><?php echo $title ?></h1>
                <div class="fly-detail-info">

                    <div class="fly-admin-box" style="margin-left: 0px;" data-id="<?php echo $id ?>">
                        <span class="layui-badge layui-bg-green fly-detail-column"><?php echo $column_title ?></span>
                        {eq name="top" value="1"}
                        <span class="layui-badge layui-bg-black">置顶</span>
                        {/eq}
                        {eq name="status" value="1"}
                        <span class="layui-badge layui-bg-red">精帖</span>
                        {/eq}
                        {eq name="display_del" value="1"}
                        <span class="layui-btn layui-btn-xs jie-admin" type="del">删除</span>{/eq}
                        {eq name="display_top" value="1"}
                        {eq name="top" value="0"}
                        <span class="layui-btn layui-btn-xs jie-admin" type="set" field="top" rank="1">置顶</span> 
                        {else/}
                        <span class="layui-btn layui-btn-xs jie-admin" type="set" field="top" rank="0" style="background-color:#ccc;">取消置顶</span>
                        {/eq}
                        {/eq}
                        {eq name="display_status" value="1"}
                        {eq name="status" value="0"}
                        <span class="layui-btn layui-btn-xs jie-admin" type="set" field="status" rank="1">加精</span> 
                        {else/}
                        <span class="layui-btn layui-btn-xs jie-admin" type="set" field="status" rank="0" style="background-color:#ccc;">取消加精</span>
                        {/eq}
                        {/eq}
                    </div>
                    <span class="fly-list-nums"> 
                        <a href="#comment"><i class="iconfont" title="回答">&#xe60c;</i> <?php echo $hits_comment ?></a>
                        <i class="iconfont" title="人气">&#xe60b;</i> <?php echo $hits ?>
                    </span>
                </div>
                <div class="detail-about">
                    <a class="fly-avatar" href="<?php echo url('/u/' . $member_id) ?>">
                        <img src="<?php
                        if ($avatar)
                            echo res_http($avatar);
                        else
                            echo res_http('sex' . $sex . '.png');
                        ?>" alt="<?php echo $nickname ?>">
                    </a>
                    <div class="fly-detail-user">
                        <a href="<?php echo url('/u/' . $member_id) ?>" class="fly-link">
                            <cite><?php echo $nickname ?></cite>
                            {neq  name="identification" value=""} <i class="iconfont icon-renzheng" title="认证信息：{$identification}"></i> {/neq}
                            {neq  name="vip" value=""}<i class="layui-badge fly-badge-vip">VIP{$vip}</i>{/neq}
                        </a>
                        <span><?php echo $create_time ?></span>
                    </div>
                    <div class="detail-hits">
                        <span style="padding-right:10px;color:#FF7200">悬赏：<?php echo $points ?></span>
                        <?php
                        // 如果是自己的帖子，则可以编辑
                        if (session('member.id') == $member_id) {
                            ?>
                            <span class="layui-btn layui-btn-xs jie-admin " type="edit"><a href="<?php echo url('index/member/thread_edit', ['id' => $id]) ?>" target="_blank">编辑</a></span>
                        <?php } ?>
                        <span class=" " id="LAY_jieAdmin" data-id="<?php echo $id ?>"></span>
                    </div>
                </div>
                <div style="background-color: #f8f8f8;padding-bottom: 10px;">
                <span style="padding-left: 15px;">文章简介：<?php if ($banner_des!='') echo cut_str($banner_des,50);?></span>
                </div>
                <div id="myimgs" class="detail-body photos myimgs"><?php echo $content ?></div>


            </div>
            <style>
                .dd{
                    background: #FFFFFF;margin: 10px 0px;
                    min-height: 135px;
                }
                .dl{
                    display: flex;min-height: 70px;
                    align-items: center; /*定义body的元素垂直居中*/
                    /*justify-content: center; !*定义body的里的元素水平居中*!*/
                }
                .dlInfo{
                    padding-left: 10px;
                }
            </style>
            <div class="dd">
                <p style="padding: 10px ;">下载专区：</p>

                <div class="dl">

                <div id="download" class="dlInfo">
                <?php
                if ($m_id==$art['member_id']){
                    if ($art['lianjie']==''){
                        echo '未设置下载链接';
                    }else{
                        echo '下载链接为：<br>'.$art['lianjie'];
                    }
                }else{

                if ($is_bbs==1){
                    //求助帖
                    if ($art['lianjie']==''){
                       echo '未设置下载链接';
                    }else{
                        echo '下载链接为：<br>'.$art['lianjie'];
                    }
                }else{
                    //作品
                    if ($art['lianjie']==''){
                        echo '未设置下载链接';
                    }else{
                        $is_buy=db('buy_art')->where('art','=',$id)->where('buyer','=',$m_id)->find();
                        if ($is_buy){
                            echo '下载链接为：<br>'.$art['lianjie'];
                        }else{
                ?>
                            <button id="buy" class="layui-btn layui-btn-radius layui-btn-normal"><i class="layui-icon">&#xe601;</i> 下载地址</button>

                <?php
                        } }
                } }
                ?>
                </div>
            </div>
            </div>
            <div class="fly-panel detail-box" id="flyReply">
                <fieldset class="layui-elem-field layui-field-title" style="text-align: center;">
                    <legend>畅所欲言</legend>
                </fieldset>
                <ul class="reply" id="reply">
                    <?php
                    if ($lists_comment_count) {
                        ?>
                        <?php
                        foreach ($lists_comment as $key => $value) {
                            ?>
                            <li data-id="<?php echo $value['id'] ?>">
                                <a name="item-1111111111"></a>
                                <div class="detail-about detail-about-reply">
                                    <a class="fly-avatar" href="<?php echo url('/u/' . $value['member_id']) ?>">
                                        <img src="<?php
                                        if ($value['avatar'])
                                            echo res_http($value['avatar']);
                                        else
                                            echo res_http('sex' . $value['sex'] . '.png');
                                        ?>" alt=" ">
                                    </a>
                                    <div class="fly-detail-user">
                                        <a href="<?php echo url('/u/' . $value['member_id']) ?>" class="fly-link">
                                            <span style="display: none;"><?php echo $value['member_id'] ?></span>
                                            <cite><?php echo $value['nickname'] ?></cite>       
                                        </a>
                                    </div>
                                    <div class="detail-hits">
                                        <span><?php echo $value['create_time'] ?></span>
                                    </div>
                                </div>
                                <div class="detail-body reply-body photos"><?php echo $value['content'] ?></div>
                                <div class="reply-box">
                                    <span class="reply-zan <?php
                                    if ($value['hits_zan']) {
                                        echo 'zanok';
                                    }
                                    ?>" type="zan">
                                        <i class="iconfont icon-zan"></i>
                                        <em><?php echo $value['hits_zan'] ?></em>
                                    </span>
                                    <span type="reply">
                                        <i class="iconfont icon-svgmoban53"></i>
                                        回复
                                    </span>
                                    <div class="reply-admin">
                                        {eq name="$value.display_comment_edit" value="1"} <span type="edit">编辑</span> {/eq}
                                        {eq name="$value.display_comment_del" value="1"} <span type="del">删除</span>{/eq}
<!--                                        {eq name="$value.display_comment_accept" value="1"} <span class="reply-accept" type="accept">采纳</span>{/eq}-->
                                    </div>
                                </div>
                            </li>
                        <?php } ?>
                    <?php } else { ?>
                        <!-- 无数据时 -->
                        <li class="fly-none">消灭零回复</li>
                    <?php } ?>
                </ul>
                <div class="layui-form layui-form-pane">
                    <form action="<?php echo url('index/index/thread_comment_add') ?>" method="post">
                        <input type="hidden" value="{$id}" name="thread_id" />
                        <div class="layui-form-item layui-form-text">
                            <a name="comment"></a>
                            <div class="layui-input-block">
                                <textarea id="L_content" name="content" required lay-verify="required" placeholder="请输入内容"  class="layui-textarea fly-editor" style="height: 150px;"></textarea>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <input type="hidden" name="jid" value="123">
                            <button class="layui-btn" lay-filter="myform" lay-submit>提交回复</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="layui-col-md4">
            {include file="index/inc_week_hot" /}
            <div class="fly-panel">
<!--                <div class="fly-panel-title">-->
<!--                    这里可作为广告区域-->
<!--                </div>-->
<!--                <div class="fly-panel-main">-->
<!--                    <a href="" target="" class="fly-zanzhu" time-limit="2017.09.25-2099.01.01" style="background-color: #5FB878;">旗舰之作</a>-->
<!--                </div>-->
                <div class="fly-panel fly-link">
                    <h3 class="fly-panel-title">友情链接</h3>
                    <dl class="fly-panel-main">
                        <?php
                        $friendlists = get_nav('friend_links');
                        foreach ($friendlists as $key => $value) {
                        ?>
                        <dd><a href="<?php echo $value['href'] ?>" target="_blank"><?php echo $value['title'] ?></a><dd>                        <?php } ?>
                        <dd><a href="javascript:;" onclick="layer.alert('发送邮件至：aishare@qq.com<br> 邮件标题为：申请新意轩友链', {title: '申请友链'});" class="fly-link">申请友链</a><dd>
                    </dl>
                </div>
            </div>
            <div class="fly-panel" style="padding: 20px 0; text-align: center;">
                <style>
                    #qrcode>img{margin: 0 auto;}
                </style>
                <div style="text-align:center;">
                    <p style="padding-bottom: 10px">手机扫一扫</p>
                    <div id="qrcode" style="text-align:center;">
                    </div>
                </div>
                <!-- <img src="__THEME__/images/weixin.png" style="max-width: 80%;" alt="新意轩摄影">
                <p style="position: relative; color: #666;">微信扫码关注 新意轩 公众号</p> -->
            </div>
        </div>
    </div>
</div>
{/block}
{block name="foot_js"}
<!--{load href="/libs/jquery/3.2.1/jquery.min.js"}-->
<script>
    layui.use(['fly', 'face', 'reply'], function () {
        var $ = layui.$
                , reply = layui.reply
                , fly = layui.fly;
        $('.detail-body').each(function () {
            var othis = $(this), html = othis.html();
            othis.html(fly.content(html));
        });

        // $(document).on("mousewheel DOMMouseScroll", ".myimgs img",
        //     function(e) {
        //         var delta = (e.originalEvent.wheelDelta && (e.originalEvent.wheelDelta > 0 ? 1 : -1)) || // chrome & ie
        //             (e.originalEvent.detail && (e.originalEvent.detail > 0 ? -1 : 1)); // firefox
        //         var imagep = $(".myImg").parent();
        //         var image = $(".myImg");
        //         var h = image.height();
        //         var w = image.width();
        //         if (delta > 0) {
        //             if (h < (window.innerHeight)) {
        //                 h = h * 1.05;
        //                 w = w * 1.05;
        //             }
        //         } else if (delta < 0) {
        //             if (h > 100) {
        //                 h = h * 0.95;
        //                 w = w * 0.95;
        //             }
        //         }
        //         imagep.css("top", (window.innerHeight - h) / 2);
        //         imagep.css("left", (window.innerWidth - w) / 2);
        //         image.height(h);
        //         image.width(w);
        //         imagep.height(h);
        //         imagep.width(w);
        //     });

        $('#buy').click(function (e) {
            layer.open({
                title:'购买作品',
                shadeClose:true,icon:3,
                content: '您将要花费{$art.jifen}积分购买作品{$art.title}的下载链接？'
                ,btn: ['购买', '取消']
                ,yes: function(index, layero){
                    //按钮【按钮一】的回调
                    // {$m_id} # {$member_id} # {$id} # {$art.jifen} #{$is_bbs}

                    $.ajax({
                        url:"{:url('index/buyArticle')}",
                        type:'post',
                        dataType:'json',
                        data:{
                            art:{$id},
                            zuozhe:{$member_id},
                            buyer:{$m_id},
                            jifen:{$art.jifen}
                        },
                        //购买作品
                        success:function(data){
                            if (data.status == 1) {
                                //成功
                                document.getElementById("download").innerText='下载链接为：'+data.lian;
                                layer.msg(data.msg, {
                                    // offset: '150px',
                                    icon: 1
                                    ,time: 1000
                                });
                            }else if (data.status == -1) {
                                //请先登录
                                layer.msg(data.msg, {
                                    // offset: '150px',
                                    icon: 2
                                    ,time: 1000
                                });
                            }else if (data.status == 0) {
                                //积分不足
                                layer.msg(data.msg, {
                                    // offset: '150px',
                                    icon: 2
                                    ,time: 1000
                                });
                            }else if (data.status == -2) {
                                //请求错误
                                layer.msg(data.msg, {
                                    // offset: '150px',
                                    icon: 2
                                    ,time: 1000
                                });
                            }
                        },
                        fail:function (e) {
                            layer.msg('网络错误！', {
                                // offset: '150px',
                                icon: 2
                                ,time: 1000
                            });
                        }
                    })
                }
            });

            }
        );


        layer.ready(function(){
            // 使用相册
            layer.photos({
                photos: '.myimgs',
                shift:0,  // 动画类型 0 -6 选择
                    area:['60%','auto'],  // 调节寬width height  ['600px','500px']
                // closeBtn:1  // 是否显示关闭按钮 默认为0 不显示 1/2 2种风格
            });
        });





    });

</script>
<!-- <script type="text/javascript" src="/jianli/js/vendor/jquery-1.12.4.min.js"></script> -->
<script type="text/javascript" src="__PUBLIC__/static/qrcode.min.js"></script>
<script type="text/javascript">
    //初始化存放二维码的div
    var qrcode = new QRCode(document.getElementById("qrcode"), {
        width : 100,
        height : 100
    });
    //window.location.href获取到URL
    qrcode.makeCode(window.location.href);

</script>
{/block}