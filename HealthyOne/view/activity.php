<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Healthy One</title>
<link href="../css/reset.css" rel="stylesheet" type="text/css">
<link href="../css/topMenu.css" rel="stylesheet" type="text/css">
<link href="../css/leftMenu.css" rel="stylesheet" type="text/css">
<link href="../css/activity.css" rel="stylesheet" type="text/css">
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
            <li class="nav-item cur"><a href="http://localhost/healthyone/view/activity.php">活动</a></li>
            <li class="nav-item"><a href="http://localhost/healthyone/view/consult.php">咨询</a></li> 
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
      		<li class="menu-item_cur"><a href="http://localhost/healthyone/view/activity.php">活动列表</a></li>
            <li class="menu-item"><a href="http://localhost/healthyone/view/myActivity.php">我的活动</a></li>
        </ul>
    </div>
</div>
<div class="content">
	<?php 
    require  '../model/activityService.class.php';
    $res = ActivityService::findAll();
	while($item = $res->fetchArray(SQLITE3_ASSOC) ){
	    $res1 = ActivityService::isIn($username, $item['ID']);
	    
	    echo  "	<div class='item'> 
		<form name='activity' method='post' action='http://localhost/healthyOne/controller/activityManageProcess.php?operation=2'>
			<p class='activity_tittle'><b>".$item['DESCRIBE']."</b></p>
			<p class='activity_time'>".$item['TIME']."</p>
			<p class='activity_place'>".$item['PLACE']."</p>
            <input type='hidden' name='id' value='".$item['ID']."'></input>";
    if(!$res1->fetchArray())
			echo "<input class='activity_submit' type='submit' value='我要报名'/>";
    else
            echo "<input class='activity_submit' type='button' value='已报名'/>";
            echo "</form></div>";
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
