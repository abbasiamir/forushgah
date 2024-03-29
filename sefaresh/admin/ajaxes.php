<?php
session_start();
ob_start();
include"../url.php";
$con=mysql_connect($url,$user,$pass,$db);
 mysql_select_db($db,$con);
if(isset($_POST["insert"])){
	$id=$_POST["id"];
	$fac=$_POST["fac"];
	$price=$_POST["price"];
	$titr=$_POST["titr"];
	$group=$_POST["group"];
	$r=mysql_query("select * from payments where payments.id >= '$id' and payments.group='$group' order by id ",$con);
	while($row=mysql_fetch_array($r)){
		if($row["number"]==1&&$row["id"]>$id)
			break;
		$filter[]=$row;
	}
	for($i=count($filter);$i>=0;$i--){
		$idf=$filter[$i]["id"];
		if($titr=='false'||$titr=='f'){
			$number2=$filter[$i]["number"]+1;
			
		}			
		else
			$number2=$filter[$i]["number"];
		mysql_query("update payments set payments.number='$number2'  where payments.id='$idf' and payments.group='$group'",$con);
	}
	$r=mysql_query("select * from payments where payments.id >= '$id' and payments.group='$group' order by id desc",$con);
	while($row=mysql_fetch_array($r)){
		$id2=$row['id']+1;
		$id3=$row["id"];
		if($row["number"]==2)
			$isone=true;
		else
			$isone=false;
		mysql_query("update payments set payments.id='$id2'  where payments.id='$id3' and payments.group='$group'",$con);
	}
	if($_POST["number"]==""){
		$number=1;
		$r=mysql_query("select * from payments where payments.id<='$id' and payments.group= '$group' order by id ",$con);
		while($row=mysql_fetch_array($r))
			if($row['istitr']=='false'||$row['istitr']=='f'){
				
				$number=$row["number"]+1;
	
			}
		if($isone)
			$number=1;
	}
	else $number=$_POST["number"];
	
	mysql_query("insert into payments values('$id','$number','$group','$fac','$price','$titr')",$con);
}
if(isset($_POST["show"])){
	$group=$_POST["group"];
	$r=mysql_query("select * from payments where payments.group='$group' order by id",$con);
	
	echo"<table dir=rtl align=center id='list'>
	<tr style='background:orange;'>
	<th class='lable' style='width:30px'>id</th>
	<th class='lable' style='width:30px'>ردیف</th>
	<th class='lable' style='width:700px'>امکانات</th>
	<th class='lable' style='width:70px'>قیمت</th>
	</tr>";
	while($row=mysql_fetch_array($r)){
		
		if($row["istitr"]=='f'||$row["istitr"]=='false')
			echo"<tr class='lable'><td align=center>".$row['id']."</td><td>".$row['number']."</td><td align=center>".$row['facilities']."</td><td>".$row['price']."</td></tr>";
		
		else
			echo"<tr><td class='lable' align=center>".$row['id']."</td><td colspan=3 align='center' bgcolor='#0099FF'><b>".$row['facilities']."</b></td></tr>";
	}
	echo"</table>";
	
}
if(isset($_POST["deleteAll"]))
{
	$group=$_POST["group"];
	mysql_query("delete from payments where payments.group='$group'",$con );
}
if(isset($_POST["delet"]))
{
	$group=$_POST["group"];
	$id=$_POST["id"];
	$response=mysql_query("select * from payments where payments.id='$id' and payments.group='$group'",$con);
	$row1=mysql_fetch_array($response);
	$titr=$row1["istitr"];
	mysql_query("delete from payments where payments.id='$id' and payments.group='$group'",$con );
	$r=mysql_query("select * from payments where payments.id > '$id' and payments.group='$group' order by id ",$con);
	$count=0;
	while($row=mysql_fetch_array($r)){
		if(($row['id']-1)>0)
			$id2=$row['id']-1;
		$id3=$row["id"];
		if(($titr=='false'||$titr=='f')&&$row1['number']<$row["number"]&&$count==0&&(($row["number"]-1)>0)){
			
				$number2=$row["number"]-1;
		}
		else {
			$number2=$row["number"];
			$count++;
		}
		mysql_query("update payments set payments.id='$id2',payments.number='$number2'  where payments.id='$id3' and payments.group='$group'",$con);
	}
}
if(isset($_POST["ave"]))
{
	$group=$_POST["group"];
	$id=1;
	$r=mysql_query("select * from payments where payments.group='$group'order by id",$con );
	while($row=mysql_fetch_array($r))
		$id=$row["id"]+1;
	echo($id);
}
if(isset($_POST["edit"])){
	$id=$_POST["id"];
	$group=$_POST["group"];
	$r=mysql_query("select * from payments where payments.group='$group' and payments.id='$id'",$con);
	$row=mysql_fetch_array($r);
	if($_POST["number"]!="")
		$number=$_POST["number"];
	else
		$number=$row["number"];
	if($_POST["fac"]!="")
		$fac=$_POST["fac"];
	else
		$fac=$row["facilities"];
	if($_POST["price"]!="")
		$price=$_POST["price"];
	else
		$price=$row["price"];
	$titr=$_POST["titr"];
	mysql_query("update payments set payments.number='$number', payments.facilities='$fac' , payments.price='$price' , payments.istitr='$titr' where payments.id='$id' and payments.group='$group'",$con);

}
if(isset($_POST["logout"])){
	session_destroy();
}
if(isset($_POST["users"])){
	$_SESSION["ok"]=true;
}
if(isset($_POST["deluser"])){
	$user=$_POST["user"];
	$pass=$_POST["pass"];
	$r=mysql_query("delete from login where login.user='$user' and login.password='$pass'",$con);
	if($r)
		echo"کاربر حذف شد";
	else
		echo"نام کاربری یا رمز عبور اشتباه است";
}
if(isset($_POST["adduser"])){
	$name=$_POST["name"];
    $user=$_POST["user"];
	$pass=$_POST["pass"];
    $tel=$_POST["tel"];
    $mobile=$_POST["mobile"];
    $email=$_POST["email"];
    $desc=$_POST["desc"];
    if(isset($_POST["chbs"]))
        $chbs=$_POST["chbs"];
    $access=$_POST["access"];
	$r=mysql_query("select * from login where login.user='$user'",$con);
	if(!mysql_fetch_array($r)){
		mysql_query("insert into login(login.name,login.user,password,login.tel,login.mobile,login.email,login.access,login.desc) values('$name','$user','$pass','$tel','$mobile','$email','$access','$desc')",$con);
        if(isset($_POST["chbs"]))
        foreach($chbs as $chb){
            mysql_query("insert into tickets values('$user','$chb')",$con);
        }
		echo "کاربر اضافه شد";
	}
	else
		echo"نام کاربری تکراری است";
}
if(isset($_POST["changuser"])){
	$user=$_POST["user"];
	$pass=$_POST["pass"];
	$lastpass=$_POST["lastpass"];
	$r=mysql_query("select * from login where login.user='$user' and login.password='$lastpass'",$con);
	if(mysql_num_rows($r)!=0){
	    mysql_query("update login set login.user='$user' , login.password='$pass' where login.user='$user' and login.password='$lastpass'",$con);
		echo"تغییر انجام شد";
	}
	else
		echo"نام کاربری یا کلمه عبور اشتباه است";
}

