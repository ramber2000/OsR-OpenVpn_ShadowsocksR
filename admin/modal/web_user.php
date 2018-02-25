<?php if(!$p){exit();} ?> 
 <style>
td{
	
	text-align:center;
	border-color:#eeeeee;
}
 </style>
  <link href="css/style.min2.css?v=4.0.0" rel="stylesheet">
        <div class="static-content-wrapper">
          <div class="static-content">
            <div class="page-content">
              <div class="container-fluid">
                <div style="height:16px"></div>
<!-- 引入封装了failback的接口--initGeetest -->

 

<div class="row  border-bottom white-bg dashboard-header">

<div class="page-header" style="margin-top: -40px;">
							<h1>
								控制台
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									账号管理 &amp; 用户列表
								</small>
							</h1>
						</div><!-- /.page-header -->
<div class="alert alert-block alert-success">
									<button type="button" class="close" data-dismiss="alert">
										<i class="ace-icon fa fa-times"></i>
									</button>

									<i class="ace-icon fa fa-check green"></i>

									欢迎使用
									<strong class="green" onclick="openLog();">
										Html OS
										<small> (<?php echo file_get_contents('../version.txt'); ?>)</small>
									</strong>,全新SS+OP结合版流量控制系统.
								</div>

<div class="row">
   
                        <div class="col-md-12">
			<form action="index.php?action=web_user" method="post" class="form-inline">
  <div class="form-group" style="margin-top: -10px;">
   
  <input type="text" class="form-control" name="username" placeholder="输入账号">
  </div>
  <button type="submit" class="btn btn-primary">搜索</button>&nbsp;<a class="btn btn-info">平台共有 <b><?=$data['count']?></b> 个账号</a><br><br>
  <a href="javascript:;" onclick="add_user();" class="btn btn-success">添加账号</a>
 
  <a href="index.php?action=moneyadd" class="btn btn-info">余额充值</a>
  <a class="btn btn-red" onclick="delect('所有网站账号','1','web_user_all');">清空所有账号</a>
   
 <br>
</form>
		
                       
                             
   
             

                
                <div class="tab-content">
                  <div class="tab-pane active" id="others">
                      <div class="table-responsive">
           
             
                      
                                  <table id='mytable' class="table table-striped table-hover" style="overflow-y: hidden">    
                    <thead>
                    <tr>
                      <th style="text-align:center;">ID</th>
                        <th style="text-align:center;">用户名</th>
                     <th style="text-align:center;">密码</th>
                        <th style="text-align:center;">安全码</th>
                        <th style="text-align:center;">余额</th>
 
                        <th style="text-align:center;">注册日期</th>
           <th style="text-align:center;">SSR账单</th>
                        <th style="text-align:center;">OP账单</th>

                        <th colspan="2" style="text-align:center;">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                            
					
				<?php

$pagesize=15; 
$page=$_GET["page"];
$pagenum=ceil($data['count']/$pagesize);
if(empty($page)){
	$page=1;
}
else{
	$page=$_GET["page"];
}

$offset=$pagesize*($page - 1);

if ($page > $pagenum) {
$page = $pagenum;
}
if ($page < 5) {
if($pagenum < 5){
$start1 = 1;
$end = $pagenum;
}else{
	$start1 = 1;
$end = 5;
}
}
elseif ($page >= 5 && $page < $pagenum-4) {
$start1 = $page - 1;
$end = $page+3;
}
elseif ($page >= $pagenum) {
$start1 = $pagenum-4;
$end = $pagenum;
}

if(empty($_POST['username'])){
 
$sql = "select * from web_user limit ".$offset.",".$pagesize."";
$data = $pdo->getSome($sql);

}else{

$sql = "SELECT * FROM web_user where username= ? ";
$params = array($_POST['username']);
$data = $pdo->getSome($sql, $params);

}
foreach($data as $value)
  {
  
 
		
		$cssql = "select count(*) as count from web_bill where user_name = ? and b_tid = ? ";
		$csparams = array($value['username'], '1');
		$csdata = $pdo->getOne($cssql, $csparams);
	 
		
		$opsql = "select count(*) as count from web_bill where user_name = ? and b_tid = ? ";
		$opparams = array($value['username'], '2');
		$opdata = $pdo->getOne($opsql, $opparams);
		
		if(empty($csdata['count'])){$csdata['count']="0";}
		if(empty($opdata['count'])){$opdata['count']="0";}
		echo "<tr>";
		echo "<td>".$value['id']."</td>";
		echo "<td>".$value['username']."</td>";

		 
		echo "<td>".$value['password']."</td>";
		echo "<td>".$value['safeid']."</td>";
		echo "<td>".$value['money']."</td>";
		echo "<td>".$value['RegTime']."</td>";
		echo "<td>".$csdata['count']."</td>";
		echo "<td>".$opdata['count']."</td>";
 
		echo "<td><a class='btn btn-info' href='index.php?action=web_user_set&id=".$value['id']."'>配置</a><a class='btn btn-danger' onclick=\"delect('".$value['username']."','".$value['id']."','web_user');\">删除</a></td>";
		echo "</tr>";
	 
  }
 


