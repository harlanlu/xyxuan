{extend name="base:base" /}



{block name="body"}


<div class="layui-fluid">
    <div class="layui-row layui-col-space15">

        <div class="layui-col-sm12 layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-header">
                    <span style="padding-right: 50px;">网站统计</span>
                    <div class="layui-inline layui-show-xs-block" style="float:right;">
                        <button type="button" title="刷新" onclick="javascript:window.location.reload();" class="layui-btn  layui-btn-sm">
                            <i class="layui-icon">&#xe669;</i>
                        </button>
                    </div>
                </div>
                <div class="layui-card-body" style="min-height: 280px;">
                    <div id="main3" class="layui-col-sm8 layui-col-sm-offset2" style="height: 300px;"></div>

                </div>
            </div>
        </div>

    </div>
</div>
</div>

<script src="https://cdn.bootcss.com/echarts/4.2.1-rc1/echarts.min.js"></script>
<script type="text/javascript">
    // 基于准备好的dom，初始化echarts实例
    var myChart = echarts.init(document.getElementById('main3'));
    var option = {
        color: ['#3398DB'],
        tooltip: {
            trigger: 'axis',
            axisPointer: {            // 坐标轴指示器，坐标轴触发有效
                type: 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
            }
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        xAxis: [
            {
                type: 'category',
                data: ['用户总数', '作品总数', '售出作品',  '已认证用户', '待处理认证'],
                axisTick: {
                    alignWithLabel: true
                }
            }
        ],
        yAxis: [
            {
                type: 'value'
            }
        ],
        series: [
            {
                name: '统计',
                type: 'bar',
                barWidth: '30%',
                data: ['{$user}', '{$thread}', '{$art}', '{$ident}', '{$apply_identify}']
            }
        ]
    };



    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);
</script>

{/block}