if(isset($_GET["nameaddpart"])){
	$pname=$_GET["nameaddpart"];
	$index=$_GET["index1"];
	if($index=="")
		mysql_query("insert into parts values('$pname') ",$con);
	else{
		$r=mysql_query(" select * from parts  ",$con);
		mysql_query("delete from parts",$con);
		for($i=0;$i<mysql_num_rows($r);$i++){
			if($i==$index)
				mysql_query("insert into parts values('$pname')",$con);
			$row=mysql_fetch_array($r);
			$name=$row["part"];
			mysql_query("insert into parts values('$name')",$con);
		}
	}
	
}
if(isset($_GET["namedelpart"])){
	$name=$_GET["namedelpart"];
	mysql_query("delete from parts where parts.part='$name'",$con);
	
}
if(isset($_PUST["addrs1"])){
    $address=$_POST["addrs"];
    $msg=$_POST["message"];
    ini_set('display_errors',1);
    $msg = wordwrap($msg, 70);
    $subject="لیست خرید شما";
    $headers = array("From: info@web-skin.ir",
    "Reply-To:  info@web-skin.ir",
    "X-Mailer: PHP/" . PHP_VERSION);
   $mail= mail($address,$subject,$msg,$headers);
   usleep(10000000);
   if($mail)
        echo("successful");
   else echo("Failed");//var_dump( error_get_last());
}
if(isset($_POST["addrs"])){
    
$r=mysql_query("select * from email where email.username='customer'",$con);
$f=mysql_fetch_array($r);
/* All form fields are automatically passed to the PHP script through the array $HTTP_POST_VARS. */
$email = $_POST["addrs"];
$subject =$f["subject"];
$message = $_POST["message"];
$msges=$_POST["msges"];
$headers = "From: <".$f["sender"]."> "."\r\n";
$headers .= 'MIME-Version:1.0' . "\r\n";
$headers .= 'Content-Type: text/html; charset=ISO-8859-1' . "\r\n";
    //"X-Mailer: PHP/" . PHP_VERSION);
/* PHP form validation: the script checks that the Email field contains a valid email address and the Subject field isn't empty. preg_match performs a regular expression match. It's a very powerful PHP function to validate form fields and other strings - see PHP manual for details. */
if (!preg_match("/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/", $email)) 
  echo "آدرس ایمیل معتبر نیست";
  //echo "<a href='javascript:history.back(1);'>Back</a>";
/*} elseif ($subject == "") {
  echo"ایمیل شما فاقد عنوان است لطفا به بخش ایمیل بروید و یک عنوان درج کنید";
}*/

/* Sends the mail and outputs the "Thank you" string if the mail is successfully sent, or the error string otherwise. */
else if  (mail($email,$subject,$message,$headers)) {
  echo "ایمیل با موفقیت ارسال شد";
} else {
  echo "امکان ارسال ایمیل  و جود ندارد";
}

$result=mysql_query("select * from login",$con);
while($r=mysql_fetch_array($result)){
    $email=$r["email"];
    $usere=$r["user"];
    $messages="";
    $reesult1=mysql_query("select * from tickets where user='$usere'",$con);
    while($rc=mysql_fetch_array($reesult1)){
        $result2=mysql_query("select * from parts",$con);
        $c=0;
        while($rc2=mysql_fetch_array($result2)){
            if($rc["ticket"]==$rc2["part"])
                $messages.=$rc["ticket"]."\r\n".$msges[$c]."\r\n";
            $c++;
        }
    }
    mail($email,$subject,$messages,$headers);
       
}
}
if(isset($_POST["savemembers"])){
    $user=$_POST["user"];
    $pass=$_POST["pass"];
    $sub=$_POST["subject"];
    $from=$_POST["from"];
    $to=$_POST["to"];
    $r=mysql_query("select * from login where login.user='$user' and login.password='$pass'",$con);
    echo mysql_error();
    if(mysql_num_rows($r)==0){
        echo"کاربر یافت نشد";
    }
    else{
        $r=mysql_query("select * from email where email.username='$user' ",$con);
        if(mysql_num_rows($r)==0){
            mysql_query("insert into email values('$user','$sub','$to','$from')",$con);
            echo"عملیات ثبت با موفقیت انجام شد";
        }
        else{
            mysql_query("update email set  email.subject='$sub', email.to='$to',email.sender='$from' where email.username='$user' ",$con);
             echo"عملیات ثبت با موفقیت انجام شد";
        }
    }

}
if(isset($_POST["savecustomer"])){
    $sub=$_POST["subject"];
    $from=$_POST["from"];
    $r=mysql_query("select * from email where email.username='customer' ",$con);
    if(mysql_num_rows($r)==0){
            mysql_query("insert into email(email.username,email.subject,email.sender) values('customer','$sub','$from')",$con);
            echo mysql_error();
            echo"عملیات ثبت با موفقیت انجام شد";
        }
        else{
            mysql_query("update email set  email.subject='$sub',email.sender='$from' where email.username='customer' ",$con);
             echo"عملیات ثبت با موفقیت انجام شد";
        }
}
if(isset($_POST["virayesh"])){
    $ids=$_POST["ids"];
    $names=$_POST["names"];
    $tels=$_POST["tels"];
    $mobiles=$_POST["mobiles"];
    $emailes=$_POST["emails"];
    $users=$_POST["users"];
    $passes=$_POST["passes"];
    $accesses=$_POST["accesses"];
    $dels=$_POST["dels"];
    if(isset($_POST["chbs"]))
        $chbs=$_POST["chbs"];
    $i=0;
    $v="false";
    $n="false";
    foreach($names as $namev){
        $idv=$ids[$i];
        $telv=$tels[$i];
        $mobilev=$mobiles[$i];
        $emailv=$emailes[$i];
        $userv=$users[$i];
        $passv=$passes[$i];
        $accessv=$accesses[$i];
        $result1=mysql_query("select login.user from login where id='$idv'",$con);
        $r=mysql_fetch_array($result1);
        $userc=$r["user"];
        mysql_query("delete  from tickets where tickets.user='$userc'",$con);
        echo mysql_error();
       mysql_query("update login set name='$namev',tel='$telv',mobile='$mobilev',email='$emailv',user='$userv',password='$passv',access='$accessv' where id='$idv'",$con);
       if(isset($_POST["chbs"]))
       foreach($chbs[$i] as $chb){
           mysql_query("insert into tickets(user,ticket) values('$userv','$chb')",$con);
       }
      
       if($dels[$i]=="true"){
           if($_SESSION["access"]=="ویرایشگر")
               $v="true";
            elseif ($_SESSION["access"]=="نویسنده"){
                if($_SESSION["user"]!=$userv)
                    $n="true";
                else{
                    mysql_query("delete from login where id='$idv'",$con);
                    mysql_query("delete from tickets where user='$userv'",$con);
                }
            }
            else{
                mysql_query("delete from login where id='$idv'",$con);
                mysql_query("delete from tickets where tickets.user='$userv'",$con);
            }
       }
       $i++;
    }
    if($v=="true")
         echo"شما قادر به حذف نمیباشید";
    else if ($n=="true")
        echo"شما فقط قادر به حذف رکورد خود می باشید"; 
    else
        echo("ویرایش انجام گرفت");
}
if(isset($_POST["pay"])){
    $merchent=$_POST["merchent"];
    $pass=$_POST["pass"];
    $result=mysql_query("select * from payonline",$con);
    $count=mysql_num_rows($result);
    if($count==0){
        mysql_query("insert into payonline(payonline.MerchentID,payonline.password) values('$merchent','$pass')",$con);
       
    }
    else{
        mysql_query("update payonline set MerchentID='$merchent',password='$pass'",$con);
    }
    echo"تنطیم انجام گرفت";
}
mysql_close($con);
?>