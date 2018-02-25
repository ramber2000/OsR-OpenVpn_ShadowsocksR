  
			<section>
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2 text-center">
				<h1>OpenVpn - <?=$bdata['b_name']?></h1>
				<hr>
				<div class="h2 text-center"><?php
	 
  if($bdata['b_i']==0){
	  
	  echo "<span class='label label-terminated'>已删除</span>";
	   
  }elseif($bdata['b_i']==1){
	  
	    echo "<span class='label label-active'>有效的</span>";
	   ?>
 
	  </div>
			</div>
		</div><br>
				
		<div class="row">
			<div class="col-md-8">
                                <div class="panel panel-default">
                                        <div class="panel-heading"><strong>相关信息</strong></div>
				                                <div class="table-responsive">
<table class="table table-hover table-striped table-bordered" style="font-size:16px;">
    <thead>
        <tr class="warning">
            <th colspan="10">
                配置信息
            </th>
        </tr>
    </thead>
    <tbody>
	
	 
        
			
			
			<?php
	
		$sql = "select * from openvpn where user_name = ? and bill_id = ? ";
		$params = array($_SESSION['username'],$bdata['attach']);
		$data = $pdo->getOne($sql, $params);
 
 
		$used=$data['isent']+$data['irecv'];
		$surplus=$data['maxll']-$used;
		
		if($data['maxll']>107374182400){$max="不限制";}else{$max=round($data['maxll']/1024/1024/1024)." GB";}
		
		echo "<td>账号</td><td>".$data['iuser']."</td>";
		echo "<td>密码</td><td>".$data['pass']."</td>";
		echo "<td>流量</td><td>".$max."</td>";
		echo "<td>已用</td><td>".round($used/1024/1024)." MB</td>";
		echo "<td>剩余</td><td>".round($surplus/1024/1024/1024)." GB</td>";
	    
		
 
	
	?>
        </tr>
    </tbody>
    <thead>
	 <tr class="warning">
            <th colspan="10">
                <a href='/HTML-ws.apk'>安卓APP点此下载    （苹果安装OpenVPN软件后在以上路线选择直接安装）</a>
            </th>
        </tr>
        <tr class="warning">
            <th colspan="10">
                节点/服务器/IP地址/省流路线
            </th>
        </tr>
		 
        <tr>
            <th class="text-center" colspan="1">#</th>
            <th class="text-center" colspan="2">路线名称</th>
            <th class="text-center" colspan="2">分类</th>
            <th class="text-center" colspan="3">说明</th>
            <th class="text-center" colspan="2">安装</th>
        </tr>
    </thead>
    <tbody>
            
		
		<?php 

$snsql = "select * from line";
$sndata = $pdo->getSome($snsql);

foreach($sndata as $value)
  {
   if($value['group']==1){
	   
	   $line_type="移动";
	   
   }elseif($value['group']==2){
	   $line_type="电信";
   }elseif($value['group']==3){
	   $line_type="联通";
   }
   echo "<tr>";
   echo "<td class='text-center' colspan='1'>#".$value['id']."</td>";
   echo "<td class='text-center' colspan='2'>".$value['name']."</td>";
   echo "<td class='text-center' colspan='2'>".$line_type."</td>";
   echo " <td class='text-center' colspan='3'>".$value['type']."</td>";
   echo "<td class='text-center' colspan='2'>";
   if($UA==1){
   echo "<a href='/index.php?action=Opgoods&add_line=yes&username=".$data['iuser']."&password=".$data['pass']."&lineid=".$value['id']."'>IOS安装路线</a></td>";
   }elseif($UA==2){
   echo "下载软件使用";
   }elseif($UA==3){
   echo "<a href='/index.php?action=Opgoods&add_line=yes&username=".$data['iuser']."&password=".$data['pass']."&lineid=".$value['id']."'>安装路线</a></td>";
   }
   echo "</tr>";
    
  }
  
		?>
		 
           
        </tbody>
		
		 
	 
</table>

<!-- Modal -->
<div style="position: fixed; height: 256px; width: 256px; border-radius: 5px; background-color: rgba(0, 0, 0, 0.498039); top: 40%; left: 40%; box-shadow: rgb(238, 238, 238) 0px 2px 5px 8px; display: none;" id="qrcode">
    <div style="background-color:white;text-align:right" class="text-right">
        <a href="javascript:void(0)" id="qr-close">
      <!--   <i class="fa fa-times"></i> -->
      x
        </a>&nbsp;
    </div>
    <div class="qr-body"><canvas width="256" height="256"></canvas></div>
</div></div>
                                				</div>
			</div>
                        <div class="col-md-4">
                                                                <div class="panel panel-default">
                                        <div class="panel-heading"><strong>管理产品</strong></div>
                                        <div class="panel-body">
                                                <a href="#modal-modulechangepassword" data-toggle="modal" title="修改密码" class="btn btn-info btn-sm">修改OpenVpn连接密码</a>                                                                                        </div>
                                </div>
                                                                <div class="panel panel-default">
                                        <div class="panel-heading"><strong>财务管理</strong> <span class="pull-right"><a href="#modal-modulequest" data-toggle="modal">续费</a></span></div>
                                        <div class="panel-body">
                                                <p><strong>注册日期:</strong><br><?=$bdata['b_time']?></p>
                                                <p><strong>首次付款金额:</strong><br>￥<?=$bdata['b_price']?>.00 RMB</p>
                                                <p><strong>续约价格:</strong><br>￥<?=$bdata['b_price']?>.00 RMB</p> 
                                                <p><strong>下次付款日期:</strong><br><?=$bdata['b_end_time']?></p> 
                                                <p><strong>账单周期:</strong><br>一次性</p>
                                                <p><strong>付款方式:</strong><br>账户余额</p>
                                        </div>
                                </div>
                                                        </div>
		
	</div>
	
</div></section>
  <?php }
	  ?>
