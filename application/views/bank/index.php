<style>
    .table td:first-child{width:10%}
    .table td:nth-child(2){width:20%}
</style>
<div class="row search">
    <form class="form-inline" role="form">
        <div class="form-group">
            <label class="sr-only" for="exampleInputEmail2">配置项目</label>
            <input type="email" class="form-control" id="exampleInputEmail2" placeholder="配置项目">
        </div>
        <div class="form-group">
            <div class="input-group">
                <input class="form-control" type="email" placeholder="Enter email">
            </div>
        </div>
        <div class="form-group">
            <label class="sr-only" for="exampleInputPassword2">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-default">搜索</button>
    </form>
</div>
<table class="table  table-bordered well">
    <thead>
    <tr>
        <th>ID</th>
        <th>配置项目</th>
        <th>资金</th>
        <th>形态</th>
<!--        <th>占比</th>-->
        <th>(预估)收益率</th>
        <th>状态</th>
        <th>起息日期</th>
        <th>到期日期</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
        <?php foreach($data as $vo){?>
            <tr>
                <td><?php echo $vo['id'];?></td>
                <td><?php echo $vo['asset_name'];?></td>
                <td><?php echo $vo['number'];?></td>
                <td><?php echo $vo['money_form'];?></td>
<!--                <td>--><?php //echo $vo['accounted_for']*100;?><!--%</td>-->
                <td><?php echo $vo['earnings']*100;?>%</td>
                <td><button type="button" class="btn <?php echo $vo['status']==1?'btn-success':'btn-danger';?> btn-xs"><?php echo $vo['status']==1?'进行中':'已结束';?></button></td>
                <td><?php echo $vo['start_date'];?></td>
                <td><?php echo $vo['end_date'];?></td>
                <td>
                    <div class="btn-group  btn-group-xs">
                        <?php if($vo['status'] ==1){?>
                            <a class="btn btn-default btn-xs" href="<?php echo base_url('bank/bank/edit?id='.$vo['id']);?>">编辑</a>
                            <a class="btn btn-success btn-xs" href="javascript:void(0);" onclick="confirm_earnings(<?php echo $vo['id'];?>)">确认收益</a>
                        <?php }else{ ?>
                            <a class="btn btn-default btn-xs" href="<?php echo base_url('bank/bank/detail?id='.$vo['id']);?>">查看</a>
                        <?php }?>
                        <a class="btn btn-danger" href="javascript:void(0);" onclick="del(<?php echo $vo['id'];?>)">删除</a>
                     </div>
                </td>
            </tr>
        <?php } ?>
<!--    --><?php
//    foreach($data as $vo){
//        printf('<tr>
//					<td>%s</td>
//					<td>%s</td>
//					<td>%s</td>
//					<td>%s</td>
//					<td>%s</td>
//					<td>%s</td>
//					<td>%s</td>
//					<td>%s</td>
//					<td>%s</td>
//					<td>
//						<div class="btn-group  btn-group-xs">
//						  <a class="btn btn-default btn-xs" href="%s">编辑</a>
//						  <a class="btn btn-danger" href="%s">删除</a>
//						</div>
//					</td>
//				</tr>',$vo->id,$vo->asset_name,$vo->create_date,$vo->number,$vo->accounted_for,$vo->earnings,($vo->status==1?"进行中":($vo->status==2?"中止":"过期")),$vo->start_date,$vo->end_date,site_url("manage/member/edit/".$vo->id),site_url("manage/member/delete/".$vo->id));
//    }
//    ?>
    </tbody>
</table>
<hr/>

<?php echo '<a class="btn btn-success pull-right" href="'.site_url("bank/bank/add").'">新增项目</a>'; ?>
<?php //echo $this->pagination->create_links(); ?>
<script src="<?php echo base_url();?>static/layer/layer.js"></script>
<script type="text/javascript">
    function del(id){
        if(confirm("确定删除吗？")){
            $.post("<?php echo base_url('bank/bank/del')?>",{id:id},function(e){
                var data = eval("("+e+")");
                alert(data.msg);
                if(data.result ==1){
                    window.location.reload();
                }
            });
        }else{
            return false;
        }
    }
    //确认收益
    function confirm_earnings(id){
        $.get("<?php echo base_url('bank/bank/confirm_earnings');?>",{id:id},function(e){
            layer.open({
                type: 1,
                title: '确认收益',
                skin: 'layui-layer-rim', //加上边框
                shadeClose: true,//点击遮罩关闭
                area: ['520px', '520px'], //宽高
                content: e
            });
        });

    }
</script>
