{extend name="base:base" /}
{block name="body"}
<div class="column">
    <div class="column-left">
        <div class="resize-bar"></div>
        <div class="resize-line"></div>
        <div class="resize-save" id="tree"></div>
    </div>
    <div class="column-right">
        <iframe id="iframe_list"
                src="<?php echo $iframe_src; ?>"
                width="100%" height="100%" frameborder="0"></iframe>
    </div>
</div>
<style>
    .column {
        overflow: hidden;
    }
    .column-left {
        background: #fafafa;
        position: relative;
        float: left;
    }
    .column-right {
        box-sizing: border-box;
        overflow: hidden;
    }
    .resize-save {
        position: absolute;
        top: 0; right: 5px; bottom: 0; left: 0;
        overflow-x: hidden;
        padding-top: 10px;
    }
    .resize-bar {
        width: 150px;
        height: inherit;
        resize: horizontal;
        cursor: ew-resize;
        cursor: col-resize;
        opacity: 0;
        overflow: scroll;
        border: 1px solid blue;
    }
    /* 拖拽线 */
    .resize-line {
        position: absolute;
        right: 0; top: 0; bottom: 0;
        border-left: 2px solid #EFEEF0;
        pointer-events: none;
    }
    .resize-bar:hover ~ .resize-line,
    .resize-bar:active ~ .resize-line {
        border-left: 2px dashed skyblue;
    }
    .resize-bar::-webkit-scrollbar {
        width: 200px; height: inherit; border: 1px solid yellow;
    }
    /* Firefox只有下面一小块区域可以拉伸 */
    @supports(-moz-user-select:none) {
        .resize-bar:hover ~ .resize-line,
        .resize-bar:active ~ .resize-line {
            border-left: 1px solid #bbb;
        }
        .resize-bar:hover ~ .resize-line::after,
        .resize-bar:active ~ .resize-line::after {
            content: '';
            position: absolute;
            width: 16px; height: 16px;
            bottom: 0; right: -8px;
            background: url(__PUBLIC__/static/admin/img/resize.svg);
            background-size: 100% 100%;
        }
    }
</style>
{/block}
{block name="foot_js"}
<script>
    layui.use(['jquery', 'layer', 'tree', 'utils'], function () {
        var $ = layui.$
            , layer = layui.layer
            , form = layui.form
            , utils = layui.utils;
        // 加载前显示loading
        var loading = layer.load(1);
        // 加载完毕隐藏loading
        $('#iframe_list').on('load', layer.close(loading));
        layui.tree({
            elem: '#tree' //传入元素选择器
            , nodes: [<?php echo $nodes; ?>],
            click: function (node) {
                if (node.id) {
                    $('#iframe_list').attr('src', '<?php echo $iframe_src; ?>?category=' + node.id);
                } else {
                    $('#iframe_list').attr('src', '<?php echo $iframe_src; ?>');
                }
            }
        });
        utils.onresize(function () {
            $('.column-left').css('height', $(window).height());
            $('.column-right').css('height', $(window).height());
        });
    });
</script>
{/block}