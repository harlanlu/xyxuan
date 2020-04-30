{extend name="base:base" /}
{block name="body"}

<div class="layui-card">
    <div class="layui-card-body">
        <form class="layui-form" action="">
            <div class="layui-form-item">
                <label class="layui-form-label">拒绝原因</label>
                <div class="layui-input-block">
                    <textarea name="msg" id="" cols="30" rows="10"><?php echo $one['msg'] ?></textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit lay-filter="myform">发送</button>
                </div>
            </div>
        </form>
    </div>
</div>

{/block}