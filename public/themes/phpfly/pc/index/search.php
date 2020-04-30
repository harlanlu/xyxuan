{extend name="base:base" /}
{block name="body"}
{include file="index/column_nav" /}
<div class="layui-container">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="fly-panel" style="margin-bottom: 0;">

                <div class="fly-panel-title fly-filter">
                    <h4>搜索结果：{$keywords}</h4>
                </div>
                <?php
                $count=db('thread')->select();
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
                                    <a class="layui-badge"><?php echo getCateName($value['cid']) ?></a>
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
                                    <span><?php  echo date('Y-m-d H:i:s',$value['update_time']); ?></span>
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

</div>
{/block}
{block name="foot_js"}

{/block}