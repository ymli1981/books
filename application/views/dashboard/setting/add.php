<h1>新增形态</h1>
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
    <label>形态名称</label>
    <input name="name" type="text" class="form-control"  placeholder="输入形态名称" value="">
</div>
<div class="form-group">
    <label>说明</label>
    <input name="info" type="text" class="form-control" placeholder="备注信息" value="">
</div>
  <div class="checkbox">
    <label>
      <input value="1" name="status" type="checkbox" checked > 是否启用
    </label>
  </div>
<button type="submit" class="btn btn-success">确认新增</button>
<a class="btn btn-danger" href="javascript:history.go(-1);">取消修改</a>
</form>