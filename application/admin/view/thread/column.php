
{extend name="base:base" /}


{block name="body"}


<style>
    .btnn{margin-left: 10px;}
    .layui-btn{margin-top: 5px;}
</style>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card layui-form">

                <div class="layui-card-header">
                    <a class="layui-btn layui-btn-normal" href="<?php echo url('admin/thread/column_add') ?>"><i class="layui-icon"></i>添加</a>
                    <div class="layui-inline layui-show-xs-block" style="float:right;">
                        <button type="button" title="刷新" onclick="javascript:window.location.reload();" class="layui-btn  layui-btn-sm">
                            <i class="layui-icon">&#xe669;</i>
                        </button>
                    </div>
                </div>
                <div class="layui-card-body " style="overflow-x:scroll;">
                    <table class="layui-table">
                        {$tpl_list}
                    </table>
                </div>
                <div class="layui-card-body ">
                    <div class="page">

                        {$page}

                    </div>
                </div>

            </div>
        </div>
    </div>
</div> 
{/block}

