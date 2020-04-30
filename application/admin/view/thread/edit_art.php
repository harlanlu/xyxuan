{extend name="base:base" /}
{block name="body"}

<div class="layui-card" style="">
    <div class="layui-card-body">
        <form class="layui-form" action="">
            <div class="layui-form-item">
                <label class="layui-form-label">下载链接：</label>
                <div class="layui-input-block">
                    <textarea name="lianjie" id="" cols="30" rows="5"  style="text-align: left"><?php echo $one['lianjie'] ?></textarea>
<!--                    <input type="text" name="lianjie" value="--><?php //echo $one['lianjie'] ?><!--" lay-verify="required" placeholder="" autocomplete="off" class="layui-input">-->
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">下载积分:</label>
                <div class="layui-input-block">
                    <input type="number" name="jifen" value="<?php echo $one['jifen'] ?>" lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">求助积分:</label>
                <div class="layui-input-block">
                    <input type="number" name="points" value="<?php echo $one['points'] ?>" lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                </div>
            </div>

            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit lay-filter="myform">更新</button>
                </div>
            </div>
        </form>
    </div>
</div>

{/block}