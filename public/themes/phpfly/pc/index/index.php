{extend name="base:base" /}
{block name="body"}
{include file="index/column_nav" /}


<div class="layui-container">
    <link rel="stylesheet"  href="banner/index/swiper.css"/>
    <style>
        .demo{
            height: 430px;width: 100%;padding-bottom: 30px;
        }
        @media screen and (max-width: 990px) {
            .demo{
                height: 330px;width: 100%;padding-bottom: 30px;
            }
        }
        @media screen and (max-width: 500px) {
            .demo{
                height: 260px;width: 100%;padding-bottom: 30px;
            }
        }
        .swiper-container {
            width: 100%;
            height: 100%;
        }
        .swiper-slide {
            overflow: hidden;background-position: center;background-size: cover;
        }
        .slow{
            line-height: 1;
            width: fit-content;width: -moz-fit-content;
            opacity: 1;z-index: 1;padding: 10px;
            background: rgba(255, 255, 255, 0.2);
        }
        .picTitle{
            color: white;margin-top: 35px;width: fit-content;margin-left: 13%;
        }
        .picTitle a{
            color: white;
        }
        .picCont{
            color: white;margin-top: 15px;word-wrap: break-word;
            word-break: break-all;margin-left: 11%;
            overflow: hidden;line-height:20px
        }
        .picUser{
            color: white;    font-size: 16px;
            margin-left: 15%;margin-top: 15px;
            font-style: italic;font-weight: bolder;
        }
        .swiper-slide-active:hover{
            cursor: move;
        }
    </style>
    <div class="demo" style="">
        <!-- Swiper -->
        <div class="swiper-container">
            <div class="swiper-wrapper">
                {volist name="banner" id="banner"}
                <div class="swiper-slide" style="background-image:url('{$banner.thumb}')">
                    <h3 class="picTitle slow"><a href="<?php echo url('/thread/' . $banner['id']) ?>" title="前往作品：{$banner.title}"> {$banner.title} </a></h3>
<!--                    <p style="width: fit-content;" class="picCont slow">&nbsp;&nbsp;--><?php //echo cut_str($banner['banner_des'],50);?><!--  </p>-->
                    <h3 class="picUser slow"> Photo by {$banner.nickname} </h3>
                </div>
                {/volist}
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination" ></div>
            <!-- Add Navigation -->
            <div class="swiper-button-prev hide"></div>
            <div class="swiper-button-next hide"></div>
        </div>

    </div>
