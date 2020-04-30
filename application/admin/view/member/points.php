{extend name="base:base" /}
{block name="body"}

<div class="layui-card">
    <div class="layui-card-body">
        <form class="layui-form" action="">

            <div class="layui-form-item">
                <label class="layui-form-label">原积分</label>
                <div class="layui-input-block">
                    <span><?php echo $points ?></span>
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">修改积分</label>
                <div class="layui-input-block">
                    <input type="number" name="points" required value="" lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                </div>
            </div>



            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit lay-filter="myform">修改</button>
                </div>
            </div>
        </form>
    </div>
</div>
{/block}