{extend name="base:base" /}
{block name="body"}
<div class="layui-container fly-marginTop fly-user-main">
    {include file="member/nav" /}
    <div class="fly-panel fly-panel-user" pad20>
        <div class="layui-tab layui-tab-brief" lay-filter="type">
            <ul class="layui-tab-title" id="LAY_mine">
                <li data-type="mine-jie" lay-id="index" class="layui-this">我的作品（<span>{$count}</span>）</li>
                <li data-type="collection" data-url="/collection/find/" lay-id="wish">我的收藏（<span>{$count2}</span>）</li>
            </ul>
            <div class="layui-tab-content" style="padding: 20px 0;">
                <div class="layui-tab-item layui-show">
                    <ul class="mine-view jie-row">
                        <?php
                        foreach ($lists as $key => $value) {
                            ?>
                            <li>
                                <a class="jie-title" href="<?php echo url('/thread/' . $value['id']) ?>" target="_blank"><?php echo $value['title'] ?></a>
                                <i><?php echo $value['update_time'] ?></i>
                                <a class="mine-edit" href="<?php echo url('index/member/thread_edit', ['id' => $value['id']]) ?>"  target="_blank">编辑</a>
                                <a class="mine-edit" onclick="return confirm('你确定要删除该作品?')" style="background-color: #FF5722;" href="<?php echo url('index/member/thread_delete_a', ['id' => $value['id']]) ?>" >删除
                                </a>
                                <em><?php echo $value['hits']; ?>阅/<?php echo $value['hits_comment']; ?>回</em>
                            </li>
                        <?php } ?>
                    </ul>
                    <div id="LAY_page"></div>
                </div>
                <div class="layui-tab-item">
                    <ul class="mine-view jie-row">
                           <?php
                        foreach ($lists2 as $value2) {
                            ?>
                        <li>
                            <a class="jie-title" href="<?php echo url('/thread/' . $value2['thread_id']) ?>" target="_blank"><?php echo $value2['title'] ?></a>
                            <i><?php echo $value2['create_time'] ?></i>
                            <a class="mine-edit" onclick="return confirm('取消收藏?')" style="background-color: #FF5722;" href="<?php echo url('member/wish_remove', ['thread_id' => $value2['thread_id']]) ?>" >取消收藏</a>
                            <em><?php echo $value2['hits']; ?>阅/<?php echo $value2['hits_comment']; ?>回</em>
                        </li>
                        <?php } ?>
                    </ul>
                    <div id="LAY_page1"></div>
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