<div class="modal fade" id="modal-modulechangepassword">
	<div class="modal-dialog">   
		<form method="post" action="/member/Opgoods/update/<?=$_GET['id']?>" class="modal-content">
 
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title"><span class="fa fa-lock"></span> 修改密码</h4>
			</div>
			<div class="modal-body">
				<p class="text-warning">您可以在此修改产品密码（注意：修改此密码不会影响您在客户中心的密码）</p>
 
				<div class="row">
					<div class="col-md-6">
						<div class="form-group has-feedback">
							<label for="modulenewpw">新密码</label>
							<input type="hidden" name="id" value="<?=$bdata['attach']?>">
							<input type="text" name="newpw" id="modulenewpw" class="form-control" value="<?=$data['pass']?>">
							<span class="form-control-feedback glyphicon"></span>
						</div>
					</div>
					 
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">修改密码</button>
				<button type="reset" class="btn btn-default" data-dismiss="modal">取消</button>
			</div>
		</form>
		
		
	</div>
</div>
    
<div class="modal fade" id="modal-modulequest">
	<div class="modal-dialog">   
		<form method="post" action="/member/Opgoods/renewal/<?=$_GET['id']?>" class="modal-content">
 
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title"><span class="fa fa-lock"></span> 申请续费</h4>
			</div>
			<div class="modal-body">
				<p class="text-warning">您可以随时申请续费，续费后，流量与时间叠加</p>
 
				<div class="row">
					<div class="col-md-6">
						<div class="form-group has-feedback">
							
							  <input type="hidden" name="id" value="<?=$bdata['attach']?>">
							  <input type="hidden" name="renewal_price" value="<?=$bdata['attach']?>">
							  
							  <input type="hidden" name="id" value="<?=$bdata['attach']?>">
							  
							  <strong>续约价格:</strong> ￥<?=$bdata['b_price']?>.00 RMB  
							 <br>
							  <strong>付款方式:</strong>    账户余额  <br> <strong>当前可用余额为：</strong><?=$ydata["money"]?>元
							 
							 
							 
							<span class="form-control-feedback glyphicon"></span>
						</div>
					</div>
					 
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">续费</button>
				<button type="reset" class="btn btn-default" data-dismiss="modal">取消</button>
			</div>
		</form>
		
		
	</div>
</div>

<script type="text/javascript">
	$(function() {
		// Password Strength
		$('#modulenewpw').keyup(function() {
			$(this).parent().removeClass('has-warning has-error has-success');
			$(this).next().removeClass('glyphicon-thumbs-down glyphicon-thumbs-up');
			if($(this).val().length == 0) {
				return;
			}
			var pwstrength = passwordStrength($(this).val());
			if(pwstrength > 75) {
				$(this).parent().addClass("has-success");
				$(this).next().addClass('glyphicon-thumbs-up');
			} else if (pwstrength > 30) {
				$(this).parent().addClass("has-warning");
				$(this).next().addClass('glyphicon-thumbs-down');
			} else {
				$(this).parent().addClass("has-error");
				$(this).next().addClass('glyphicon-thumbs-down');
			}
			$('#confirmpw').keyup();
		});
		// Compare passwords
		$('#moduleconfirmpw').keyup(function() {
			$(this).parent().removeClass('has-error has-success');
			$(this).next().removeClass('glyphicon-thumbs-down glyphicon-thumbs-up');
			if($(this).val().length < 1) return;
			if($('#modulenewpw').val() != $(this).val()) {
				$(this).parent().addClass("has-error");
				$(this).next().addClass('glyphicon-thumbs-down');
			} else {
				$(this).parent().addClass("has-success");
				$(this).next().addClass('glyphicon-thumbs-up');
			}
		});
	});
</script>
 
		 