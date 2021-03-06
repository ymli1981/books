<div class="row">
    <form action="" method="post" class="form_inline" role="form">
        <div class="form-group main-header">
            <div class="input-group">
                <div class="input-group-addon">预算(元)</div>
                <input name="budget" type="text" class="form-control" style="width:100px;" value="1000" />
            </div>
        </div>
        <div class="form-group main-header">
            <div class="input-group">
                <div class="input-group-addon">已花费(元)</div>
                <input name="spent" type="text" class="form-control" readonly style="width:100px;" value="500" />
            </div>
        </div>
        <div class="form-group main-header">
            <div class="input-group">
                <div class="input-group-addon">剩余(元)</div>
                <input name="spent" type="text" class="form-control" readonly style="width:100px;" value="500" />
            </div>
        </div>
        <div class="form-group main-header">
            <div class="input-group">
                <button type="button" class="btn btn-success">确认提交</button>
            </div>
        </div>
    </form>
</div>
<div class="row">
    <div class="dashboard-panel panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">本月收支状况</h3 >
        </div>
        <div class="panel-body">
            <p>本月总收支：10000元-收入占50%，支出占50%</p>
        </div>
        <div class="panel-body">大饼图</div>
        <div class="panel-body">
            <p>收入记录：30条。收入总额：10000元</p>
            <p>支出记录：30条。支出总额：10000元</p>
            <p>余额;10000元</p>
        </div>
    </div>
    <div class="dashboard-panel panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">上月收支状况</h3 >
        </div>
        <div class="panel-body">
            <p>上月总收支：10000元-收入占50%，支出占50%</p>
        </div>
        <div class="panel-body">大饼图</div>
        <div class="panel-body">
            <p>收入记录：30条。收入总额：10000元</p>
            <p>支出记录：30条。支出总额：10000元</p>
            <p>余额;10000元</p>
        </div>
    </div>
</div>
<div class="row">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">资产分布</h3 >
        </div>
        <div class="panel-body">
            <div id="main" style="width: 600px;height:400px;"></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">收益曲线</h3 >
        </div>
        <div class="panel-body">
            <div id="earnings" style="width: 600px;height:400px;"></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-6 col-sm-6 col-lg-4">
        <h2>Heading</h2>
        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
        <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
    </div><!--/span-->
    <div class="col-6 col-sm-6 col-lg-4">
        <h2>Heading</h2>
        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
        <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
    </div><!--/span-->
    <div class="col-6 col-sm-6 col-lg-4">
        <h2>Heading</h2>
        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
        <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
    </div><!--/span-->
</div><!--/row-->
<script type="text/javascript" src="<?php echo base_url();?>static/js/echarts.js"></script>
<!--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/echarts/3.3.0/echarts.min.js"></script>-->
<script type="text/javascript">
    //资产分布
    var myChart = echarts.init(document.getElementById('main'));
    var option = {
        title : {
            text: '资产分布',
            subtext: '以录入系统数据为准',
            x:'center'
        },
        tooltip : {
            trigger: 'item',
            formatter: "{a} <br/>{b} : {c} ({d}%)"
        },
        legend: {
            orient: 'vertical',
            left: 'left',
            data: [<?php echo $asset_name_str;?>]
        },
        toolbox: {
            feature: {
                saveAsImage: {}
            }
        },
        series : [
            {
                name: '资金分布',
                type: 'pie',
                radius : '55%',
                center: ['50%', '60%'],
                data:<?php echo $asset_data_str?>,
                itemStyle: {
                    emphasis: {
                        shadowBlur: 10,
                        shadowOffsetX: 0,
                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                    }
                }
            }
        ]
    };

    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);


    //收益曲线
    var myChart1 = echarts.init(document.getElementById('earnings'));
    var option1 = {
        title: {
            text: '收益曲线'
        },
        tooltip : {
            trigger: 'axis'
        },
        legend: {
            data:['邮件营销','联盟广告','视频广告','直接访问','搜索引擎']
        },
        toolbox: {
            feature: {
                saveAsImage: {}
            }
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        xAxis : [
            {
                type : 'category',
                boundaryGap : false,
                data : ['周一','周二','周三','周四','周五','周六','周日']
            }
        ],
        yAxis : [
            {
                type : 'value'
            }
        ],
        series : [
            {
                name:'邮件营销',
                type:'line',
                stack: '总量',
                areaStyle: {normal: {}},
                data:[120, 132, 101, 134, 90, 230, 210]
            },
            {
                name:'联盟广告',
                type:'line',
                stack: '总量',
                areaStyle: {normal: {}},
                data:[220, 182, 191, 234, 290, 330, 310]
            },
            {
                name:'视频广告',
                type:'line',
                stack: '总量',
                areaStyle: {normal: {}},
                data:[150, 232, 201, 154, 190, 330, 410]
            },
            {
                name:'直接访问',
                type:'line',
                stack: '总量',
                areaStyle: {normal: {}},
                data:[320, 332, 301, 334, 390, 330, 320]
            },
            {
                name:'搜索引擎',
                type:'line',
                stack: '总量',
                label: {
                    normal: {
                        show: true,
                        position: 'top'
                    }
                },
                areaStyle: {normal: {}},
                data:[820, 932, 901, 934, 1290, 1330, 1320]
            }
        ]
    };
    myChart1.setOption(option1);
</script>