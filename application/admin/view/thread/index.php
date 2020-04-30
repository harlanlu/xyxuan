
{extend name="base:base" /}


{block name="body"}

<style>
    .btnn{margin-left: 10px;}
    .layui-btn{margin-top: 5px;}
</style>

<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card layui-form" style="padding-bottom: 80px;">

                <div class="layui-card-body">


                    <form class=" layui-col-space5">

                        <div class="layui-input-inline layui-show-xs-block">
                            <input class="layui-input" placeholder="标题" name="title" id="title">
                        </div>

                        <div class="layui-input-inline layui-show-xs-block">
                            <select name="contrller">
                                <option value="">帖子状态</option>
                                <option value="0">置顶</option>
                                <option value="1">推荐</option>
                                <option value="2">锁定</option>
                            </select>
                        </div>

                        <div class="layui-input-inline layui-show-xs-block">
                            <button class="layui-btn" lay-submit="" lay-filter="search">
                                <i class="layui-icon">&#xe615;</i></button>
                        </div>

                        <div class="layui-inline layui-show-xs-block" style="float:right;">
                            <button type="button" title="刷新" onclick="javascript:window.location.reload();" class="layui-btn  layui-btn-sm">
                                <i class="layui-icon">&#xe669;</i>
                            </button>
                        </div>
                    </form>

                </div>
                <style>
                    .btnn{margin-left: 10px;}
                    .layui-btn{margin-top: 5px;}
                    .mytitle:hover{
                        cursor: pointer;
                    }
                    .orange{color: orange;}
                    .green{color: #009688;}
                    .red{color: red;}
                    .kong{text-align: center;height: 90px;}
                </style>
                <div class="layui-card-body " >
                    <div style="overflow-x:scroll;">
                        <table class="layui-table layui-form">
                            <thead>
                            <tr>
                                <th   class="ck" ><input type="checkbox" name="" lay-skin="primary" lay-filter="allChoose" value="0"></th>
                                <th>ID</th>
                                <th>分类</th>
                                <th>标题</th>
                                <th>热度</th>
                                <th>作者</th>
                                <th>时间</th>
                                <th>欢迎页</th>
                                <th>置顶</th>
                                <th>精华</th>
                                <th>推荐</th>
                                <th>管理操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if ($count==0){
                                echo '<tr><td class="kong" colspan="11"><span class="red">数据为空🙂</span></td></tr>';
                            }else{
                                foreach ($lists as $key=>$v){
                                    ?>
                                    <tr>
                                        <td   class="ck"> <input type="checkbox" name="ids[]" title="" lay-skin="primary" value='<?php echo $v['id']; ?>' /></td>
                                        <td><?php echo $v['id'];?></td>
                                        <td><?php echo $v['column_title']; ?></td>
                                        <td><a class="mytitle orange" target="_blank" href="<?php echo 'http://'.$_SERVER["HTTP_HOST"].'/thread/'.$v['id']; ?>">
                                                <?php echo $v['title']; ?></a> </td>
                                        <td><?php echo $v['hits']; ?></td>
                                        <td><?php echo $v['nickname']; ?></td>
                                        <td><?php echo $v['create_time']; ?></td>
                                        <td><?php echo $v['isbanner']; ?></td>
                                        <td><?php echo $v['top']; ?></td>
                                        <td><?php echo $v['status']; ?></td>
                                        <td><?php echo $v['recommend']; ?></td>
                                        <td>
                                            <a class="layui-btn btnn layui-btn-xs  openbox layui-bg-success btnn" href="<?php echo url('/thread/edit_art/id/' . $v['id']) ?>" title="编辑"> 编辑</a>
                                            <a class="layui-btn btnn layui-btn-xs ajax-get confirm layui-btn-danger btnn" href="<?php echo url('/thread/delete/id/' . $v['id']) ?>" title="删除"  onclick="del(this)"  > 删除</a>
                                        </td>
                                    </tr>
                                    <?php
                                }}
                            ?>
                            </tbody>
                            <thead>
                            <tr>
                                <th   class="ck" ><input type="checkbox" name="" lay-skin="primary" lay-filter="allChoose" value="0"></th>
                                <th>ID</th>
                                <th>分类</th>
                                <th>标题</th>
                                <th>热度</th>
                                <th>作者</th>
                                <th>时间</th>
                                <th>欢迎页</th>
                                <th>置顶</th>
                                <th>精华</th>
                                <th>推荐</th>
                                <th>管理操作</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="page layui-col-md12" style="text-align:right;margin-top: 10px;">
                        {$pager}
                    </div>

                    <script>
                        function op(obj) {
                            var id=obj.parentNode.parentNode.parentNode.children(0).val();
                            alert(id);
                        }
                    </script>

                    <div class="" style="">
                        <div class="layui-col-md12">
                            <button style="float:left;margin: 5px 5px;" class="layui-btn layui-btn-danger layui-btn-sm" lay-submit lay-filter="button_submit" href="<?php echo url('admin/thread/deletes'); ?>" ><i class="layui-icon"></i>批量删除</button>

                            <div class="layui-input-inline layui-col-md2 layui-col-sm3" style="margin: 5px 5px;">
                                <select lay-filter="set_field" href="<?php echo url('set_field', ['field' => 'recommend']); ?>">
                                    <option value="">是否推荐</option>
                                    <?php
                                    echo html_select([
                                        0 => '不推荐',
                                        1 => '推荐',
                                    ]);
                                    ?>
                                </select>
                            </div>
                            <div class="layui-input-inline layui-col-md2 layui-col-sm3" style="margin: 5px 5px;">
                                <select lay-filter="set_field" href="<?php echo url('set_field', ['field' => 'top']); ?>">
                                    <option value="">是否置顶</option>
                                    <?php
                                    echo html_select([
                                        0 => '不置顶',
                                        1 => '置顶',
                                    ]);
                                    ?>
                                </select>
                            </div>
                        </div>

                            <div class="" style="margin-bottom: 40px">
                            <div class="layui-input-inline layui-col-md2 layui-col-sm3"  style="margin: 5px 5px;">
                                <select lay-filter="set_field" href="<?php echo url('set_field', ['field' => 'status']); ?>">
                                    <option value="">是否精华</option>
                                    <?php
                                    echo html_select([
                                        1 => '精华',
                                        0 => '不精华',
                                    ]);
                                    ?>
                                </select>
                            </div>
                            <div class="layui-input-inline layui-col-md2 layui-col-sm3"  style="margin: 5px 5px;">
                                <select lay-filter="set_field" href="<?php echo url('set_field', ['field' => 'isbanner']); ?>">
                                    <option value="">是否欢迎页</option>
                                    <?php
                                    echo html_select([
                                        1 => '显示',
                                        0 => '不显示',
                                    ]);
                                    ?>
                                </select>
                            </div>
                            <div class="layui-input-inline layui-col-md2 layui-col-sm3" style="margin: 5px 5px;">
                                <select lay-filter="set_field" href="<?php echo url('set_field', ['field' => 'cid']); ?>">
                                    <option value="">转移分类</option>
                                    <?php echo html_select(model('thread_column')->dict()); ?>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
<div style="padding-bottom: 20px"></div>
{/block}

{block name="foot_js"}


{/block}