<!--    鼠标移出隐藏按钮，移入显示按钮-->
    <style type="text/css">
        .swiper-container .hide{
            opacity:0;
        }
        .swiper-button-next,.swiper-button-prev{
            transition:opacity .5s;
        }
    </style>
    <script src="banner/index/swiper.min.js"></script>
    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper('.swiper-container', {
            loop:true,keyboard:true,
            speed: 300,
            autoplay: {
                disableOnInteraction: false, //手动滑动之后不打断播放
                delay: 5000
            }, effect : 'coverflow',
            observer: true,
            pagination: {
                el: '.swiper-pagination',type: 'progressbar',
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
        //鼠标覆盖停止自动切换与隐藏前进后退按钮
        swiper.el.onmouseover = function(){
            swiper.navigation.$nextEl.removeClass('hide');
            swiper.navigation.$prevEl.removeClass('hide');
        }
        //鼠标覆盖停止自动切换与隐藏前进后退按钮
        swiper.el.onmouseout = function(){
            swiper.navigation.$nextEl.addClass('hide');
            swiper.navigation.$prevEl.addClass('hide');
        }
    </script>

<!--以图片形式展示-->
    <link rel="stylesheet" type="text/css" href="gallery/fonts/font-awesome-4.3.0/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="gallery/css/style2.css" />
    <script src="gallery/js/modernizr-custom.js"></script>
    <style>
        .mytitles{
            padding: 20px;width: 80%;
            overflow: hidden;
        }
        .mytitles a{
            color: #FFFFFF;
        }
        .des{
            padding:20px;width: 80%;
        }
        .nicknames{
            font-size: 20px;padding-left: 20px;
        }
        .nicknames a{
            color: #FFFFFF;
        }
        .description{overflow: hidden;}
        .myhover a:hover{ border:2px solid #33CCFF;}
        .myhover .fakeTitle{ display:none;}
        .myhover:hover .fakeTitle
        { display:block; position:absolute; bottom:10px; width:80%; left:10%;
            height:34px;
            z-index:10000; text-align:center;color: black;font-size: 24px;
           overflow: hidden;
        }
        .myhover:hover .myp
        { display:block; position:absolute; bottom:10px; width:100%; left:0;
            height:34px;filter:alpha(opacity=30);-moz-opacity:0.3;opacity:0.3;
            z-index:10000; text-align:center;color: black;font-size: 24px;
            background: #FFFFFF;overflow: hidden;
        }
        .fakeTitle .mytitles{
            overflow: hidden;}
    </style>
    <div class="container  js csstransitions" style="background: white;">
        <h3 class="center" style="text-align: center;padding: 20px;">作品欣赏</h3>
    <div class="content">
        <div class="grid">
            {volist name="lists_thread20" id="gallery"}

            <div class="grid__item myhover" data-size="22x22">
                <p class="myp">
                <h4 class="fakeTitle"><?php echo cut_str($gallery['title'],15);?></h4>
                </p>
                <a href="{$gallery.thumb}" class="img-wrap" onload="getimg({$gallery.thumb},this);">
                    <img src="{$gallery.thumb}" alt="{$gallery.title}" />
                </a>
                    <div class="description description--grid">
                            <h3 class="mytitles" title="前往作品：{$gallery.title}">
                                <a target="_blank" href="<?php echo url('/thread/' . $gallery['id']) ?>"><?php echo cut_str($gallery['title'],15);?></a>
                            </h3>

                        <p class="des" ><?php   echo $gallery['banner_des'];?>  </p>
                        <br>
                        <em title="前往-{$gallery.nickname}-的主页" class="nicknames">
                                <a target="_blank" href="<?php echo url('/u/' . $gallery['member_id']) ?>">
                                Photo By ： {$gallery.nickname}</a>
                        </em>
                        <div class="details">

                        </div>
                    </div>

            </div>
           
            {/volist}

        </div>
        <!-- /grid -->
        <div class="preview">
            <button class="action action--close">
                <i class="fa fa-times" style="font-size: 50px"></i><span class="text-hidden">Close</span>
            </button>
            <div class="description description--preview"></div>
        </div>
        <!-- /preview -->
    </div>
        <div style="text-align: center">
            <div class="laypage-main">
                <a href="<?php echo url('/column/all') ?>" class="laypage-next">查看更多</a>
            </div>
        </div>
    </div>
    <script src="gallery/js/imagesloaded.pkgd.min.js"></script>
    <script src="gallery/js/masonry.pkgd.min.js"></script>
    <script src="gallery/js/classie.js"></script>
    <script src="gallery/js/main.js"></script>
    <script>
        //获取图片原始宽度
        function getimg(img_url,obj) {
            var img = new Image();
            var dd=obj.parentNode;
            img.src = img_url;
            if(img.complete){
                dd.setAttribute("data-size",img.width+'x'+img.height);
            }else{
                img.onload = function(){
                    dd.setAttribute("data-size",img.width+'x'+img.height);
                }
            }
        }
    </script>
    <script>
        (function() {
            var support = { transitions: Modernizr.csstransitions },
                // transition end event name
                transEndEventNames = { 'WebkitTransition': 'webkitTransitionEnd', 'MozTransition': 'transitionend', 'OTransition': 'oTransitionEnd', 'msTransition': 'MSTransitionEnd', 'transition': 'transitionend' },
                transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ],
                onEndTransition = function( el, callback ) {
                    var onEndCallbackFn = function( ev ) {
                        if( support.transitions ) {
                            if( ev.target != this ) return;
                            this.removeEventListener( transEndEventName, onEndCallbackFn );
                        }
                        if( callback && typeof callback === 'function' ) { callback.call(this); }
                    };
                    if( support.transitions ) {
                        el.addEventListener( transEndEventName, onEndCallbackFn );
                    }
                    else {
                        onEndCallbackFn();
                    }
                };

            new GridFx(document.querySelector('.grid'), {
                imgPosition : {
                    x : -0.5,
                    y : 1
                },
                onOpenItem : function(instance, item) {
                    instance.items.forEach(function(el) {
                        if(item != el) {
                            var delay = Math.floor(Math.random() * 50);
                            el.style.WebkitTransition = 'opacity .5s ' + delay + 'ms cubic-bezier(.7,0,.3,1), -webkit-transform .5s ' + delay + 'ms cubic-bezier(.7,0,.3,1)';
                            el.style.transition = 'opacity .5s ' + delay + 'ms cubic-bezier(.7,0,.3,1), transform .5s ' + delay + 'ms cubic-bezier(.7,0,.3,1)';
                            el.style.WebkitTransform = 'scale3d(0.1,0.1,1)';
                            el.style.transform = 'scale3d(0.1,0.1,1)';
                            el.style.opacity = 0;
                        }
                    });
                },
                onCloseItem : function(instance, item) {
                    instance.items.forEach(function(el) {
                        if(item != el) {
                            el.style.WebkitTransition = 'opacity .4s, -webkit-transform .4s';
                            el.style.transition = 'opacity .4s, transform .4s';
                            el.style.WebkitTransform = 'scale3d(1,1,1)';
                            el.style.transform = 'scale3d(1,1,1)';
                            el.style.opacity = 1;

                            onEndTransition(el, function() {
                                el.style.transition = 'none';
                                el.style.WebkitTransform = 'none';
                            });
                        }
                    });
                }
            });
        })();
    </script>

    <!--以图片形式展示  end-->
</div>
{/block}
{block name="foot_js"}
<link rel="stylesheet" href="__THEME__/css/calendar.css" />
<script>
    layui.use('carousel', function(){
        var carousel = layui.carousel;
        //建造实例
        carousel.render({
            elem: '#banner'
            ,width: '100%' //设置容器宽度
            ,arrow: 'hover' //始终显示箭头
            ,anim: 'fade' //切换动画方式
        });
    });
</script>
{/block}