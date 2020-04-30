{extend name="base:base" /}
{block name="body"}
{include file="index/column_nav" /}
<div class="layui-container">
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
                    echo url('/column/' . request()->param('alias') . '/wonderful');
                    ?>" <?php
                       if (request()->param('type') == 'wonderful') {
                           echo ' class="layui-this" ';
                       }
                       ?>>精华</a>
                </div>
                <?php
                if ($count) {
                    ?>
                    <ul class="fly-list">         
                        <?php
                        foreach ($lists as $key => $value) {
                            ?>
                            <li>
                                <a href="<?php echo url('/u/' . $value['member_id']) ?>" class="fly-avatar">
                                    <img src="<?php
                                    if ($value['avatar'])
                                        echo res_http($value['avatar']);
                                    else
                                        echo res_http('sex' . $value['sex'] . '.png');
                                    ?>" alt="">
                                </a>
                                <h2>
                                    <a class="layui-badge"><?php echo $value['column_title'] ?></a>
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
                                    <span><?php echo substr($value['update_time'], 0, 20) ?></span>
                                    <span class="fly-list-kiss layui-hide-xs" title="人气"><i class="layui-icon layui-icon-snowflake"></i> <?php echo $value['hits'] ?></span>
                                    <!--<span class="layui-badge fly-badge-accept layui-hide-xs">已结</span>-->
                                    <span class="fly-list-nums">
                                        <i class="iconfont icon-pinglun1" title="评论"></i> <?php echo $value['hits_comment'] ?>
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
                    <div style="text-align: center;padding: 30px 0;">
                        <?php
                        echo $pager;
                        ?>
                    </div>
                <?php } else { ?>
                    <div class="fly-none">没有相关数据</div>  
                <?php } ?>
            </div>
        </div>
        <div class="layui-col-md4">
            {include file="index/inc_week_hot" /}

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