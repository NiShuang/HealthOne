<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Healthy One</title>
<link href="../css/reset.css" rel="stylesheet" type="text/css">
<link href="../css/topMenu.css" rel="stylesheet" type="text/css">
<link href="../css/leftMenu.css" rel="stylesheet" type="text/css">
<link href="../css/question.css" rel="stylesheet" type="text/css">
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
      		<li class="menu-item_cur"><a href="http://localhost/healthyone/view/consult.php">专家列表</a></li>
            <li class="menu-item"><a href="http://localhost/healthyone/view/myAdvice.php">咨询建议</a></li>
        </ul>
    </div>
</div>
<div class="content">
	<div class="item"> 
		<form name="activity" method="post" action="http://localhost/healthyOne/controller/consultProcess.php?operation=0" onsubmit="return check()">
		<p class="item"><b>被咨询人: &nbsp&nbsp</b><?php echo $_GET['id']?></p>
		<p class="item">		
		<div class="label">
			<b>咨询内容</b>
		</div> 
		<textarea class="question" id="question" name="problem"></textarea></p>
		<a href="http://localhost/healthyOne/view/consult.php" id="return_btn" name="return" value="还原">返回</a>		
		<input  type="hidden" name="consulted" value="<?php echo $_GET['id']?>"/>		
		<input id="save_btn" type="submit" name="release" value="保存"/>	
		</form>
		<?php 
		if(is_array($_GET)&&count($_GET)>0){
		    if(isset($_GET["success"])){
		       if($_GET['success']==1){
		          echo "<p style= 'color: red'>咨询成功！请等待回复！</p>";
		       }
		    }
		}
		?>
	</div>
</div>
<script type="text/javascript">  
        function check(){  
            var question=window.document.getElementById("question").value;  

            if (question == "") 
            {  
                window.alert("请说明咨询内容!");  
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
