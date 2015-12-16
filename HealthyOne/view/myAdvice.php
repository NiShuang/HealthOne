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

            <li class="nav-item"><a href="http://localhost/healthyone/view/health.php">健康</a></li>
            <li class="nav-item"><a href="http://localhost/healthyone/view/activity.php">活动</a></li>
            <li class="nav-item cur"><a href="http://localhost/healthyone/view/consult.php">咨询</a></li> 
            <li class="nav-item"><a href="http://localhost/healthyone/view/setting.php">设置</a></li>          		
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
      		<li class="menu-item"><a href="http://localhost/healthyone/view/consult.php">专家列表</a></li>
            <li class="menu-item_cur"><a href="http://localhost/healthyone/view/myAdvice.php">咨询建议</a></li>
        </ul>
    </div>
</div>
<div class="content">
<?php 
    require  '../model/consultService.class.php';
    $res = ConsultService::find($username);
	while($item = $res->fetchArray(SQLITE3_ASSOC) ){	
	    
	    if($item['ADVICE']==""){
	        $advice = "待回复";
	    }
	    else 
	        $advice =  $item['ADVICE'];
	    echo  "	<div class='item1'> 
		<form name='consult' method='post' action='http://localhost/healthyOne/controller/consultProcess.php'>
			<p class='name'><b>".$item['CONSULTED']."</p><b>
            &nbsp问题</b>  <p class='dialog'>".$item['PROBLEM']."</p><b>
            &nbsp建议   </b>  <p class='dialog'>$advice</p>";
           echo "</form>";
           echo "</div>";
	}
	?>
</div>
<script>
$(function(){
	$(".nav").movebg({width:120/*滑块的大小*/,extra:40/*额外反弹的距离*/,speed:300/*滑块移动的速度*/,rebound_speed:400/*滑块反弹的速度*/});
})
</script>



</body>
</html>
