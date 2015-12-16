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

            <li class="nav-item"><a href="http://localhost/healthyone/view/health.php">健康</a></li>
            <li class="nav-item"><a href="http://localhost/healthyone/view/activity.php">活动</a></li>
            <li class="nav-item"><a href="http://localhost/healthyone/view/consult.php">咨询</a></li> 
            <li class="nav-item cur"><a href="http://localhost/healthyone/view/setting.php">设置</a></li>          		
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
      		<li class="menu-item_cur"><a href="http://localhost/healthyone/view/setting.php">基本信息</a></li>
            <li class="menu-item"><a href="http://localhost/healthyone/view/avataSetting.php">头像设置</a></li>
            <li class="menu-item"><a href="http://localhost/healthyone/view/passwordSetting.php">修改密码</a></li>
        </ul>
    </div>
</div>
<?php 
require  '../model/adminService.class.php';

$name="";
$sex=0;
$year=1915;
$month=1;
$day=1;
$hobby="跑步";
$declaration="";
$res = AdminService::findAccount($username);
if($item = $res->fetchArray(SQLITE3_ASSOC)){
    $name=$item['NAME'];
    $sex=$item['SEX'];
    $array=explode("-",$item['BIRTHDAY']);
    $year=$array[0];
    $month=$array[1];
    $day=$array[2];
    $hobby=$item['HOBBY'];
    $declaration=$item['DECLARATION'];
}
?>
<div class="content">
	<form name="information" method="post" action="http://localhost/healthyOne/controller/accountProcess.php?operation=0">
		<p class="item"><b>姓名</b><input id="name_input" type="text" name="name" value="<?php echo $name?>"/></p>		
		<p class="item"><b>性别</b><input id="sex_select" type="radio" name="sex" value="1" <?php if($sex==1) echo "checked='checked'"?>/>男<input id="sex_select" type="radio" name="sex" value="2" <?php if($sex==2) echo "checked='checked'"?>/>女</p>
		<p class="item"><b>生日</b>
<!-- 			<input id="year_input" type="text" name="year"/> 年 -->
			<select id="year_select" name="year">
			<?php
			for($i=1915;$i<2016;$i++){
			    echo "<option value='$i' ";
			    if($year==$i) 
			        echo "selected='selected'";
                echo ">$i</option>";
			}
			?>
				
			</select> 年
			<select id="month_select" name="month">
			<?php
			for($i=1;$i<13;$i++){
			    echo "<option value='$i' ";
			    if($month==$i) 
			        echo "selected='selected'";
                echo ">$i</option>";
			}
			?>
			</select> 月
			<select id="day_select" name="day">
			<?php
			for($i=1;$i<32;$i++){
			    echo "<option value='$i' ";
			    if($day==$i) 
			        echo "selected='selected'";
                echo ">$i</option>";
			}
			?>
			</select> 日
		</p>
		<p class="item"><b>兴趣</b>
			<select id="hobby_select" name="hobby">
				<option value="跑步" <?php if($hobby=='跑步') echo "selected='slected'"?>>跑步</option>  
  				<option value="登山"<?php if($hobby=='登山') echo "selected='slected'"?>>登山</option>  
 				<option value="足球"<?php if($hobby=='足球') echo "selected='slected'"?>>足球</option>  
  				<option value="篮球"<?php if($hobby=='篮球') echo "selected='slected'"?>>篮球</option> 
  				<option value="羽毛球"<?php if($hobby=='羽毛球') echo "selected='slected'"?>>羽毛球</option>  
  				<option value="乒乓球"<?php if($hobby=='乒乓球') echo "selected='slected'"?>>乒乓球</option>  
 				<option value="自行车"<?php if($hobby=='自行') echo "selected='slected'"?>>自行车</option>  
  				<option value="麻将"<?php if($hobby=='麻将') echo "selected='slected'"?>>麻将</option> 
  				<option value="其他"<?php if($hobby=='其他') echo "selected='slected'"?>>其他</option>  
			</select>
		</p>
		<p class="item">
		<div class="label">
			<b>运动宣言</b>
		</div>
			<textarea id="declaration_input"  name="declaration" ><?php echo $declaration?></textarea>
		</p>
		<p><input id="save_btn" type="submit" name="save" value="保存"/></p>		
		<?php 
		if(is_array($_GET)&&count($_GET)>0){
		    if(isset($_GET["errno"])){
		       if($_GET['errno']==1){
		          echo "<p style= 'color: red;padding-left:100px'>保存失败！</p>";
		       }
		    }
		    else if(isset($_GET["success"])){
		        if($_GET['success']==1){
		            echo "<p style= 'color: red;padding-left:100px'>保存成功！</p>";
		        }
		    }
		}
		?>		
	</form>				
</div>
<script>
$(function(){
	$(".nav").movebg({width:120/*滑块的大小*/,extra:40/*额外反弹的距离*/,speed:300/*滑块移动的速度*/,rebound_speed:400/*滑块反弹的速度*/});
})
</script>



</body>
</html>
