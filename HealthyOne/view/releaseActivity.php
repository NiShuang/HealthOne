<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Healthy One</title>
<link href="../css/reset.css" rel="stylesheet" type="text/css">
<link href="../css/topMenu.css" rel="stylesheet" type="text/css">
<link href="../css/leftMenu.css" rel="stylesheet" type="text/css">
<link href="../css/releaseActivity.css" rel="stylesheet" type="text/css">
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
            <li class="nav-item cur"><a href="http://localhost/healthyone/view/activityManage.php">活动</a></li> 
            <li class="nav-item"><a href="http://localhost/healthyone/view/accountManage.php">用户</a></li>   
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
      		<li class="menu-item"><a href="http://localhost/healthyone/view/activityManage.php">活动管理</a></li>
            <li class="menu-item_cur"><a href="http://localhost/healthyone/view/releaseActivity.php">发布活动</a></li>
        </ul>
    </div>
</div>
<div class="content">
	<div class="item"> 
		<form name="activity" method="post" action="http://localhost/healthyOne/controller/releaseActivityProcess.php" onsubmit="return check()">
		<p class="item"><b>活动描述</b><input id="describe_input" type="text" name="describe"/></p>
		<p class="item"><b>活动时间</b><input id="time_input" type="text" name="time"/></p>			
		<p class="item"><b>活动地点</b><input id="place_input" type="text" name="place"/></p>				
		<p><input id="release_btn" type="submit" name="release" value="发布"/></p>	
		<?php 
		if(is_array($_GET)&&count($_GET)>0){
		    if(isset($_GET["errno"])){
		       if($_GET['errno']==0){
		          echo "<p style= 'color: red; margin-left: 110px'>发布失败！</p>";
		       }
		    }
		    else if(isset($_GET["success"])){
		        if($_GET['success']==1){
		           echo "<p style= 'color: red; margin-left: 110px'>发布成功！</p>";
		        }
		    }
		}
		?>		
		</form>
	</div>
</div>
<script type="text/javascript">  
        function check(){  
            var describe=window.document.getElementById("describe_input").value;  
            var time=window.document.getElementById("time_input").value; 
            var place=window.document.getElementById("place_input").value; 
            if (describe == ""||time == ""||place == "") 
            {  
                window.alert("请填写完整!");  
                return false;  
            }
            return true;  
        }  
</script>  
<script>
$(function(){
	$(".nav").movebg({width:120/*滑块的大小*/,extra:40/*额外反弹的距离*/,speed:300/*滑块移动的速度*/,rebound_speed:400/*滑块反弹的速度*/});
})
</script>



</body>
</html>
