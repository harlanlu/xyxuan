{extend name="base:base" /}
{block name="body"}
<div class="layui-container fly-marginTop fly-user-main">
    {include file="member/nav" /}
    <div class="fly-panel fly-panel-user" pad20>
        <div class="layui-tab layui-tab-brief" lay-filter="user" id="LAY_msg" style="margin-top: 15px;">
            <button class="layui-btn layui-btn-danger layui-hide" id="LAY_delallmsg">清空全部消息</button>
            <div id="LAY_minemsg" style="margin-top: 10px;">
<!--                <div class="fly-none">您暂时没有最新消息</div>-->
                <ul class="mine-msg">                           
                </ul>
            </div>
        </div>
    </div>
</div>
{/block}
{block name="foot_js"}
<script>
    layui.use(['fly', 'face','form', 'layer','member'], function () {
        var $ = layui.$
                , member = layui.member, form = layui.form, layer = layui.layer
                , fly = layui.fly;


        window.messageSend =function messageSend(name,id) {
            layer.prompt({title:'发送私信给：'+name, formType: 2}, function (text, index) {
                layer.close(index);
                fly.json(layui.baseUrl() + '/message/send', {message: text, recv_id: id}, function (res) {
                    if (res.code === 0) {
                        layer.msg('发送成功');
                    }
                });
            });
        }


    });

</script>
{/block}