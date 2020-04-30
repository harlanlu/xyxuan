{extend name="base:base" /}
{block name="body"}
{include file="index/column_nav" /}


<div class="layui-container">
    <link rel="stylesheet"  href="banner/index/swiper.css"/>
    <style>
        .demo{
            height: 430px;width: 100%;padding-bottom: 30px;
        }
        @media screen and (max-width: 990px) {
            .demo{
                height: 330px;width: 100%;padding-bottom: 30px;
            }
        }
        @media screen and (max-width: 500px) {
            .demo{
                height: 260px;width: 100%;padding-bottom: 30px;
            }
        }
        .swiper-container {
            width: 100%;
            height: 100%;
        }
        .swiper-slide {
            overflow: hidden;background-position: center;background-size: cover;
        }
        .slow{
            line-height: 1;
            width: fit-content;
            opacity: 1;z-index: 1;padding: 10px;
            background: rgba(255, 255, 255, 0.2);
        }
        .picTitle{
            color: white;margin-top: 35px;width: fit-content;margin-left: 13%;
        }
        .picTitle a{
            color: white;
        }
        .picCont{
            color: white;margin-top: 15px;word-wrap: break-word;
            word-break: break-all;margin-left: 11%;
            overflow: hidden;line-height:20px
        }
        .picUser{
            color: white;    font-size: 16px;
            margin-left: 15%;margin-top: 15px;
            font-style: italic;font-weight: bolder;
        }
        .swiper-slide-active:hover{
            cursor: move;
        }
    </style>
    <div class="demo" style="">
        <!-- Swiper -->
        <div class="swiper-container">
            <div class="swiper-wrapper">
                {volist name="banner" id="banner"}
                <div class="swiper-slide" style="background-image:url('{$banner.thumb}')">
                    <h3 class="picTitle slow"><a href="<?php echo url('/thread/' . $banner['id']) ?>" title="前往作品：{$banner.title}"> {$banner.title} </a></h3>
                    <p style="width: fit-content;" class="picCont slow">&nbsp;&nbsp;<?php if ($banner['banner_des']=='') echo '我还没想好写啥 :)';else echo cut_str($banner['banner_des'],50);?>  </p>
                    <h3 class="picUser slow"> Photo by {$banner.nickname} </h3>
                </div>
                {/volist}
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination" ></div>
            <!-- Add Navigation -->
            <div class="swiper-button-prev hide"></div>
            <div class="swiper-button-next hide"></div>
        </div>

    </div>
