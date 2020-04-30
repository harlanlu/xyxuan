{extend name="base:base" /}
{block name="body"}
<!-- 编辑器源码文件 -->
{load href="__PUBLIC__/plus/ueditor/ueditor.config.js" /}
<!-- 实例化编辑器 -->
{load href="__PUBLIC__/plus/ueditor/ueditor.all.js" /}
<div class="layui-container fly-marginTop fly-user-main">
    {include file="member/nav" /}
    <div class="fly-panel fly-panel-user" pad20>
        <div class="layui-tab layui-tab-brief" lay-filter="type">
            <h3 style="padding: 10px 0;">当前认证身份为：<?php if ($myinfo['ident']==0) echo '用户未获得认证';else echo '<i class="iconfont icon-renzheng""></i>'.$member['identification'];?> </h3>
            <ul class="layui-tab-title" id="LAY_mine">
                <li data-type="mine-jie" lay-id="histroys" class="layui-this">申请历史（<span>{$count}</span>）</li>
                <li data-type="collection" data-url="/collection/find/" lay-id="start_apply">开始申请</li>
            </ul>
            <div class="layui-tab-content" style="padding: 20px 0;">
                <div class="layui-tab-item layui-show">
                    <ul class="mine-view jie-row">
                        <?php
                        foreach ($lists as $key => $value) {
                            ?>
                            <li>
                                <a class="jie-title" href="<?php echo url('member/apply_show' , ['id' => $value['id']]) ?>" target="_blank"><?php echo $value['utitle'] ?></a>
                                <i><?php echo date('Y-m-d H:i:s',$value['write_time']); ?></i>
                                <a class="mine-edit" href="<?php echo url('index/member/apply_edit', ['id' => $value['id']]) ?>"  target="_blank">编辑</a>
                                <a class="mine-edit" onclick="return confirm('你确定要删除该作品?')" style="background-color: #FF5722;" href="<?php echo url('index/member/apply_del', ['id' => $value['id']]) ?>" >删除
                                </a>
                                <em><?php if ($value['status']==0){echo '<span style="background: orange;">待处理</span>';}
                                    if ($value['status']==1){echo '<span style="background: #2aed20">已同意</span>';}
                                    if ($value['status']==-1){echo '<span style="background: red">已拒绝: '.$value['msg'].'</span>';}; ?></em>
                            </li>
                        <?php } ?>
                    </ul>
                    <div id="LAY_page"></div>
                </div>
                <div class="layui-tab-item">
                    <form action="{:url('member/apply_add')}" method="post" class="layui-form">
                        <div class="layui-row layui-col-space15 layui-form-item">
                            <div class="layui-col-md12 layui-form-item">
                                <label for="L_title" class="layui-form-label">认证名称：</label>
                                <div class="layui-input-block">
                                    <input type="hidden" name="user_id" value="{$member['id']}">
                                    <input type="text" id="L_title" name="utitle" required lay-verify="required" autocomplete="off" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-col-md12 layui-form-item">
                                <label for="L_title" class="layui-form-label">具体内容：</label>
                                <div class="layui-input-block">
                                    <script id="content" name="content" type="text/plain"></script>
                                </div>
                            </div>

                            <div class="layui-form-item" style="text-align:right;">
                                <div class="col-md-12" style="text-align: right;">
                                    <button type="submit" style="width: 200px;" class="layui-btn" >提交</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{/block}
{block name="foot_js"}
<script type="text/javascript">
    var ue = UE.getEditor('content',{initialFrameHeight:400});
    toolbars: [
        ['fullscreen', 'source', 'undo', 'redo'],
        // ['bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc']
    ]
</script>
<script>
    layui.use(['fly', 'face','form', 'layer','member'], function () {
        var $ = layui.$,
                layer = layui.layer,
                element = layui.element
            , member = layui.member, form = layui.form
            , fly = layui.fly;
        //获取hash来切换选项卡，假设当前地址的hash为lay-id对应的值
        var layid = location.hash.replace(/^#type=/, '');
        element.tabChange('type', layid); //假设当前地址为：http://a.com#test1=222，那么选项卡会自动切换到“发送消息”这一项
        //监听Tab切换，以改变地址hash值
        element.on('tab(type)', function () {
            location.hash = 'type=' + this.getAttribute('lay-id');
        });

    });
</script>
{/block}