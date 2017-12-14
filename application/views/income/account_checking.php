<div class="row">
    <h2>收支录入</h2>
    <?php
    if(function_exists('validation_errors') && validation_errors() != '') {
        $error  = validation_errors();
    }
    ?>
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $error; ?>
        </div>
    <?php endif; ?>
<!--    --><?php //echo form_open(current_url(),array('method'=>'post','class'=>'form_inline','role'=>'form')); ?>
    <form action="<?php echo base_url('/index.php/income/income/account_checking')?>" method="post" onsubmit="return check()" class="form_inline" role="form">
        <div class="form-group main-header">
            <div class="input-group">
                <div class="input-group-addon">金额(元)</div>
                <input name="num" type="text" class="form-control" size="16" value="" placeholder="请输入金额" />
            </div>
        </div>
        <div class="form-group main-header" style="width:250px;">
            <div class="input-group">
                <div class="input-group-addon">备注</div>
                <input name="desc" type="text" class="form-control" value="" placeholder="请输入备注" />
            </div>
        </div>
        <div class="form-group main-header" style="width:250px;">
            <div class="input-group">
                <div class="input-group-addon">时间</div>
                <div class="input-group date form_datetime col-md-10" data-link-field="create">
                    <input class="form-control" size="16" type="text" value="" />
                    <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                </div>
                <input name="create" id="create" type="hidden" value="">
            </div>
        </div>
        <div class="form-group main-header">
            <div class="input-group">
                <input type="radio" name="type" value="1" />收入
                <input type="radio" name="type" checked value="0" />支出
                &nbsp;&nbsp;&nbsp;
                <button type="submit" class="btn btn-success">确认提交</button>
            </div>
        </div>
    </form>
</div>
<div class="row">
    <h2>月流水</h2>
    <form id="form_for_search" class="form_inline" action="<?php echo base_url(uri_string()) ."?". http_build_query($_GET);?>" method="GET">
        <select class="form-control" id="type" name="type1" style="width:100px;float: right;">
            <option value="">全部</option>
            <option value="1">收入</option>
            <option value="0">支出</option>
        </select>
    </form>
    <div class="col-xs-12">
        <table class="table table-hover">
            <thead>
            <tr>
                <td>时间</td>
                <td>金额(元)</td>
                <td>备注</td>
                <td>操作</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach($data as $vo){?>
            <tr <?php if($vo->type !=1){?>class="danger"<?php }?>>
                <td><?php echo date('Y-m-d',strtotime($vo->created));?></td>
                <td><?php if($vo->type !=1){?><button type='button' class='btn btn-danger btn-xs'>支出</button><?php }?><?php echo $vo->num;?></td>
                <td><?php echo $vo->desc;?></td>
                <td>
                    <a class="btn btn-danger" href="javascript:void(0);" onclick="del(<?php echo $vo->id;?>)">删除</a>
                </td>
            </tr>
            <?php }?>
            </tbody>
        </table>
    </div>
</div>
<div class="row" align="center">
    <?php echo $page_links; ?>
</div>
<script src="<?php echo base_url();?>static/layer/layer.js"></script>
<script type="text/javascript">
    $(function () {
        $('.form_datetime').datetimepicker({
            minView: "month",//选择日期后，不会再跳转去选择时分秒
            language:  'zh-CN',
            autoclose: true,
            todayHighlight: true,
            todayBtn:  1,//今天 的按钮
            format:'yyyy-mm-dd'
        });

        $("#type").on('change',function(e){
            $("#form_for_search").submit();
        })
    })
    function check(){
        var type = $('input[name="type"]:checked').val();
        var money= $('input[name="num"]').val();
        var msg  = type ==1?'收入':'支出';
        if(confirm(msg+money+'元')){
            return true;
        }else{
            return false;
        }
    }
    function del(id){
        if(confirm("确定删除吗？")){
            $.post("<?php echo base_url('index.php/income/income/del')?>",{id:id},function(e){
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