<!--    鼠标移出隐藏按钮，移入显示按钮-->
    <style type="text/css">
        .swiper-container .hide{
            opacity:0;
        }
        .swiper-button-next,.swiper-button-prev{
            transition:opacity .5s;
        }
    </style>
    <script src="banner/index/swiper.min.js"></script>
    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper('.swiper-container', {
            loop:true,keyboard:true,
            speed: 300,
            autoplay: {
                disableOnInteraction: false, //手动滑动之后不打断播放
                delay: 5000
            }, effect : 'coverflow',
            observer: true,
            pagination: {
                el: '.swiper-pagination',type: 'progressbar',
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
        //鼠标覆盖停止自动切换与隐藏前进后退按钮
        swiper.el.onmouseover = function(){
            swiper.navigation.$nextEl.removeClass('hide');
            swiper.navigation.$prevEl.removeClass('hide');
        }
        //鼠标覆盖停止自动切换与隐藏前进后退按钮
        swiper.el.onmouseout = function(){
            swiper.navigation.$nextEl.addClass('hide');
            swiper.navigation.$prevEl.addClass('hide');
        }
    </script>

    <div class="layui-tab layui-tab-brief" >
        <ul class="layui-tab-title">
            <li class="layui-this">网站设置</li>
            <li>用户管理</li>
            <li>权限分配</li>
            <li>商品管理</li>
            <li>订单管理</li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">1</div>
            <div class="layui-tab-item">2</div>
            <div class="layui-tab-item">3</div>
        </div>
    </div>


    <div class="layui-row layui-col-space15">
        <div class="layui-col-md8">

            <div class="fly-panel" style="margin-bottom: 0;">
                <div class="fly-panel-title fly-filter">
                    <a href="<?php
                    echo url('/column/' . request()->param('alias'));
                    ?>" <?php
                       if (empty(request()->param('type'))) {
                           echo ' class="layui-this" ';
                       }
                       ?>>综合</a>                    
                    <span class="fly-mid"></span>
                    <a href="<?php
                    echo url('/column/all/wonderful');
                    ?>" <?php
                       if (request()->param('type') == 'wonderful') {
                           echo ' class="layui-this" ';
                       }
                       ?>>精华</a>                    
                </div>
                <ul class="fly-list"> 
                    <?php
                    foreach ($lists_thread20 as $key => $value) {
                        ?>
                        <li>
                            <a href="<?php echo url('/u/' . $value['member_id']) ?>" class="fly-avatar">
                                <img src="<?php
                                if ($value['avatar'])
                                    echo res_http($value['avatar']);
                                else
                                    echo res_http('sex' . $value['sex'] . '.png');
                                ?>" alt="<?php echo $value['nickname'] ?>">
                            </a>
                            <h2>
                                <a class="layui-badge">分享</a>
                                <a href="<?php echo url('/thread/' . $value['id']) ?>"><?php echo $value['title'] ?></a>
                            </h2>
                            <div class="fly-list-info">
                                <a href="<?php echo url('/u/' . $value['member_id']) ?>" link>
                                    <cite><?php echo $value['nickname'] ?></cite>
                                    <?php if ($value['identification']) { ?>
                                        <i class="iconfont icon-renzheng" title="认证信息：{$value['identification']}"></i>
                                    <?php } ?>
                                    <?php if ($value['vip']) { ?>
                                        <i class="layui-badge fly-badge-vip">VIP{$value['vip']}</i>
                                    <?php } ?>
                                </a>
                                <span><?php echo $value['update_time'] ?></span>
                                <span class="fly-list-kiss layui-hide-xs" title="悬赏积分"><i class="layui-icon layui-icon-snowflake"></i> {$value['points']}</span>
                                <!--<span class="layui-badge fly-badge-accept layui-hide-xs">已结</span>-->
                                <span class="fly-list-nums"> 
                                    <i class="iconfont icon-pinglun1" title="回答"></i> {$value['hits_comment']}
                                </span>
                            </div>
                            <div class="fly-list-badge">
                                {eq name="$value.top" value="1"}
                                <span class="layui-badge layui-bg-black">置顶</span>
                                {/eq}
                                {eq name="$value.status" value="1"}
                                <span class="layui-badge layui-bg-red">精帖</span>
                                {/eq}
                            </div>
                        </li>
                    <?php } ?>
                </ul>
                <div style="text-align: center">
                    <div class="laypage-main">
                        <a href="<?php echo url('/column/all') ?>" class="laypage-next">查看更多</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="layui-col-md4">
            <div class="fly-panel">
                <h3 class="fly-panel-title">温馨通道</h3>
                <ul class="fly-panel-main fly-list-static">
                    <?php
                    foreach (get_nav('notice') as $key => $value) {
                        ?>
                        <li><a href="<?php echo $value['href'] ?>" target="<?php echo $value['target'] ?>"><?php echo $value['title'] ?></a></li>
                    <?php } ?>
                </ul>
            </div>
            <div class="fly-panel fly-signin">
                <div class="fly-panel-title">
                    签到
                    <i class="fly-mid"></i> 
                    <a href="javascript:;" class="fly-link" id="LAY_signinHelp">说明</a>
                    <i class="fly-mid"></i> 
                    <a href="javascript:;" class="fly-link" id="LAY_signinTop">活跃榜<span class="layui-badge-dot"></span></a>
                    <span class="fly-signin-days">已连续签到<cite>{$sign_info['num']}</cite>天</span>
                </div>
                <div class="fly-panel-main fly-signin-main">
                    <?php
                    if ($sign_info['num'] > 0) {
                        ?>
                        <button class="layui-btn layui-btn-disabled" id="LAY_signin">今日已签到</button>
        <!--                        <span>获得了<cite>20</cite>积分</span> -->
                    <?php } else { ?>
                        <button class="layui-btn layui-btn-danger" id="LAY_signin">今日签到</button>
    <!--                        <span>可获得<cite>5</cite>积分</span>-->
                    <?php } ?>   
                    <span id="sign_tip">{$sign_tip}</span>             
                </div>
                {include file="index/sign_box" /}
            </div>
            <div class="fly-panel fly-rank fly-rank-reply" id="LAY_replyRank">
                <h3 class="fly-panel-title">回复周榜</h3>
                <dl>
                  <!--<i class="layui-icon fly-loading">&#xe63d;</i>-->
                    <?php
                    foreach ($lists_member12 as $key => $value) {
                        ?>
                        <dd>
                            <a href="<?php echo url('/u/' . $value['member_id']) ?>">
                                <img src="<?php
                                if ($value['avatar'])
                                    echo res_http($value['avatar']);
                                else
                                    echo res_http('sex' . $value['sex'] . '.png');
                                ?>"><cite><?php echo $value['nickname'] ?></cite><i><?php echo $value['count'] ?>次回答</i>
                            </a>
                        </dd>
                    <?php } ?>
                </dl>
            </div>
            {include file="index/inc_week_hot" /}
            <div class="fly-panel">
                <div class="fly-panel-title">
                    这里可作为广告区域
                </div>
                <div class="fly-panel-main">
                    <a href="" target="_blank" class="fly-zanzhu" time-limit="" style="background-color: #5FB878;">旗舰之作</a>
                </div>
            </div>
            <div class="fly-panel fly-link">
                <h3 class="fly-panel-title">友情链接</h3>
                <dl class="fly-panel-main">
                    <?php
                    $friendlists = get_nav('friend_links');
                    foreach ($friendlists as $key => $value) {
                        ?>
                        <dd><a href="" target="_blank"><?php echo $value['title'] ?></a><dd>
                        <?php } ?>
                    <dd><a href="javascript:;" onclick="layer.alert('发送邮件至：aishare@qq.com<br> 邮件标题为：申请新意轩友链', {title: '申请友链'});" class="fly-link">申请友链</a><dd>
                </dl>
            </div>
        </div>
    </div>
</div>
{/block}
{block name="foot_js"}
<link rel="stylesheet" href="__THEME__/css/calendar.css" />
<script>
    layui.use('carousel', function(){
        var carousel = layui.carousel;
        //建造实例
        carousel.render({
            elem: '#banner'
            ,width: '100%' //设置容器宽度
            ,arrow: 'hover' //始终显示箭头
            ,anim: 'fade' //切换动画方式
        });
    });
</script>
{/block}