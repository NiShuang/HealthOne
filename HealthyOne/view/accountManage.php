<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Healthy One</title>
<link href="../css/reset.css" rel="stylesheet" type="text/css">
<link href="../css/topMenu.css" rel="stylesheet" type="text/css">
<link href="../css/leftMenu.css" rel="stylesheet" type="text/css">
<link href="../css/consult.css" rel="stylesheet" type="text/css">
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
            <li class="nav-item"><a href="http://localhost/healthyone/view/activityManage.php">活动</a></li>    
            <li class="nav-item cur"><a href="http://localhost/healthyone/view/accountManage.php">用户</a></li>    	
            <li class="nav-item"><a href="http://localhost/healthyone/view/adminPasswordSetting.php">设置</a></li>   			
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
      		<li class="menu-item_cur"><a href="http://localhost/healthyone/view/accountManage.php">审核认证</a></li>
        </ul>
    </div>
</div>
<div class="content">
<?php 
    require  '../model/adminService.class.php';
    $res = AdminService::findAllSpecial();
	while($item = $res->fetchArray(SQLITE3_ASSOC) ){	 
	    echo  "	<div class='item'> 
		<form name='consult' method='post' action='http://localhost/healthyOne/controller/accountProcess.php?operation=2'>
			<p class='name'><b>".$item['USERNAME']."  (".$item['TYPE'].")"."</b></p>
			<p class='profile'>".$item['INTRODUCTION']."</p>";
	    echo "<input type='hidden' name='id' value='".$item['USERNAME']."'></input>";
	    if($item['ISPASS']!=1)
	        echo "<input class='pass_submit' type='submit' value='通过'/>";
	    else
	        echo "<input class='pass_submit' type='button' value='已通过'/>";
           echo "</form>";
           echo "</div>";
	}
	?>
</div>
 <script language="javascript">
function firm() {
	 if (!confirm("确认要删除？")) {
         window.event.returnValue = false;
     }
}
</script>
<script>
$(function(){
	$(".nav").movebg({width:120/*滑块的大小*/,extra:40/*额外反弹的距离*/,speed:300/*滑块移动的速度*/,rebound_speed:400/*滑块反弹的速度*/});
})
</script>



</body>
</html>
