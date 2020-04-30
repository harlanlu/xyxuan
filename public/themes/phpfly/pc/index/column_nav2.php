<div class="fly-panel fly-column">
    <div class="layui-container">
        <ul class="layui-clear">
            <li class="layui-hide-xs <?php 
            ?>"><a href="<?php echo APP_URL.'/main' ?>">首页</a></li>
            <?php
            $columns = db('thread_column')->where('pid',0)->select();
            foreach ($columns as $key => $value) {
                $current = '';
                if($value['alias'] == input('param.alias')){
                    $current = 'class="layui-this"';
                }
                ?>
            <li <?php echo $current;?>><a href="<?php echo url('/column/' . $value['alias']) ?>"><?php echo $value['title'] ?></a></li>
            <?php } ?>

            <li class="layui-hide-xs layui-hide-sm layui-show-md-inline-block"><span class="fly-mid"></span></li> 
            <!-- 用户登入后显示 -->
            <li class="layui-hide-xs layui-hide-sm layui-show-md-inline-block"><a href="<?php echo url('index/member/thread') ?>">我的作品</a></li>
            <li class="layui-hide-xs layui-hide-sm layui-show-md-inline-block"><a href="<?php echo url('index/member/thread') ?>#type=wish">我的收藏</a></li>
        </ul> 
        <div class="fly-column-right layui-hide-xs"> 
            <span class="fly-search"><i class="layui-icon"></i></span> 
            <a href="<?php echo url('index/member/thread_add') ?>" class="layui-btn">发表作品</a>
        </div> 
<!--        <div class="layui-hide-sm layui-show-xs-block" style="margin-top: -10px; padding-bottom: 10px; text-align: center;"> -->
<!--            <a href="--><?php //echo url('index/member/thread_add') ?><!--" class="layui-btn">发表作品</a>-->
<!--        </div> -->
    </div>
</div>

