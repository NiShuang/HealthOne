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
            <li class="nav-item"><a href="http://localhost/healthyone/view/activityManage.php">活动</a></li>    
            <li class="nav-item"><a href="http://localhost/healthyone/view/accountManage.php">用户</a></li>   
            <li class="nav-item cur"><a href="http://localhost/healthyone/view/adminPasswordSetting.php">设置</a></li>          		
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
            <li class="menu-item_cur"><a href="http://localhost/healthyone/view/adminPasswordSetting.php">修改密码</a></li>
        </ul>
    </div>
</div>
<div class="content">
	<form name="information" method="post" action="http://localhost/healthyOne/controller/accountProcess.php?operation=1" onsubmit="return check()">
		<p class="item"><b>当前密码</b><input class="password_input" type="password" name="oldPassword" id="oldPassword"/></p>		
		<p class="item"><b>&nbsp&nbsp&nbsp新密码</b><input class="password_input" type="password" name="newPassword" id="newPassword"/></p>		
		<p class="item"><b>确认密码</b><input class="password_input" type="password" name="confirmPassword" id="confirmPassword"/></p>		
		<p><input id="save_btn" type="submit" name="save" value="保存"/></p>		
		<?php 
		if(is_array($_GET)&&count($_GET)>0){
		    if(isset($_GET["errno"])){
		       if($_GET['errno']==0){
		          echo "<p style= 'color: red;padding-left:100px'>密码错误,无法修改！</p>";
		       }
		    }
		    else if(isset($_GET["success"])){
		        if($_GET['success']==1){
		            echo "<p style= 'color: red;padding-left:100px'>密码修改成功！</p>";
		        }
		    }
		}
		?>	
	</form>			
</div>
<script type="text/javascript">  
        function check(){  
            var oldPassword=window.document.getElementById("oldPassword").value;  
            var newPassword=window.document.getElementById("newPassword").value; 
            var confirmPassword=window.document.getElementById("confirmPassword").value; 
            if (oldPassword == ""||newPassword == ""||confirmPassword == "") 
            {  
                window.alert("请填写完整!");  
                return false;  
            }
            if (newPassword!=confirmPassword){
                window.alert("两次密码不一致!");  
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
