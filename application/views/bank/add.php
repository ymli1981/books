<h1>新增配置项目</h1>
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
<?php echo form_open(current_url(),array('id'=>'formPage')); ?>
    <div class="form-group">
        <label>配置名称</label>
        <input name="asset_name" type="text" class="form-control"  placeholder="输入配置名称" value="">
    </div>
    <div class="form-group">
        <label>资金</label>
        <input name="number" type="text" class="form-control" placeholder="输入配置数目" value="">
    </div>
    <div class="form-group">
        <label>资金形态</label>
        <select class="form-control" name="money_form_id">
            <?php foreach($data as $vo){?>
                <option value="<?php echo $vo['id'];?>"><?php echo $vo['name'];?></option>
            <?php }?>
        </select>
    </div>
<!--    <div class="form-group">-->
<!--        <label>资金占比</label>-->
<!--        <input name="accounted_for" type="text" class="form-control" placeholder="输入资金占比" value="">-->
<!--    </div>-->
    <div class="form-group">
        <label>(预估)收益率</label>
        <input name="earnings" type="text" class="form-control" placeholder="输入收益率" value="">
    </div>
    <div class="form-group">
        <label>开始时间</label>
        <div class="input-group date form_datetime col-md-5" data-link-field="start_date">
            <input class="form-control" size="16" type="text" value="" readonly>
            <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
        </div>
        <input name="start_date" id="start_date" type="hidden" value="">
    </div>
    <div class="form-group">
        <label>结束时间</label>
        <div class="input-group date form_datetime col-md-5" data-link-field="end_date">
            <input class="form-control" size="16" type="text" value="" readonly>
            <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
        </div>
        <input name="end_date" id="end_date" type="hidden" value="">
    </div>
    <div class="form-group">
        <label>备注</label>
        <input name="remark" type="text" class="form-control" placeholder="备注信息" value="">
    </div>
    <!--  <div class="checkbox">-->
    <!--    <label>-->
    <!--      <input value="1" name="status" type="checkbox" checked > 是否启用-->
    <!--    </label>-->
    <!--  </div>-->
    <button type="submit" class="btn btn-success">确认新增</button>
    <a class="btn btn-danger" href="javascript:history.go(-1);">取消修改</a>
</form>
<script type="text/javascript">
    $(function () {
        $('.form_datetime').datetimepicker({
            language:  'zh-CN',
            autoclose: true,
            todayHighlight: true,
            format:'yyyy-mm-dd hh:ii:ss'
        });
    })
</script>