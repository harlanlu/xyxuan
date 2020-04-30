{extend name="base:base" /}
{block name="body"}

<style>
    .btnn{margin-left: 10px;}
    .layui-btn{margin-top: 5px;}
</style>

<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card layui-form ">
                 
                <div class="layui-card-header">
                    
                     <a class="layui-btn layui-btn-normal" href="<?php echo url('add') ?>"><i class="layui-icon"></i>添加</a>

                    <div class="layui-inline layui-show-xs-block" style="float:right;">
                        <button type="button" title="刷新" onclick="javascript:window.location.reload();" class="layui-btn  layui-btn-sm">
                            <i class="layui-icon">&#xe669;</i>
                        </button>
                    </div>
                </div>

                <div class="layui-card-body layui-table-body layui-table-main">


                    <table class="layui-table layui-form">

                        {$tpl_list}

                    </table>




                </div>

                <script>
                    function del(obj) {
                        obj.parentNode.parentNode.parentNode.removeChild(obj.parentNode.parentNode);
                    }
                </script>

                <div class="layui-card-body ">
                    
                     <div class="layui-input-inline">
                        <select lay-filter="set_field" href="<?php echo url('set_field', ['field' => 'cid']); ?>">
                            <option value="">转移分类</option>
                            <?php echo html_select(model('nav_cat')->dict()); ?>
                        </select>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div> 

 


{/block}