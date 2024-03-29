<?php

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>ویرایش کاربران</title>
        <link rel="stylesheet" href="stylesuser.css">
	    <script src="jquery.js"></script>
	    <script src="scriptedit.js"></script>
        <script>
            function redirect() {
                window.location.assign("index.php");
            }
            function reduser() {
                window.location.assign("users.php");
            }
            function cancle() {
               window.location.assign("edit.php");
               
            }
        </script>
        <style>
            th{
                width: 100px;
                height: 20px;
                background: #ffffff;
                border: 1px solid black;
                padding: 2px;
            }
            table{
                margin: auto;
                right: 20px;
                left: 20px;
               
                border-collapse: collapse;
            }
            td{
                 border: 1px solid black;
            }
            input[Type="text"]{
                width: 100px;
            }
        </style>
    </head>
    <body id="mainbody">
    <form method="post">
	<?php
		include"../url.php";
        $con=mysql_connect($url,$user,$pass,$db);
        mysql_select_db($db,$con);
     ?>
    <center>
	<input type="button" class="karbar" onclick="reduser()" value="کاربر جدید" >&nbsp&nbsp
	<input type="button" class="karbar" onclick="redirect()" value="پنل مدیریت">
	</center>
	</br></br></br>
    <table dir="rtl" >
    <tr><th style="display: none"></th><th style="width: auto">ردیف</th><th style="width: auto">نام و نام خانوادگی</th><th>تلفن</th><th>موبایل</th><th>ایمیل</th><th>نام کاربری</th><th>پسورد</th><th>دسترسی</th><th style="width: 170px">مسؤل بخش</th><th style="width: auto;vertical-align: middle" >حذف<input type="checkbox" onclick="try{markallf()}catch(e){alert(e)}" id="markall" style="vertical-align: middle"></th>
    </tr>
        <?php
            $rs=mysql_query("select * from login",$con);
            $i=1;
            while($r=mysql_fetch_array($rs)){
              $name=$r["name"];
              echo"<tr><td style='display:none'><input type='text' value='".$r["id"]."' name='ai'></td><td>".$i."</td><td><input type='text' value='".$name."' name='name'></td><td><input type='text' value='".$r['tel']."' name='tel'></td><td><input type='text' value='".$r['mobile']."' name='mobile'></td><td><input type='text' value='".$r['email']."' name='email'></td><td><input type='text' value='".$r['user']."' name='user'></td><td><input type='text' value='".$r['password']."' name='pass'></td>";
              $nev='';$vir='';$mod='';
              switch($r["access"]){
                  case 'نویسنده':
                        $nev='selected';
                  break;
                  case 'ویرایشگر':
                        $vir='selected';
                  break;
                  case 'مدیر':
                        $mod='selected';
                  break;
              }
              echo"<td><select name='access' style='width:100px' ><option  value='نویسنده' ".$nev.">نویسنده</option><option value='ویرایشگر' ".$vir.">ویرایشگر</option><option value='مدیر' ".$mod.">مدیر</option></select></td>";
              echo"<td><div style='overflow-y:scroll;height:35px;font-size:13px'>";
              $user=$r['user'];
              $result1=mysql_query("select * from parts ",$con);
              
              $j=0;
              while($f=mysql_fetch_array($result1)){
                  $ticket=$f['part'];
                  echo "<table style='background-color:#ffffff;height:35px'><tr style='top:0px;height:30px'><td style='width:120px;height:30px;top:0px'>".$ticket."</td><td style='height:30px;top:0px'><input type='checkbox' value='".$ticket."' name=".$j." style='float:left;clear:left;padding-top:0px'></td></tr><tr></tr></table>";
                   $j++;
              }
              echo"<script>var partcount=".$j."</script>";
              $result1=mysql_query("select * from parts ",$con);
              $ii=0;
              $iii=$i-1;
              while($f=mysql_fetch_array($result1)){
                  $part=$f["part"];
                 $result2=mysql_query("select * from tickets where user='$user'",$con);
                 while($fetch=mysql_fetch_array($result2)){
                    if($fetch["ticket"]==$part) echo"<script>document.getElementsByName('".$ii."')[".$iii."].checked=true;</script>";
                 }
                $ii++;
              }
              echo"</div></td><td style='background-color:#ffffff'><input type='checkbox' name='delete' style='float:left'></td></tr>";
              $i++;  
            }
            mysql_close($con);
        ?>
        <tr><td colspan="8" style="border: none"></td><td colspan="2" style="border: none;padding-top: 10px"><input type="button" value="لغو" onclick="cancle()" style="width: 105px">&nbsp&nbsp&nbsp&nbsp&nbsp<input type="button" value="ویرایش" style="width: 105px" onclick="try{edit(partcount)}catch(e){alert(e)}"></td></tr>
    </table>
    
    </form>
    </body>
</html>
