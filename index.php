<html>
<title>سفارش و خرید</title>
<head>
	<link rel="stylesheet" type="text/css" href="styles.css" >
	<link rel="stylesheet" type="text/css" href="print.css" media="print">
 	<script language="javascript" src="admin/jquery.js"></script>
	<script language='javascript' src="scripts.js"></script>
	<script language='javascript' src="jQuery.print.js"></script>
	<script>
     var index = 1;
     var ead = "";
     function Navigate() {
         if (index > count + 1)
             index = count + 1;
         if (index < 1)
             index = 1;
         headerimage(index, count);
     }
     function readmail() {
         ead = $("#emailaddrs").val();
         
     }
	</script>
	<meta charset="utf-8">
</head>
<?php
	include"url.php";
    include"PersianCalendar.php";
	$con=mysql_connect($url,$user,$pass,$db);
	mysql_select_db($db,$con);
	$rs=mysql_query("select * from parts ",$con);
	for($i=1;$i<=mysql_num_rows($rs);$i++){
		$t=mysql_fetch_array($rs);
		$group=$t['part'];
		$tables[]=mysql_query("select * from payments where payments.group='$group' order by id",$con);
		$emails[]=mysql_query("select * from payments where payments.group='$group' order by id",$con);
	}
	$rs=mysql_query("select * from parts ",$con);
	$r=mysql_query("select * from parts",$con);
	$count=mysql_num_rows($r);
	echo"<script>var count=".$count."</script>";
	//mysql_close($con);
    
?>

<body onload="load(index,count)" >
<form>
<?php
$w=($count+1)*100;
echo'<div dir=rtl style="margin:auto;width:'.$w.'px;left:100px;right:100px; height:100px;position:absolute" align="center" >';

for($i=0;$i<$count+1;$i++){
	$f=$i*100;
	echo'<img class= header style="margin:auto;z-index:'.$i.';right:'.$f.'px;position:absolute;top:20px" src="images/flesh.png"/>';
}
echo'<table dir=rtl style="height:45px;position:absolute;margin:auto;top:20px;right:30px;z-index:76;width:'.$w.'" border=0><tr>';
$i=1;
while($row=mysql_fetch_array($r)){
	$p=$row['part'];
	echo'<td id=ht'.$i.' onclick="javascript:headerimage('.$i.','.$count.');index='.$i.';" style="cursor:pointer;width:107px;height:45px;font-size:13px;color:yellow;padding-right:5px;padding-left:5px;padding-right:5px;border:none">'.$p.'</td>';
	$i++;
}
echo'<td id=ht'.$i.' onclick="headerimage('.$i.','.$count.');index='.$i.';" style="cursor:pointer;width:107px;height:45px;border:none;font-size:13px;color:yellow">پرداخت وتحویل</td>';
echo"</tr></table>";
echo'</div>';
//$con=mysql_connect($url,"Admin","admin","db");
mysql_select_db($db,$con);	
$groups=mysql_query("select * from parts",$con);	
for($a=0;$a<$count;$a++){
$g=mysql_fetch_array($groups);
$group=$g['part'];	
$ida=$a+1;	
echo"<table name='tables' class='main' id=".$ida." dir=rtl align='center' style='visibility:hidden'><tr><th>ردیف</th><th>امکانات</th><th>تعداد</th><th>قیمت</th><th></th></tr>";
$table=mysql_query("select * from payments where payments.group='$group' order by id",$con);
	while($row=mysql_fetch_array($table)){
		if($row['istitr']=='f'||$row['istitr']=='false'){
			echo"<tr><td class='number'>".$row['number']."</td><td class='fac'>".$row['facilities']."</td><td><select name='Quantity'  onchange='checkTotal()'><option value=''></option>"; for($q=1;$q<21;$q++){echo"<option value=".$q.">".$q."</option>";} echo"</td><td  class='price' >".$row['price']."</td><td class='choice'><input type='checkbox' name='choice' onchange='checkTotal()' value=".$row['price']."></td></tr>";
		}
		else
			echo"<tr><td colspan=5 bgcolor='#0099FF' align='center'>".$row['facilities']."</td></tr>";
	}
echo"<tr><td>مبلغ کل</td><td><input id='mablaghkol' readonly='readonly' name='total' type='text' value='0' /> تومان </td><td></td><td></td><td></td></tr></table>";
}
echo'<div id="print" style="background-color:white" align="center">';
$dates=gregorian_to_mds(date("Y"),date("m"),date("d"));
		$minut=(date("i")+30) % 60;
		$hour=(date("H")+((date("i")+30)/60)+8) % 24;
		$day=$dates[2];
		if($dates[2]>6)
			if($day>30) $day=1;
		if($dates[2]<=6)
			if($day>31) $day=1;
		$date=$dates[0]."/".$dates[1]."/".$day;
