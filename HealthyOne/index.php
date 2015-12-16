<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Healthy One</title>
<meta name="description" content="slick Login">
<meta name="author" content="Webdesigntuts+">
<link rel="stylesheet" type="text/css" href="css/style.css" />
<script type="text/javascript" src="js/placeholder.js"></script>
</head>
<body>
	<form id="slick-login" action="http://localhost/HealthyOne/controller/loginProcess.php" method="post" onsubmit="return check()">
		<p class="tittle">登录</p>
		<label for="username">username</label><input type="text" id="username" name="username" class="placeholder" placeholder="username">
		<label for="password">password</label><input type="password" id="password" name="password" class="placeholder" placeholder="password">
		<input type="submit" value="Log In">
		<br></br>
		<p>还没注册账号？<a href="http://localhost/healthyone/view/signUp.php">[立即注册]</a></p>
		<br>
		<p><a href="http://localhost/healthyone/view/SpecialSignUp.php">医生、教练注册通道</a></p>
		<br></br>
		<?php 
		if(is_array($_GET)&&count($_GET)>0){
		    if(isset($_GET["errno"])){
		       if($_GET['errno']==0){
		          echo "<p style= 'color: red'>账号或密码错误！</p>";
		       }
		    }
		    else if(isset($_GET["success"])){
		        if($_GET['success']==1){
		            echo "<p style= 'color: red'>注册成功！请登录。</p>";
		        }
		        if($_GET['success']==2){
		            echo "<p style= 'color: red'>注册成功！等待审核。</p>";
		        }
		    }
		}
		?>
	</form>
	<script type="text/javascript">  
        function check(){  
            var nameValue=window.document.getElementById("username").value;  
            var password=window.document.getElementById("password").value; 
            if (nameValue == "") 
            {  
                window.alert("用户名不能为空!");  
                return false;  
            }  
            if (password == "") 
            {  
                window.alert("密码不能为空!");  
                return false;  
            }  
            return true;  
        }  
     </script>  
</body>
</html>