{extend name="base:base" /}
{block name="body"}
<div class="layui-container fly-marginTop fly-user-main">
    {include file="member/nav" /}
    <div class="fly-panel fly-panel-user" pad20>
        <div class="layui-tab layui-tab-brief" lay-filter="user">
            <ul class="layui-tab-title">
                <li class="layui-this"><a href="#">{$mytitle}</a></li>
            </ul>
            <div class="layui-form layui-tab-content" id="LAY_ucm" style="padding: 5px 0;">
                <div class="layui-tab-item layui-show">
<!--                    <form action="{:url('member/search_user')}" class="layui-form">-->
<!--                        <div class="layui-form-item" style="margin: 10px 0 0;"> -->
<!--                            <div class="layui-input-inline"> <input type="text" name="alias" class="layui-input" value=""> </div> <button type="submit" class="layui-btn">搜索</button>-->
<!--                        </div>-->
<!--                    </form>-->
                    <table id="LAY_productList"></table>
                    <div class="layui-form layui-border-box layui-table-view" lay-filter="LAY-table-2" lay-id="LAY_productList" style=" ">
                        <div class="layui-table-box">
                            <div class="layui-table-body layui-table-main">
                                <?php if ($count) { ?>
                                    <style>
                                        .layui-table-view .layui-table td, .layui-table-view .layui-table th {
                                            padding: 9px 15px;
                                        }
                                        .layui-table-view .layui-table {
                                            width:100%
                                        }
                                    </style>
                                    <table class="layui-table">
                                        <colgroup>
                                            <col width="100">
                                            <col width="100">
                                            <col width="100">
                                            <col width="100">
                                            <col width="100">
                                            <col width="150">
                                        </colgroup>
                                        <thead>
                                            <tr>
                                                <th>昵称</th>
                                                <th>头像</th>
                                                <th>粉丝</th>
                                                <th>关注</th>
                                                <th>积分</th>
                                                <th>操作</th>
                                            </tr> 
                                        </thead>
                                        <tbody>
                                            {volist name="lists" id="value"}
                                            <tr>
                                                <td>
                                                    <a href="<?php echo url('/u/' . $value['id']) ?>" title="用户：{$value.nickname}" target="_blank" >{$value.nickname}</a>
                                                    <?php
                                                    if ($value['follow_type'] == 3) {
//                                                        echo '<br>(TA也关注了你)';
                                                    }
                                                    ?>
                                                </td>
                                                <td><img src="<?php
                                                    if ($value['avatar']) {
                                                        echo res_http($value['avatar']);
                                                    } else {
                                                        echo res_http('avatar.jpg');
                                                    }
                                                    ?>" /></td>
                                                <td>{$value.hitsfans}</td>
                                                <td>{$value.hitsfollows}</td>
                                                <td>{$value.points}</td>
                                                <td>
                                                    <div class="fly-sns" data-id="{$value['id']}" data-name="{$value['nickname']}">
                                                        <?php
                                                        if ($value['id'] != session('member.id')) {
                                                            switch ($value['follow_type']) {
                                                                case 1:
                                                                    $follow_title = '已关注';
                                                                    break;
                                                                case 2:
                                                                    $follow_title = '关注TA';
                                                                    break;
                                                                case 3:
                                                                    $follow_title = '互相关注';
                                                                    break;
                                                                default:
                                                                    $follow_title = '关注TA';
                                                                    break;
                                                            }
                                                            ?>
                                                            <a href="javascript:;" class="layui-btn layui-btn-primary  layui-btn-sm fly_follow" data-type="follow">{$follow_title}</a>
<!--                                                            <a href="--><?php //echo url('/u/' . $value['id']) ?><!--" target="_blank" class="layui-btn layui-btn-normal layui-btn-sm">TA的主页</a>-->
                                                        <?php } ?>
                                                    </div>
<!--                                                    <button type="button" class="layui-btn layui-btn-primary layui-btn-sm">取消关注</button>-->
<!--                                                    <a href="javascript:;" class="layui-btn layui-btn-primary layui-btn-sm fly_follow" data-type="follow">取消关注</a>-->
<!--                                                    <a href="--><?php //echo url('/u/' . $value['id']) ?><!--" target="_blank" class="layui-btn layui-btn-normal layui-btn-sm">TA的主页</a>-->
                                                </td>
                                            </tr>
                                            {/volist}
                                        </tbody>
                                    </table>
                                <?php } else { ?>
                                    <div class="layui-none">{$myt}</div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="layui-table-page layui-hide">
                            <div id="layui-table-page2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{/block}
