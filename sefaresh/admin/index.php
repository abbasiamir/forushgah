<html>
<head>
	<title>ادمین</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
	<script language="javascript " type="text/javascript" src="scripts.js"></script>
	<script language="javascript " type="text/javascript" src="jquery.js"></script>
	<meta charset="utf-8">
	<script>
	jQuery(document).ready(function(){
	show();
	});
</script>
</head>
<body >
	<?php
		session_start();
		ob_start();
		if(!isset($_SESSION["ok"])||$_SESSION["ok"]==false)
			echo"<script>window.location.replace('login.php')</script>";
		//$_SESSION["ok"]=false;
	?>
	<form method="post" id="adminform">
	<input type="button" class="header_b" value="صفحه اصلی" onclick="home()" />&nbsp&nbsp
	<input type="button" class="header_b" onclick="users()" value="کاربران"/>&nbsp&nbsp
    <input type="button" class="header_b" onclick="window.location.assign('paysetup.php')" value="تنظیم پرداخت"  />&nbsp&nbsp
     <input type="button" class="header_b"  onclick="window.location.assign('mailsetup.php')" value="تنطیم ایمیل"  />
	<input type="button" class="header_b"  onclick="logout()" style="float:right" value="خروج"  />
    
	</br></br>
	<center><table dir=rtl id="partst">
	<tr>
	<td class="lable" style="font:bold 16px byekan;color:#f3f3f3;text-shadow:0 0 2px #000;margin-bottom:10px;">مدیریت سر دسته ها:</td>
	</tr>
	<tr>
	<td>
	<?php
	include"../url.php";
	$con=mysql_connect($url,$user,$pass,$db);
	mysql_select_db($db,$con);
	$r=mysql_query("select * from parts",$con);
	echo '<select id="partscombo" style="width:150px">';
	$i=0;
	while($row=mysql_fetch_array($r))
	{
		$p=$row['part'];
		echo $p;
		echo'<option value='.$i.'>'.$p.'</option>';
		$i++;
	}
	
	echo'</select>';
	?>
	</td>
	<td><input type="button" class="header_d" onclick="try{delpart()}catch(e){alert(e)}" value="حذف" /></td>
	<td><input type="text" id="part2add" width="50px"/></td>
	<td style="font:11px byekan">ایندکس</td>
	<td><input type="text" id="indx" style="width:30px"/></td>
	<td><input type="button" class="header_d" onclick="adpart()" value="درج" /></td>
	</tr>
	</table></center>
	</br>
	<table dir=rtl align="center" id="fields">
	<tr>
	<td class="lable">نام قسمت
	<?php
	$r=mysql_query("select * from parts",$con);
	echo '<select id="group" name="group" style="width:120px" onchange="show()">';
	while($row=mysql_fetch_array($r))
	{
		$p=$row['part'];
		echo $p;
		echo'<option value='.$p.'>'.$p.'</option>';
	}
	
	echo'</select>';
	?>
	
	</td>
	<td class="lable">id</td>
	<td><input style="width:30px" type="text" id="id" name="id"></td>
	<td class="lable">ردیف</td>
	<td><input type="text" id="number" style="width:30px"></td>
	<td class="lable">امکانات</td>
	<td colspan=2><input type="text" width=200 id="facilities" name="facilities" style="width:450px"></td>
	<td class="lable">قیمت</td>
	<td><input type="text" style="width:70px" id="price" name="price"></td> 
	<td class="lable" align=center>تیتر<input type="checkbox" id="titr" name="titr"></td>
	</tr>
	<tr style="height:20px"></tr>
	<tr>
		<td colspan=6></td>
		<td  ><input type="button" value="حذف همه" onclick='deleteAll()' style="float:left;width:80px" class="header_e"></td>
		<td style="width:90px"><input type="button" value="حذف" onclick="delet()"  style="float:left;width:80px" class="header_e"></td>
		<td colspan=2 align=center><input type="button" value="ویرایش" onclick="edit()" style="width:80px" class="header_e"></td>
		<td  ><input type="button" value="درج" onclick="insert()" style="float:left;width:80px" class="header_e"></td>
	</tr>
	<tr><td colspan=8>
	<span id="warning" class="lable"></span></td>
	</tr>
	</table>
	</br>
	<table dir=rtl align="center" id="list">
	<tr style="background:orange;">
	<th class="header" style="width:30px">id</th>
	<th class="header" style="width:30px">ردیف</th>
	<th class="header" style="width:700px">امکانات</th>
	<th class="header" style="width:70px">قیمت</th>
	</tr>
	</table>
	</br></br>
	
	</form>
</body>
</html>