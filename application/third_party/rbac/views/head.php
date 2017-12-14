<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
   		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="icon" href="<?php echo base_url();?>asset.ico" title="账本">
		<link rel="stylesheet" href="<?php echo base_url();?>static/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo base_url();?>static/bootstrap/css/bootstrap-datetimepicker.min.css">
		<link href="<?php echo base_url();?>static/offcanvas.css" rel="stylesheet">
		<link href="<?php echo base_url();?>static/css/admin.index.css" rel="stylesheet">
        <title><?php echo isset($header_title)?$header_title:isset($this->get_menu['list'][$this->uuri])?$this->get_menu['list'][$this->uuri]:""; ?></title>
        <script src="<?php echo base_url();?>static/jquery.1102.min.js"></script>
        <script src="<?php echo base_url();?>static/bootbox.min.js"></script>
		<script src="<?php echo base_url();?>static/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url();?>static/bootstrap/js/bootstrap-datetimepicker.min.js"></script>
		<script src="<?php echo base_url();?>static/bootstrap/js/locales/bootstrap-datetimepicker.zh-CN.js"></script>
        <script src="<?php echo base_url();?>static/bootstrap/js/respond.min.js"></script>
    </head>
    <body>
    <div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="#"><?php echo isset($header_title)?$header_title:isset($this->get_menu['list'][$this->uuri])?$this->get_menu['list'][$this->uuri]:""; ?></a>
        </div>
        <ul class="nav navbar-nav navbar-right">
          <li id="fat-menu" class="dropdown">
              <a href="#" id="user_action" role="button" class="dropdown-toggle" data-toggle="dropdown">欢迎您:<?php echo rbac_conf(array('INFO','nickname'));?><b class="caret"></b></a>
              <ul class="dropdown-menu" role="menu" aria-labelledby="user_action">
                <li><a href="javascript:void(0)" onclick="setPass()"><span class="glyphicon glyphicon-pencil"></span> 修改密码</a></li>
                <li> <?php echo anchor("index/logout","<span class='glyphicon glyphicon-log-out'></span> 退出"); ?></li>
              </ul>
          </li>
        </ul>
      </div><!-- /.container -->
    </div><!-- /.navbar -->
	<script type="text/javascript">
		function setPass(){
			bootbox.prompt({
				title: "请输入新密码",
				inputType: 'password',
				callback: function (result) {
					if(result.length <6){
						bootbox.alert("密码不能小于6位");
						return false;
					}
					$.ajax({
                        type: "POST",
                        url: '<?php echo base_url('index.php/index/updatePass')?>',
                        data: {password:result},
                        dataType: "json",
                        success: function(e){
							if(e.rs =='ok'){
								bootbox.alert(e.msg);
							}
                        },
                        error:function (e) {
                            bootbox.alert('系统出错，请重试！');
							return false;
                        }
                    })
				}
			});
		}
	</script>


