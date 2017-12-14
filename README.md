SmartCI v1.6
=======
基于CI的RBAC访问控制

框架：CI 2.1.4
前端：bootstrap3.0
模型：RBAC0（甚至更简单）

<h2>个人财务开发</h2>
<p>前端增加工具</p>
表格--chart.js
弹窗--layer.js

<h3>在CI上增加的文件</h3>
<pre>
    application->controllers->manage[目录]
    此目录为RBAC的后端管理(不实现方法，只是简单调用,只是简单调用third_party下文件)
</pre>
<pre>
    application->controllers->index.php
    RBAC登录,用户主页(不实现方法,只是简单调用third_party下文件)
</pre>
<pre>
    application->third_party[目录]
    这里面就是整体的RBAC实现了,如果有更新,基本上只更新此目录即可[除非有特殊声明更新其他文件]
</pre>

<h3>在CI上配置的设置</h3>
<pre>
Autoload:
    packages    APPPATH.'third_party/rbac'
</pre>   
<pre>
Hooks:
    post_controller_constructor     RBAC验证
    display_override                重写显示(注意:默认重写view,如果不想重写则在方法中调用$this->view_override = FALSE;)
    pre_system                      开启原生SESSION
</pre>

<h3>RBAC支持的配置</h3>
<pre>
/* Location: ./application/third_party/rbac/config/rbac.php */
$config['rbac_auth_on']	             = TRUE;			      	//是否开启认证
$config['rbac_auth_type']	         = '2';			     		//认证方式1,登录认证;2,实时认证
$config['rbac_auth_key']	         = 'MyAuth';		 		//SESSION标记
$config['rbac_auth_gateway']         = 'Index/login';    		//默认认证网关
$config['rbac_default_index']        = 'product/index/index';   //成功登录默认跳转模块
$config['rbac_manage_menu_hidden']   = array('后台管理');		//后台管理导航中不显示的菜单
$config['rbac_manage_node_hidden']   = array('manage');			//后台管理节点中不显示的菜单
$config['rbac_notauth_dirc']         = array('');	     	    //默认无需认证目录array("public","manage","wap")
</pre>

测试地址
====
http://asset.zhoukoup.com

页面继承设置
=====
<pre>$this->view_override = FALSE ，不继承页面</pre>
安装设置
====
 * 把项目克隆到根目录
 * 导入sql文件
 * 修改database

实现功能
=====
 * 收支管理
    * 月收支输入、查看
    * 月收支统计
 * 资金配置管理，配置比率统计
 * 手机wap待完善
 
 
部分功能待完善
====


喜欢star，不喜欢留言改进
=====








