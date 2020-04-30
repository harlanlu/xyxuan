{extend name="base:base" /}
{block name="body"}

<div class="layui-container fly-marginTop fly-user-main">
    {include file="member/nav" /}
    <div class="fly-panel fly-panel-user" pad20>
        <div class="layui-tab layui-tab-brief" lay-filter="type">
            <p style="padding: 10px;">当前积分为：{$myfen['points']}</p>
            <ul class="layui-tab-title" id="LAY_mine">
                <li data-type="mine-jie" lay-id="buy" class="layui-this">购买积分</li>
                <li data-type="collection" data-url="/collection/find/" lay-id="histroys">购买历史（<span>{$count}</span>）</li>
                <li data-type="ru" lay-id="ru"  >我的收入（<span>{$ru_num}</span>）</li>
                <li data-type="chu" lay-id="chu"  >我的支出（<span>{$chu_num}</span>）</li>

            </ul>
            <style>
                .my-y{
                    height: 550px;
                    overflow-y: scroll;
                }
            </style>
            <div class="layui-tab-content" style="padding: 20px 0;">
                <div class="layui-tab-item layui-show">
                    <p class="layui-col-md-offset2 " style="padding: 10px;color: red">测试版，只是增加了积分，并未对接真实支付系统！</p>
                    <form action="{:url('member/buy_jifen')}" method="post" class="layui-form">
                        <div class="layui-row layui-col-space15 layui-form-item">
                            <div class="layui-col-md12 layui-form-item">
                                <div class="layui-input-block layui-col-md5">
                                    <input type="hidden" name="user_id" value="{$member['id']}">
                                    购买积分值：<input type="number" id="L_title" value="1" name="jifen" required lay-verify="required" autocomplete="off" class="layui-input">
                                </div>
                            </div>
                            <div class=" layui-col-md12 layui-form-item">
                                <div class="layui-input-block layui-col-md5">
                                    所需金额（元）：<input type="number" value="0"  class="layui-input">
                                </div>
                            </div>

                            <div class=" layui-col-md12 layui-form-item" >
                                <div class="layui-input-block layui-col-md5"  style="text-align:right;">
                                    <button type="submit" style="width: 200px;" class="layui-btn" >提交</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="layui-tab-item my-y">
                    <ul class="mine-view jie-row">
                        <?php
                        foreach ($lists as $key => $value) {
                            ?>
                            <li>
                                <i style="padding-left: 20px;">···<?php echo '购买了'.$value['jifen'].'积分------';echo date('Y-m-d H:i:s',$value['dotime']); ?></i>
                                <!--                                <em></em>-->
                            </li>
                        <?php } ?>
                    </ul>
                    <div id="LAY_page"></div>
                </div>
                <style>
                    .myArt{
                        color: #ff943e;}
                </style>
<!--                // 收入-->
                <div class="layui-tab-item my-y">
                    <ul class="mine-view jie-row">
                        <?php

                        foreach ($ru as $key => $value) {
                            ?>
                            <li>
                                <i style="padding-left: 20px;">---<?php echo getUserName($value['buyer']).'---花费'.$value['jifen'].'积分--购买了我的作品 <span class="myArt">'.getArtName($value['art']).'</span>的下载链接----';echo date('Y-m-d H:i:s',$value['dotime']); ?></i>
                                <!--                                <em></em>-->
                            </li>
                        <?php } ?>
                    </ul>
                    <div id="LAY_page"></div>
                </div>

                <!--                // 支出-->

                <div class="layui-tab-item my-y">
                    <ul class="mine-view jie-row">
                        <?php
                        foreach ($chu as $key => $value) {
                            ?>
                            <li>
                                <i style="padding-left: 20px;"><?php echo '---我花费'.$value['jifen'].'积分--购买了用户：--'.getUserName($value['zuozhe']).'--的作品 <span class="myArt">'.getArtName($value['art']).'</span>的下载链接----';echo date('Y-m-d H:i:s',$value['dotime']); ?></i>
                                <!--                                <em></em>-->
                            </li>
                        <?php } ?>
                    </ul>
                    <div id="LAY_page"></div>
                </div>
            </div>
        </div>
    </div>
</div>
{/block}
{block name="foot_js"}

<script>
    layui.use(['fly', 'face','form', 'layer','member'], function () {
        var $ = layui.$,
                layer = layui.layer,
                element = layui.element
            , member = layui.member, form = layui.form
            , fly = layui.fly;
        //获取hash来切换选项卡，假设当前地址的hash为lay-id对应的值
        var layid = location.hash.replace(/^#type=/, '');
        element.tabChange('type', layid); //假设当前地址为：http://a.com#test1=222，那么选项卡会自动切换到“发送消息”这一项
        //监听Tab切换，以改变地址hash值
        element.on('tab(type)', function () {
            location.hash = 'type=' + this.getAttribute('lay-id');
        });

    });
</script>
{/block}