<html>
<head>
	<title>ورود</title>
	<link rel="stylesheet" href="styleslogin.css">
	<meta charset="utf-8">
</head>
<body>
<form method="post">
	<?php
		include"../url.php";
		$con=mysql_connect($url,$user,$pass,$db);
		mysql_select_db($db,$con);
		/*mysql_query("grant all privileges on *.* to 'Admin'@'$url' identified by 'admin'",$con);
		echo mysql_error().'</br>';
		echo mysql_error().'</br>';
		mysql_query("set password for 'Admin'@'$url' =password('admin')",$con);
		echo mysql_error().'</br>';
		$con=mysql_connect($url,"Admin","admin");
		mysql_query("create database if not exists db",$con);
		echo mysql_error($con);
		echo mysql_error($con).'</br>';
		mysql_select_db("db",$con);
		mysql_query("create table if not exists payments(
			id int ,
			number int ,
			payments.group varchar(100),
			facilities varchar(500),
			price int ,
			istitr varchar(10)		)",$con);
		
		echo mysql_error($con);
		mysql_query("create table if not exists login(
			user varchar(100),
			password varchar(100)
		)",$con);
		mysql_query("create table if not exists parts(part varchar(100))",$con);*/
		$r=mysql_query("select * from login",$con);
		if(!mysql_fetch_array($r))
			mysql_query("insert into login(user,password,access) values('admin','admin','مدیر')",$con);
		
		$warning="";
        session_cache_expire(30);
		session_start();
		ob_start();
		$_SESSION["ok"]=false;
		if(isset($_POST["submite"])){
			//$con=mysql_connect("localhost","Admin","admin","db");
			$r=mysql_query("select * from login",$con);
			while($row=mysql_fetch_array($r)){
				if($_POST["user"]==$row["user"]&&$_POST["pass"]==$row["password"]){
					$_SESSION["ok"]=true;
                    $_SESSION["access"]=$row["access"];
                    $_SESSION["user"]=$row["user"];
					echo"<script>window.location.replace('index.php')</script>";
					
				}
				$warning="OK";
			}
			if($_SESSION["ok"]==false&&!($_POST["user"]==""&&$_POST["pass"]=="")){
				echo"<script>alert('نام کاربری یا کلمه عبور نادرست می باشد')</script>";
				
			}
		mysql_close($con);	
		}
	
	?>
	<center>
	<div align="center" id="container1" style="vertical-align:center;
	horizontal-align:center;
	margin:auto;
	left:100px;
	right:100px;
	top:100px;
	bottom:100px;
	width:400px;
	height:300px;
	background-color:gray;
	position:absolute;">
	
	<table align="center" id="logintable" dir=rtl>
	
	<tr>
		<td style="color:blue;width:80px">نام کاربری</td>
		<td><input type="text" value="" name="user" style="width:200px;height:40px"/>
	</tr>
	<tr style="height:20px"></tr>
	</br>
	<tr>
		<td style="color:blue;width:80px">کلمه عبور</td>
		<td><input type="password" value="" name="pass" style="width:200px;height:40px"/>
	
	</tr>
		</br>
		<tr style="height:35px"></tr>
	<tr >
		
		<td colspan=2 align="center"><input type='submit' value="ورود" name="submite"  style="width:200px;height:60px;background-color:#4f59a1;color:white;border-radius:10px 10px 10px 10px;border-color:#4f59a1" ></td>
	</tr>
	</br>
	<tr>
		<td colspan=2 style="color:white;">
		<?php
		echo $warning;
		?>
		</td>
	
	</tr>
	</table>
	</div>
	</center>
	</form>
</body>
</html>