$d=$count+1;
echo'<table id='.$d.' name="pardakht" class="brdr" border=0 dir=rtl style="visibility:hidden;border-collapse:collapse;td{border: 1px solid black}">';
echo'<tbody>';
echo"<tr id='trdate' style='display:none;border:none'><td colspan='2' style='background-color:white;border:none' ></td><td colspan='3' style='background-color:white;border:none;horizontal-align:left'>تاریخ:".$date."</td></tr>";
echo'<tr dir=rtl style="background:gray">';
echo'<th>ردیف</th>';
echo'<th id="fac">امکانات</th>';
echo'<th>تعداد</th>';
echo'<th style="width:30px">فی</th>';
echo'<th>قیمت</th>';
echo'</tr>';
	$cid=1;
	for($i=0;$i<mysql_num_rows($rs);$i++){
		while($row=mysql_fetch_array($tables[$i])){
			if($row['istitr']=='f'||$row['istitr']=='false')
            if($cid%2==0)
				echo"<tr dir=rtl style='background:#5fae5d'><td class='number'>".$cid++."</td><td class='fac'>".$row['facilities']."</td><td name='quantity'></td><td name='fee'></td><td name='price'></td ></tr>";
            else
                echo"<tr dir=rtl style='background:lightgreen'><td class='number'>".$cid++."</td><td class='fac'>".$row['facilities']."</td><td name='quantity'></td><td name='fee'></td><td name='price'></td ></tr>";
		}
	}
?>
<tr>
<td>
مبلغ کل
</td>
<td colspan=4>
<input id="mablaghkol" id="prc" readonly="readonly" name="total" type="text" value="0" />تومان</td>
</tr>
<tr id="trprnt" >
<td colspan=5 align=center><span id="caution" style="display: none"> قیمتها تا یک هفته پس از تاریخ فوق اعتبار دارند </span>
<input type="button" value="چاپ" id="prntbtn" style="width:200px" onclick='javascript:try{print(count);}catch(e){alert(e)}'/>
</td>
</tr>
    <tr id="tremail">
        
        <td colspan="5" id="emailtd"><span id="title">آدرس ایمیل:</span><input type="text" dir="ltr"  onchange="readmail()" id="emailaddrs" style="width: 200px">
        
    <input type="button" id="send" value="فرستادن" onclick="try{sendemail(ead)}catch(e){alert(e)}">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
    <input type="button" id="pay" onclick="payonline()" value="پرداخت آنلاین"> </td>
    </tr>
</tbody>
</table>
<?php
echo'</div>';
echo'<table id="tbl_email"  border="1" dir="rtl" style="visibility:hidden;border-collapse:collapse;td{border: 1px solid black;color:black;font-size:16px}">';
echo'<tbody>';
echo"<tr><td colspan='2' style='background-color:white;border:none' ></td><td colspan='3' style='background-color:white;border:none;horizontal-align:left'>".$date."</td></tr>";
echo'<tr dir=rtl style="background:gray">';
echo'<th>ردیف</th>';
echo'<th id="fac">امکانات</th>';
echo'<th>تعداد</th>';
echo'<th>فی</th>';
echo'<th>قیمت</th>';
echo'</tr>';
	$cid=1;
	for($i=0;$i<mysql_num_rows($rs);$i++){
		while($row=mysql_fetch_array($emails[$i])){
			if($row['istitr']=='f'||$row['istitr']=='false')
            if($cid%2==0)
				echo"<tr dir=rtl style='background:#5fae5d'><td class='number1'>".$cid++."</td><td align=center class='fac1'>".$row['facilities']."</td><td name='quantity1'></td><td name='fee1'></td><td name='price1'></td ></tr>";
            else
                echo"<tr dir=rtl style='background:lightgreen'><td class='number1'>".$cid++."</td><td align=center class='fac1'>".$row['facilities']."</td><td name='quantity1'></td><td name='fee1'></td><td name='price1'></td ></tr>";
		}
	}
?>
<tr  dir="rtl"  style="background:#5fae5d;" align="right" >
<td dir="rtl">
مبلغ کل
</td>
<td colspan=4 align="center">
<input id="mablaghkol" name="total" type="text" value="0" />تومان</td>
</tr>
</tbody>
</table>
 <?php
mysql_close($con);
?>
	<div id=buttoms style="width:100%; height:100px;top:300px;">
		<img onclick='javascript:try{--index;Navigate();}catch(e){alert(e)}' id=prv style="float:right"  src="images/prvbtnf.png"/>
		<img onclick='javascript:try{++index,Navigate();}catch(e){alert(e)}'  id=next style="float:left"  src="images/nextbtnf.png"/>
	</div>
<?php
   /* echo'<div id="email" dir="rtl" style="top:99%;width: 100%" align="center">';
    echo'<div style="position:absolute;margin: auto;right: 300px;left: 300px">آدزس ایمیل:<input type="text" id="emailaddrs" width="500px">';
    echo'<input type="button" value="فرستادن">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
            echo'<input type="button" value="پرداخت آنلاین">';
            echo'</div>';
       
    echo'</div>';*/
?>
</form>
</body>
</html>