?>
					
					
 



				 

					
					 </tbody>

                </table>
				</div>
                     <br>            
                <br><br>
				<ul class="pagination pagination-sm">
				  <li class=''><a href="index.php?action=web_user&page=<?php echo "1";  ?>">首页</a></li>
<?php 

for($i=$start1;$i<=$end;$i++){

       $show=($i!=$page)?"<li class=''><a href='index.php?action=web_user&page=".$i."'>$i</a></li>":"";
       echo $show."&nbsp;&nbsp";
	 
}


 ?>
 
 <li class=''><a href="index.php?action=web_user&page=<?php echo $pagenum;  ?>">尾页</a></li>
 </ul>
                <br>
               
            </div>

        <hr>

</div>




 </div>
                  </div>
                </div>


						</div>
            </div>
          </div>
					<br>
					<!-- footer.php -->
					<?php include_once('modal/footer.php');   ?>
					<!-- footer.php -->
        </div>
   
<!-- /Switcher -->
<!-- Load site level scripts -->
<script type="text/javascript" src="css/prettify.js"></script> 				<!-- Code Prettifier  -->
<script type="text/javascript" src="css/bootstrap-switch.js"></script> 		<!-- Swith/Toggle Button -->
<script type="text/javascript" src="css/bootstrap-tabdrop.js"></script>  <!-- Bootstrap Tabdrop -->
<script type="text/javascript" src="css/jquery.sparkline.min.js"></script><!-- Sparkline -->

<script type="text/javascript" src="css/icheck.min.js"></script>     					<!-- iCheck -->
<script type="text/javascript" src="css/enquire.min.js"></script> 									<!-- Enquire for Responsiveness -->
<script type="text/javascript" src="css/bootbox.js"></script>							<!-- Bootbox -->
<script type="text/javascript" src="css/jquery.nanoscroller.min.js"></script> <!-- nano scroller -->
<script type="text/javascript" src="css/jquery.mousewheel.min.js"></script> 	<!-- Mousewheel support needed for jScrollPane -->
<script type="text/javascript" src="css/application.js"></script>
<script type="text/javascript" src="css/demo.js"></script>
<!-- End loading site level scripts -->
	<!-- Load page level scripts-->
<script type="text/javascript">
function add_user(){	
 
layer.open({
  type: 1,
  skin: 'layui-layer-demo', //样式类名
  closeBtn: 0, //不显示关闭按钮
  anim: 2,
  area: ['90%','70%'],
  shadeClose: true, //开启遮罩关闭
  content: '<div class=""><div class=""><div class="panel panel-default"><div class="panel-body"><p style="text-align: center;">添加网站用户</p><form class="modal-body form-horizontal"action="?action=web_user&c=add"method="post"><div class="form-group"><label class="col-sm-2 control-label">邮箱账号</label><div class="col-sm-8"><input type="text"name="email"class="form-control"value=""/></div></div><div class="form-group"><label class="col-sm-2 control-label">登录密码</label><div class="col-sm-8"><input type="text"name="pass"class="form-control"value=""/></div></div><div class="form-group"><label class="col-sm-2 control-label">余额</label><div class="col-sm-8"><input type="text"name="money"class="form-control"value="0"/></div></div><div class="form-group"><label class="col-sm-2 control-label">安全码</label><div class="col-sm-8"><input type="text"name="safeid"class="form-control"value=""/></div></div><div class="modal-footer"><button type="submit"class="btn btn-green">保存</button></div></form></div></div><hr></div></div>'
});

}
	</script>
	<script src="css/jquery.flot.min.js"></script>             <!-- Flot Main File -->

	<script src="css/jquery.flot.tooltip.min.js"></script>    <!-- Flot Tooltips -->
	<!-- End loading page level scripts </script> 	 -->

	

 