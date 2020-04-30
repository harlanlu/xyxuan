<thead>
    <tr>
        <th   class="ck" ><input type="checkbox" name="" lay-skin="primary" lay-filter="allChoose" value="0"></th>
        <?php foreach ($table_datas as $key0 => $field) {
            ?>
            <?php if ($key0 == 'listorder') { ?>
                <th><button class="layui-btn layui-btn-primary   layui-btn-sm" lay-filter="button_submit" lay-submit="" href="<?php echo url('listorders', ['table' => $field['table']]); ?>">排序按钮</button></th>
            <?php } else { ?>
                <th><?php echo $field['title'] ?></th>
            <?php } ?>
        <?php } ?>
        <th>管理操作</th>
    </tr>
</thead>
<tbody>
    <?php
    if (count($lists)) {
        foreach ($lists as $key => $value) {
            ?>
            <tr>
                <td   class="ck" >
                    <input type="checkbox" name="ids[]" title="" lay-skin="primary" value='<?php echo $value['id']; ?>' />
                </td>
                <?php foreach ($table_datas as $key0 => $field) {
                    ?>
                    <?php if ($field['type'] == 'input') { ?>
                        <td> <input name="<?php echo $key0 . '[' . $value['id'] . ']' ?>" type="text" size="3" value="<?php echo $value[$key0]; ?>" class="listorders"> </td>

                    <?php } elseif ($field['type'] == 'datetime') { ?>
                        <td> <?php echo date('Y/m/d H:i:s', $value[$key0]); ?> </td>

                    <?php } elseif ($field['type'] == 'publish_type') { ?>
                        <td> <?php if ($value[$key0]=='0') echo '所有人';else echo '管理员'; ?> </td>
<!--                    //栏目名称-->
                    <?php } elseif ($field['type'] == 'c_pid') { ?>
                        <td> <?php if ($value[$key0]=='0') echo '<span style="color:red;font-weight: bold;">顶级目录</span>';else echo '<span style="font-weight: bold;color:blue;">--'.getCateName($value[$key0]).'</span>(子类)'; ?> </td>

                    <?php } elseif ($field['type'] == 'join_type') { ?>
                        <td> <?php  if ($value[$key0]=='0') echo '所有人';
                        elseif ($value[$key0]=='1') echo 'VIP';
                        else echo '积分';
                        ?> </td>


                    <?php } elseif ($field['type'] == 'date') { ?>
                        <td> <?php echo date('Y/m/d', $value[$key0]); ?> </td>
                    <?php } elseif ($field['type'] == 'time') { ?>
                        <td> <?php echo date('H:i:s', $value[$key0]); ?> </td>
                    <?php }elseif ($field['type'] == 'sex') { ?>
                        <td> <?php if ($value[$key0]==0) echo '男';else{echo '女';}?> </td>
                    <?php } elseif ($field['type'] == 'image') {
                        ?>
                        <td> 
                            <?php if ($value[$key0]) { ?>
                                <img src="<?php echo img_resize($value[$key0], 80, 0); ?>" style="max-width: 80px; max-height: 80px;" class="img-thumbnail" /> 
                            <?php } ?>
                        </td>
                    <?php } elseif (strpos($key0, ':') !== false) {
                        ?>
                        <td> <?php
                            $key0_arr = explode(':', $key0);
                            foreach ($key0_arr as $value1) {
                                echo $value[$value1] . ' ';
                            }
                            ?> </td>

                    <?php } else { ?>
                        <td> <?php print_r($value[$key0]); ?> </td>
                    <?php } ?>
                <?php } ?>
                <td> 
                    <?php
                    // print_r($table_actions);exit;
                    $tpl = ' <a class="layui-btn btnn layui-btn-xs %class%" href="%href%" title="%title%" %attr% >%icon% %title%</a> ';
                    foreach ($table_actions as $actions) {
                        echo str_replace(array('%title%', '%class%', '%href%', '%icon%', '%attr%'), array($actions['title'], $actions['class'], url($actions['href'], ['id' => $value['id']]), $actions['icon'], $actions['attr']), $tpl);
                    }
                    ?>
                </td>
            </tr>
            <?php
        }
    } else {
        echo '<tr><td colspan="' . (count($table_datas) + 2) . '"><div class="empty"><i class="layui-icon layui-icon-face-cry"></i> 当前查询结果为空</div></td></tr>';
    }
    ?>
</tbody>
<thead>
    <tr>
        <th  class="ck" ><input type="checkbox" name="" lay-skin="primary"lay-filter="allChoose" value="0"></th>
        <?php foreach ($table_datas as $key0 => $field) {
            ?>
            <?php if ($key0 == 'listorder') { ?>
                <th><button class="layui-btn layui-btn-primary layui-btn-sm" lay-filter="button_submit" lay-submit="" href="<?php echo url('listorders', ['table' => $field['table']]); ?>">排序按钮</button></th>
                <?php } else { ?>
                <th><?php echo $field['title'] ?></th>
            <?php } ?>
        <?php } ?>
        <th>管理操作</th>
    </tr>
</thead>
