
<div class="fly-panel fly-column">
    <div class="layui-container">

        <!--        nav-->
        <link rel="stylesheet" href="__PUBLIC__/nav/css/jq22.css">
        <script src="__PUBLIC__/nav/js/jquery-latest.min.js" type="text/javascript"></script>
        <script src="__PUBLIC__/nav/js/jq22.js"></script>
        <!--        nav end-->
<!--        nav start-->

<div id='cssmenu' style="margin-top: 10px;margin: 0 auto">
    <ul>
        <li class=""><a href="<?php echo APP_URL.'/main' ?>">首页</a></li>
        <?php
        $i=0;
        $columnss = db('thread_column')->where('pid',0)->order('listorder asc')->select();
        foreach ($columnss as $key => $value) {
            $current = '';$subs = '';
            if($value['alias'] == input('param.alias')){
                $current = ' active ';
            }
            $i++;
            ?>
            <li class="<?php echo $subs.$current;?>">
                <a href="<?php echo url('/column/' . $value['alias']) ?>"><?php echo $value['title'] ?></a>
                <?php

                $subnav=db('thread_column')->where('pid',$value['id'])->order('listorder asc')->select();
                if($subnav){
                    $subs = ' has-sub ';
                    ?>
                    <ul style="z-index: 9999;" class="subUl<?php echo $i?>">
                        <?php
                        foreach ($subnav as $key1 => $value1) {
                            ?>
                            <li class="mysubli" style="border-bottom: 1px solid rgba(120, 120, 120, 0.15);">
                                <a href="<?php echo url('/column/' . $value1['alias']) ?>"><?php echo $value1['title'] ?></a>
                            </li>
                        <?php }   ?>
                    </ul>
                    <style>
                        .subUl<?php echo $i?>{
                            height: <?php echo 54*($key1+1)?>px;
                        }
                    </style>
                <?php }   ?>
            </li>
        <?php  } ?>
        <li style="float:right;">  <span title="搜索" style="padding-top: 17px;" class="fly-search"><i class="layui-icon"></i></span>   </li>
    </ul>

</div>

<!--    nav  end-->


    </div>
</div>