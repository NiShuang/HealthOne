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
            <li class="nav-item cur"><a href="http://localhost/healthyone/view/consultManage.php">咨询</a></li> 
            <li class="nav-item"><a href="http://localhost/healthyone/view/SpecialSetting.php">设置</a></li>          		
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
      		<li class="menu-item_cur"><a href="http://localhost/healthyone/view/consultManage.php">咨询列表</a></li>
        </ul>
    </div>
</div>
<div class="content">
<form action="http://localhost/healthyone/controller/consultProcess.php?operation=2" method="post">
<input type="file" class= 'upload' name="uploadfile" id="uploadfile" />
  <input class='consult_submit' style="margin-top: 0px" type="submit" value="一键导入" />
</form>

<?php 
    require  '../model/consultService.class.php';
    $res = ConsultService::findConsult($username);
	while($item = $res->fetchArray(SQLITE3_ASSOC) ){	
	    
	    if($item['ADVICE']==""){
	        $advice = "待回复";
	    }
	    else 
	        $advice =  $item['ADVICE'];
	    echo  "	<div class='item2'> 
		<form name='consult' method='post' action='http://localhost/healthyOne/controller/consultProcess.php?operation=1' >
			<p class='name'><b>".$item['USERNAME']."</b></p>
            &nbsp问题： <p class='dialog'>".$item['PROBLEM']."</p>
            &nbsp建议：     <textarea class='dialog' id='advice' name='advice'>$advice</textarea>";
	       echo "<input class='consult_submit' type='hidden' name='id' value='".$item['ID']."'/>";
	       echo "<input class= 'upload' type='file' name='uploadfile' id='uploadfile' />";
	       echo "<input class='consult_submit' type='submit' value='回复'/>";
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
