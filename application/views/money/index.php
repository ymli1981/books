<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>总资金</th>
                <th>账户</th>
                <th>资金</th>
                <th>收益率</th>
            </tr>
            </thead>
            <tbody>
            <?php $i=1;foreach($data as $vo){ ?>
            <tr>
                <?php if($i ==1){?>
                <td rowspan="<?php echo count($data);?>" align="center"><?php echo $count['count'];?></td>
                <?php }?>
                <td><?php echo $vo['asset_name'];?></td>
                <td><?php echo $vo['number'];?></td>
                <td><?php echo $vo['earnings']*100;?>%</td>
            </tr>
            <?php $i++; } ?>
            </tbody>
        </table>
    </div>
</div>
<div class="row" style="margin: 0 0 20px 2px;">
    <h3>总金额：<?php echo $count['count'];?>元</h3>
    <?php foreach($money_form_count as $value){?>
    <div class="col-lg-6">
        <h4><?php echo $value['money_form_name'];?></h4>
        <p><?php echo $value['money_form_count'];?>元</p>
    </div>
    <?php }?>
</div>
<div class="row">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">总金额</h3 >
        </div>
        <div class="panel-body">
            <div id="main" style="width: 600px;height:400px;"></div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url();?>static/js/echarts.js"></script>
<!--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/echarts/3.3.0/echarts.min.js"></script>-->
<script type="text/javascript">
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
</script>