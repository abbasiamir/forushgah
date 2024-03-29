<html>
<head>
	<title>کاربر جدید</title>
	<link rel="stylesheet" href="stylesuser.css">
	<script src="jquery.js"></script>
	<script src="scriptlogin.js"></script>
	<script>     $(document).ready(function () {

        
        
     });

     function adduserface() {
         document.getElementById("del").style.visibility = "hidden";
         document.getElementById("change").style.visibility = "hidden";
         document.getElementById("add").style.visibility = "visible";
         //document.getElementById("usertr").style.display="table";
         document.getElementById("lasttr").style.display = "none";
         document.getElementById("passtr").style.display = "table-row";
         document.getElementById("repasstr").style.display = "table-row";
     }
     function changpassface() {
         document.getElementById("add").style.visibility = "hidden";
         document.getElementById("del").style.visibility = "hidden";
         document.getElementById("change").style.visibility = "visible";
         //document.getElementById("usertr").style.display="table";
         document.getElementById("lasttr").style.display = "table-row";
         document.getElementById("passtr").style.display = "table-row";
         document.getElementById("repasstr").style.display = "table-row";
     }
     function deluserface() {

         document.getElementById("add").style.visibility = "hidden";
         document.getElementById("change").style.visibility = "hidden";
         document.getElementById("del").style.visibility = "visible";
         document.getElementById("passtr").style.display = "table-row";
         document.getElementById("repasstr").style.display = "none";
         document.getElementById("lasttr").style.display = "none";
         document.getElementById("space").style.display = "none";
     }
     function redirect() {
         window.location.assign("index.php");
     }
     function rededit() {
         window.location.assign("edit.php");
     }
	</script>
	<meta charset="utf-8">
</head>
<body>
<form method="post">
	<?php
		include"../url.php";
        $con=mysql_connect($url,$user,$pass,$db);
        mysql_select_db($db,$con);
		$warning="";
		session_start();
		ob_start();
		/*if(!isset($_SESSION["ok"])||$_SESSION["ok"]==false)
			header("Location:login.php");
		//$_SESSION["ok"]=false;
		if(isset($_POST["submite"])){
			$con=mysql_connect($url,"Admin","admin","db");
			$r=mysql_query("select * from db.login",$con);
			echo mysql_error();
			while($row=mysql_fetch_array($r)){
				if($_POST["user"]==$row["user"]&&$_POST["pass"]==$row["password"]){
					$_SESSION["ok"]=true;
					header("Location:index.php");
					
				}
				$warning="OK";
			}
			if($_SESSION["ok"]==false&&!($_POST["user"]==""&&$_POST["pass"]=="")){
				$warning="نام کاربری یا کلمه عبور نادرست می باشد";
				
			}
		mysql_close($con);	
		}*/
	
	?>
	<center>
	<!--<input type="button" class="karbar" onclick="adduserface()" value="کاربر جدید">&nbsp&nbsp-->
	<input type="button" class="karbar" onclick="rededit()" value="ویرایش" >&nbsp&nbsp
	<input type="button" class="karbar" onclick="redirect()" value="پنل مدیریت">
	</center>
	</br></br>
	<center>
	<div align="center" id="cntainer">
	<table align="center"  style="width:325px;vertical-align:center;margin:auto;left:5px;right:5px;top: 10px;position:absolute" id="logintable" dir=rtl>
	<tr>
		<td style="width: 170px">نام و نام خانوادگی</td>
		<td><input type="text" value="" dir="rtl" id="name" name="name" class="text" style="float:right"></td>
	</tr>
    <tr>
		<td>نام کاربری</td>
		<td><input type="text" value="" id="user" name="user" class="text" style="float:right"></td>
	</tr>
    <tr>
		<td >کلمه عبور</td>
		<td><input type="password" value="" id="pass" name="pass" class="text" style="float:right"></td>
	</tr>
    <tr>
		<td>تکرار کلمه عبور</td>
		<td><input type="password" value="" id="repass" name="repass" class="text" style="float:right"></td>
	</tr>
    <tr>
		<td>تلفن</td>
		<td><input type="text" value="" id="tel" name="tel" class="text" style="float:right"></td>
	</tr>
    <tr>
		<td >موبایل</td>
		<td><input type="text" value="" id="mobile" name="mobile" class="text" style="float:right"></td>
	</tr>
	<tr>
		<td >ایمیل</td>
		<td><input type="text" value="" id="email" name="email" class="text" style="float:right"></td>
	</tr>
    <tr>
		<td >دسترسی</td>
		<td><select  id="access" name="access" class="text" style="float:right;width: 200px">
            <option value="نویسنده">نویسنده</option>
             <option value="ویرایشگر">ویرایشگر</option>
             <option value="مدیر">مدیر</option>
            </select></td>
	</tr>
    <tr><td colspan="2">دریافت مسؤلیت تیکت از بخش</td>
    </tr>
    <tr>
    <td colspan="2">
    <div style="height: 150px;overflow-y:scroll">   
    <?php
        $rs=mysql_query("select * from parts",$con);      
        while($r=mysql_fetch_array($rs)){
            $part=$r["part"];
            echo"<div style='height:8px'><span style='float:right;font-size:13px'>".$part."</span><input type='checkbox' style='float:left;clear:left;top:0px;padding:0px' value='".$part."' name='tickets'></div>";
            echo"<br />";
        }       
    ?> 
    </div>
    </td>
    </tr>
    <tr>
    <td >توضیحات</td>
    <td><input type="text" class="text" value="" id="desc" style="height: 50px"></td>
    </tr>
	
	<tr align="center">
		<td colspan="2" style="padding-top: 20px">
		<!--<td colspan=2 align="center"><input type='button' value="حذف" name="del" onclick="deluser()" id="del"  >-->
			<input type="button" value="اضافه کردن" id="add" onclick="try{adduser()}catch(e){alert(e)}" >
		<!--	<input type="button" value="تغییر رمز" id="change" onclick="changpass()" >-->
		</td>
	</tr>
	
	</table>
     <script>
         document.getElementById("cntainer").style.height = document.getElementById("logintable").clientHeight + 20;
         
    </script>
	</div>
	</center>
	</form>
</body>
</html>