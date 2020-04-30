<div class="fly-header layui-bg-black">
    <div class="layui-container">
        <a class="fly-logo" href="<?php echo APP_URL.'/main' ?>">
            <img src="__THEME__/images/logo.png" alt="layui">
        </a>
        <ul class="layui-nav fly-nav layui-hide-xs">
            <li class="layui-nav-item layui-this">
                <a href="<?php echo APP_URL.'/' ?>"><i class="iconfont icon-jiaoliu"></i>Welcome</a>
            </li>
<!--            <li class="layui-nav-item">-->
<!--                <a href="--><?php //echo APP_URL.'/' ?><!--"><i class="iconfont icon-iconmingxinganli"></i>Welcome</a>-->
<!--            </li>-->
        </ul>
        <ul class="layui-nav fly-nav-user">
            <?php
            if (is_array($member = member_is_login())) {
                ?>
                <li  class="layui-nav-item">
                    <a class="fly-nav-avatar" href="javascript:;">
                    <cite class="layui-hide-xs" title="用户昵称：{$member.nickname}"><?php echo $member['nickname'] ?></cite>
                    {notempty name="$member.identification"}
                    <i class="iconfont icon-renzheng" title="认证信息：{$member.identification}"></i>
                    {/notempty}
                    {gt name="$member.vip" value="0"}
                    <i class="layui-badge fly-badge-vip " title="会员等级：VIP{$member.vip}">VIP{$member.vip}</i>
                    {/gt}
                    </a>
                </li>
                <!-- 登入后的状态 -->            
                <li class="layui-nav-item">
                    <a class="fly-nav-avatar" href="javascript:;">

                        <img src="<?php
            if ($member['avatar'])
                echo res_http($member['avatar']);
            else
                echo res_http('sex' . $member['sex'] . '.png');
                ?>">
                    </a>
                    <dl class="layui-nav-child">
                        <dd><a href="<?php echo url('index/member/setting') ?>"><i class="layui-icon">&#xe620;</i>基本设置</a></dd>
                        <dd><a href="<?php echo url('index/member/message') ?>"><i class="iconfont icon-tongzhi" style="top: 4px;"></i>我的消息</a></dd>
                        <dd><a href="<?php echo url('/u/0') ?>"><i class="layui-icon" style="margin-left: 2px; font-size: 22px;">&#xe68e;</i>我的主页</a></dd>
                        <hr style="margin: 5px 0;">
                        <dd><a href="<?php echo url('index/everyone/logout') ?>" style="text-align: center;">退出</a></dd>
                    </dl>
                </li>
<?php } else { ?>
                <!-- 未登入的状态 -->
                <li class="layui-nav-item">
                    <a class="iconfont icon-touxiang layui-hide-xs" href="<?php echo url('index/everyone/login') ?>"></a>
                </li>
                <li class="layui-nav-item">
                    <a href="<?php echo url('index/everyone/login') ?>">登录</a>
                </li>
                <li class="layui-nav-item">
                    <a href="<?php echo url('index/everyone/reg') ?>">注册</a>
                </li>
                <li class="layui-nav-item layui-hide-xs layui-hide">
                    <a href="/app/qq/" onclick="layer.msg('正在通过QQ登入', {icon: 16, shade: 0.1, time: 0})" title="QQ登入" class="iconfont icon-qq"></a>
                </li>
                <li class="layui-nav-item layui-hide-xs layui-hide">
                    <a href="/app/weibo/" onclick="layer.msg('正在通过微博登入', {icon: 16, shade: 0.1, time: 0})" title="微博登入" class="iconfont icon-weibo"></a>
                </li>
<?php } ?>
        </ul>
    </div>
</div>