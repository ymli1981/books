<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="format-detection" content="telephone=no">
        <title>记账本</title>
		<link rel="icon" href="<?= base_url();?>asset.ico" title="账本">
		<link rel="stylesheet" href="<?= base_url()?>static/frozenui/css/frozen.css">
		<link rel="stylesheet" href="<?= base_url()?>static/frozenui/css/basic.css">
		<link rel="stylesheet" href="<?= base_url()?>static/css/wap.css">
		<link rel="stylesheet" href="<?= base_url()?>static/iosselect/iosSelect.css">
		<script type="text/javascript" src="<?= base_url()?>static/jquery.1102.min.js"></script>
        <script src="<?= base_url()?>static/frozenui/lib/zepto.min.js"></script>
        <script src="<?= base_url()?>static/frozenui/js/frozen.js"></script>
		<script type="text/javascript" src="<?= base_url()?>static/iosselect/iosSelect.js"></script>
		<script type="text/javascript" src="<?= base_url()?>static/iosselect/iscroll.js"></script>
    </head>
    <body ontouchstart="">
		<!--
        <header class="ui-header ui-header-positive ui-border-b">
            <i class="ui-icon-return" onclick="history.back()"></i><h1>选项卡 tab</h1><button class="ui-btn">回首页</button>
        </header>
		-->
        <footer class="ui-footer ui-footer-btn">
            <ul class="ui-tiled ui-border-t">
                <li data-href="" class="ui-border-r"><div>余额</div></li>
                <li data-href=""><div>明细</div></li>
            </ul>
        </footer>
        <section class="ui-container">
            <section id="tab" class="main">
            	<div class="">
            		<div class="">
            			<div class="ui-tab tab-control">
            			    <ul class="ui-tab-nav ui-border-b">
            			        <li class="current">当月</li>
            			        <li>收入</li>
            			        <li>支出</li>
            			    </ul>
            			    <ul class="ui-tab-content" style="width:300%">
            			        <li>
									<div class="tab-content-index">
										<ul class="ui-row" style="margin-top:10px;">
											<li class="ui-col ui-col-50 ui-col-w"><h1><?php echo date('m'); ?>月</h1></li>
											<li class="ui-col ui-col-50 ui-col-w"></li>
										</ul>
										<?php foreach($list as $al){ ?>
										<ul class="ui-row">
											<li class="ui-col ui-col-50 ui-col-w"><?php echo $al['desc'];?><?php echo $al['type']==1?'收入':'支出';?></li>
											<li class="ui-col ui-col-50 ui-col-w"><?php echo $al['num'];?>元</li>
										</ul>
										<?php }?>
									</div>
								</li>
            			        <li>
									<ul class="ui-row" style="margin-top:10px;">
											<li class="ui-col ui-col-50 ui-col-w"><h1>收入记录</h1></li>
											<li class="ui-col ui-col-50 ui-col-w"></li>
										</ul>
										<?php foreach($type1 as $a){ ?>
										<ul class="ui-row">
											<li class="ui-col ui-col-50 ui-col-w">收入<?php echo $a['num'];?>元</li>
											<li class="ui-col ui-col-50 ui-col-w"><?php echo $a['desc'];?></li>
										</ul>
										<?php }?>
								</li>
            			        <li>
									<ul class="ui-row" style="margin-top:10px;">
											<li class="ui-col ui-col-50 ui-col-w"><h1>支出记录</h1></li>
											<li class="ui-col ui-col-50 ui-col-w"></li>
										</ul>
										<?php foreach($type0 as $b){ ?>
										<ul class="ui-row">
											<li class="ui-col ui-col-50 ui-col-w">支出<?php echo $b['num'];?>元</li>
											<li class="ui-col ui-col-50 ui-col-w"><?php echo $b['desc'];?></li>
										</ul>
										<?php }?>
								</li>
            			    </ul>
            			</div>
            		</div>
            	</div>
            </section>
			<section class="main">
				<form action="<?php echo base_url('wap/income/stream_save');?>" method="post">
                    <div class="ui-form-item ui-border-b">
                        <label>
                            金额
                        </label>
                        <input type="text" name="money" id="money" placeholder="输入金额">
                        <a href="javascript:void(0)" class="ui-icon-close"></a>
                    </div>
					<div class="ui-form-item ui-border-b">
                        <label>日期</label>
                        <input type="text" name="date" id="selectDate" readonly data-year="" data-month="" data-date="" placeholder="选择日期">
                        <a href="javascript:void(0)" class="ui-icon-close"></a>
                    </div>
                    <div class="ui-form-item ui-form-item-textarea ui-border-b">
                        <label>
                            说明
                        </label>
                        <textarea name="desc" id="desc" placeholder="收入/支出说明"></textarea>
						<a href="javascript:void(0)" class="ui-icon-close"></a>
                    </div>
					<div class="ui-form-item ui-form-item-radio ui-border-b">
                        <label class="ui-radio" for="type">
                            <input type="radio" name="type" value=1 />收入 
                        </label>
						&nbsp;&nbsp;&nbsp;
						<label class="ui-radio" for="type">
                            <input type="radio" checked name="type" value=0 />支出
                        </label>
                    </div>
					<div class="ui-btn-wrap">
						<button class="ui-btn-lg" type="button" id="formSubmit">确定</button>
					</div>
                </form>
			</section>
        </section>
        <script>
        (function (){
            var tab = new fz.Scroll('.ui-tab', {
                role: 'tab',
                autoplay: false,
                interval: 3000
            });
            /* 滑动开始前 */
            tab.on('beforeScrollStart', function(fromIndex, toIndex) {
                //console.log(fromIndex,toIndex);// from 为当前页，to 为下一页
            })
			
			/*清空输入内容*/
			$(".ui-icon-close ").bind('click',function(){
				$(this).prev().val('');
			})
			//提交
			$("#formSubmit").bind('click',function(){
				var money = $("#money").val();
				var date  = $("#selectDate").val();
				var desc  = $("#desc").val();
				var type  = $("input[ name='type' ] ").val();
				
				if(money == ''){
					tip('请输入金额！');
				}
				if(desc ==''){
					tip('请输入金额说明');
				}
				$.ajax({
					"type": "POST",
					"url": '<?= base_url('wap/income/stream_save')?>',
					"data": {
						'money': money,
						'desc' : desc,
						'date' : date,
						'type' : type,
					},
					"dataType": "Json",
					success:function(e){
						if(e.rs == 'ok'){
							tip(e.msg);
							sleep(5000);
							window.location.reload();
						}else{
							tip(e.msg);
						}
					},
					error:function(e){
						
					}
				})
			})
		function tip(content){
			var el2;
			el2=$.tips({
				content:content,
				stayTime:2000,
				type:"info"
			})
			el2.on("tips:hide",function(){
				//window.location.reload();
			})
		}
		function sleep(d){
		  for(
				var t = Date.now();
				Date.now() - t <= d;
			);
		}
        })();
		
        </script>
		
		
	<script type="text/javascript">
    var showDateDom = $('#selectDate');
    // 初始化时间
    var now = new Date();
    var nowYear = now.getFullYear();
    var nowMonth = now.getMonth() + 1;
    var nowDate = now.getDate();
    showDateDom.attr('data-year', nowYear);
    showDateDom.attr('data-month', nowMonth);
    showDateDom.attr('data-date', nowDate);
    // 数据初始化
    function formatYear (nowYear) {
        var arr = [];
        for (var i = nowYear - 5; i <= nowYear + 5; i++) {
            arr.push({
                id: i + '',
                value: i
            });
        }
        return arr;
    }
    function formatMonth () {
        var arr = [];
        for (var i = 1; i <= 12; i++) {
            arr.push({
                id: i + '',
                value: i
            });
        }
        return arr;
    }
    function formatDate (count) {
        var arr = [];
        for (var i = 1; i <= count; i++) {
            arr.push({
                id: i + '',
                value: i
            });
        }
        return arr;
    }
    var yearData = function(callback) {
        setTimeout(function() {
            callback(formatYear(nowYear))
        })
    }
    var monthData = function (year, callback) {
        setTimeout(function() {
            callback(formatMonth());
        });
    };
    var dateData = function (year, month, callback) {
        setTimeout(function() {
            if (/^1|3|5|7|8|10|12$/.test(month)) {
                callback(formatDate(31));
            }
            else if (/^4|6|9|11$/.test(month)) {
                callback(formatDate(30));
            }
            else if (/^2$/.test(month)) {
                if (year % 4 === 0 && year % 100 !==0 || year % 400 === 0) {
                    callback(formatDate(29));
                }
                else {
                    callback(formatDate(28));
                }
            }
            else {
                throw new Error('month is illegal');
            }
        });
    };
    showDateDom.bind('click', function () {
        var oneLevelId = showDateDom.attr('data-year');
        var twoLevelId = showDateDom.attr('data-month');
        var threeLevelId = showDateDom.attr('data-date');
        var iosSelect = new IosSelect(3, 
            [yearData, monthData, dateData],
            {
                title: '日期选择',
                itemHeight: 35,
                relation: [1, 1],
                oneLevelId: oneLevelId,
                twoLevelId: twoLevelId,
                threeLevelId: threeLevelId,
                showLoading: true,
                callback: function (selectOneObj, selectTwoObj, selectThreeObj) {
                    showDateDom.attr('data-year', selectOneObj.id);
                    showDateDom.attr('data-month', selectTwoObj.id);
                    showDateDom.attr('data-date', selectThreeObj.id);
                    showDateDom.val(selectOneObj.value + '-' + selectTwoObj.value + '-' + selectThreeObj.value);
                }
        });
    });
</script>
    </body>
</html>