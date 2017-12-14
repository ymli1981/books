<style>
    .table td:first-child{width:10%}
    .table td:nth-child(2){width:20%}
</style>
<div class="row search">

</div>
<?php echo '<a class="btn btn-success pull-right" href="'.site_url("dashboard/setting/add").'">新增形态</a>'; ?>
<hr/>
<table class="table  table-bordered well">
    <thead>
    <tr>
        <th>ID</th>
        <th>形态名称</th>
        <th>状态</th>
        <th>说明</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($data as $vo){?>
        <tr>
            <td><?php echo $vo['id'];?></td>
            <td><?php echo $vo['name'];?></td>
            <td><button type="button" class="btn <?php echo $vo['status']==1?'btn-success':'btn-danger';?> btn-xs"><?php echo $vo['status']==1?'启用':'禁用';?></button></td>
            <td><?php echo $vo['info'];?></td>
            <td>
                <div class="btn-group  btn-group-xs">
                    <a class="btn btn-default btn-xs" href="<?php echo base_url('index.php/dashboard/setting/edit?id='.$vo['id']);?>">编辑</a>
                    <?php if($vo['status'] ==0){?>
                    <a class="btn btn-success btn-xs" href="javascript:void(0);" onclick="change_status(<?php echo $vo['id'];?>)">启用</a>
                    <?php }else{ ?>
                        <a class="btn btn-danger btn-xs" href="javascript:void(0);" onclick="change_status(<?php echo $vo['id'];?>)">禁用</a>
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

<?php //echo $this->pagination->create_links(); ?>
<script type="text/javascript">
    function change_status(id){
        $.post("<?php echo base_url('dashboard/setting/status')?>",{id:id},function(e){
            var data = eval("("+e+")");
            alert(data.msg);
            if(data.result ==1){
                window.location.reload();
            }
        });
    }
    function del(id){
        if(confirm("确定删除吗？")){
            $.post("<?php echo base_url('dashboard/setting/del')?>",{id:id},function(e){
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
</script>
