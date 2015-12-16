<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Healthy One</title>
<link href="../css/reset.css" rel="stylesheet" type="text/css">
<link href="../css/topMenu.css" rel="stylesheet" type="text/css">
<link href="../css/leftMenu.css" rel="stylesheet" type="text/css">
<link href="../css/setting.css" rel="stylesheet" type="text/css">
<script src="../js/jquery-1.7.2.min.js"></script>
<script src="../js/jquery.movebg.js"></script>
</head>

<body>
<?php 
    session_start();
    $username = $_SESSION["username"];
?>
<div class="wraper">
    <div class="nav">
        <ul>
            <li class="nav-item "><a href="http://localhost/healthyone/view/consultManage.php">咨询</a></li> 
            <li class="nav-item cur"><a href="http://localhost/healthyone/view/specialSetting.php">设置</a></li>          		
            <li class="nav-item" id="welcome"><img class="avata" src="http://localhost/HealthyOne/img/avata.jpg"  alt="头像" /> <?php echo $username?>
            	<ul class="nav_submenu">
       				 <li class="nav_submenu-item"> <a href="http://localhost/healthyone/index.php">退出</a></li>
      			</ul>
     		</li>         
     	</ul>
        <div class="move-bg"></div>        
    </div>
</div>
<div class="daohang">
	<div class="menu">
    	<ul>
      		<li class="menu-item"><a href="http://localhost/healthyone/view/SpecialSetting.php">基本信息</a></li>
            <li class="menu-item_cur"><a href="http://localhost/healthyone/view/specialAvataSetting.php">头像设置</a></li>
            <li class="menu-item"><a href="http://localhost/healthyone/view/SpecialPasswordSetting.php">修改密码</a></li>
        </ul>
    </div>
</div>
<div class="content">
	<form name="information" action="http://localhost/healthyOne/view/setting.php">
		<div class = "upload">
			<img class="uploadAvata" src="http://localhost/HealthyOne/img/avata.jpg"  alt="头像不见了" />
			<br></br>
			<input type="file" name="uploadfile" id="uploadfile" value="选择文件" />
			<p><input id="save_btn" type="submit" name="save" value="保存"/></p>	
		</div>	
	</form>				
</div>
<script>
$(function(){
	$(".nav").movebg({width:120/*滑块的大小*/,extra:40/*额外反弹的距离*/,speed:300/*滑块移动的速度*/,rebound_speed:400/*滑块反弹的速度*/});
})
</script>



</body>
</html>
