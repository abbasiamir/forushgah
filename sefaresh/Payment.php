
<?php
$con=mysql_connect($url,$user,$Pass,$db);
mysql_select_db($db,$con);
$result=mysql_query("select * from payonline",$con);
$r=mysql_fetch_array($result);  
// Your Site Settings
$MerchentID = $r["MerchentID"];// in ghesmat ra takmil nemeyed !!;
$Password = $r["password"];// in ghesmat ra takmil nemeyed !!
$PageTitle = 'سفارش خرید';
$ShowOrderNumberField = true;


$ReturnPath = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'];
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>سامانه پرداخت آنلاین <?php echo ($PageTitle) ?></title>

    <link href="css/Style.css" rel="stylesheet" type="text/css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

</head>
<body>

    <div class="AllPage">
        <div style="padding: 20px;">
                   <img src="css/Images/t_OnlinePay.png"/>
        </div>
        <table style="margin: auto;">
            <tr>
                <td valign="top">

<?php
// Form Content
$match = array("<", ">", "'");
$replace = array("&nbsp;", "&nbsp;", "&nbsp;");
if (isset ($_POST['status']) && $_POST['status'] == 100) {
		echo '<div class="Succs" >

        کاربر گرامی     :<br /><br />

عملیات پرداخت با موفقیت به پایان رسید ، اطلاعات پرداخت شما به شرح زیر می باشد :

      <br />
	  <br />
		شماره رسید : ' . $_POST['refnumber'] . '
	<br/><br />
	  <a href="http://' . $_SERVER['SERVER_NAME'] . '">مشاهده سايت ' . $PageTitle . '</a></div>';
}
else
		if (isset ($_POST['status'])) {
				echo '<div class="Error">
         	            کاربر گرامی : <br />
                        <br />
                        خطا در بازگشت از عملیت پرداخت ! در انجام پرداخت خطایی رخ داده است ( پرداخت ناموفق ) !
	                    <br /><br />
	                    <a href="http://' . $_SERVER['SERVER_NAME'] . '">مشاهده سايت ' . $PageTitle . '</a></div>';
		}
		else if (isset ($_POST['submit'])) {
						echo '<div class="FForm_bg"><div class="fform">
                            <form  action="http://merchant.parspal.com/postservice/" method="post" id="TransactionForm" >
                            <table>
                            <tr>
                            <td  style="padding-bottom:10px;" colspan="2">
                            کاربر گرامی ، صحت اطلاعات زیر را جهت پرداخت بررسی و تایید نمایید :
                            </td>
                            </tr>
                            <tr><td style="width:150px">قيمت : </td><td>' . str_replace($match, $replace, $_POST['Price']) . ' تومان</td></tr>
                            <tr><td>پرداخت کننده : </td><td>' . str_replace($match, $replace, $_POST['Paymenter']) . '</td></tr>
                            <tr><td>ايميل پرداخت کننده : </td><td>' . str_replace($match, $replace, $_POST['Email']) . '</td></tr>
                            <tr><td>موبایل پرداخت کننده : </td><td>' . str_replace($match, $replace, $_POST['Mobile']) . '</td></tr>
                            <tr><td>توضیحات خرید : </td><td>' . str_replace($match, $replace, $_POST['Description']) . '</td></tr>
                            <tr><td>شماره سفارش : </td><td>' . str_replace($match, $replace, $_POST['ResNumber']) . '</td></tr>
                            <tr><td colspan="2">جهت پرداخت با مشخصات فوق برروی دکمه اتصال به درگاه پرداخت کلیک نمایید .</td></tr>
                            <tr><td colspan="2"><input type="submit" value="اتصال به درگاه پرداخت آنلاین پارس پال"  class="sbtn"/></td></tr></table>
                            <div style="display:none">
                            <input type="hidden" id="MerchantID" value="' . $MerchentID . '" name="MerchantID"/>
                        	<input type="hidden" id="Password" value="' . $Password . '" name="Password"/>
                        	<input type="hidden" id="Paymenter" value="' . str_replace($match, $replace, $_POST['Paymenter']) . '" name="Paymenter"/>
                        	<input type="hidden" id="Email" value="' . str_replace($match, $replace, $_POST['Email']) . '" name="Email"/>
                        	<input type="hidden" id="Mobile" value="' . str_replace($match, $replace, $_POST['Mobile']) . '" name="Mobile"/>
                        	<input type="hidden" id="Price" value="' . str_replace($match, $replace, $_POST['Price']) . '" name="Price"/>
                        	<input type="hidden" id="ResNumber" value="' . str_replace($match, $replace, $_POST['ResNumber']) . '" name="ResNumber"/>
                        	<input type="hidden" id="Description" value="توضیحات : ' . str_replace($match, $replace, $_POST['Description']) . '" name="Description"/>
                        	<input type="hidden" id="ReturnPath" value="' . $ReturnPath . '" name="ReturnPath"/>
                            </div>
                        	</form></div></div>';
				}
				else {
						echo '<div class="FForm_bg"><div class="fform"><form method="post">
                                <table><tr>
                                    <td colspan="2" style="padding-bottom:10px;">
                                        کاربر گرامی جهت انجام عملیات پرداخت فرم زیر را تکمیل نمایید :
                                    </td>
                                </tr>';
						if (isset ($_GET['price']) && is_numeric($_GET['price'])) {
								echo '<tr><td>قيمت : </td><td>' . $_GET['price'] . ' تومان
	                                  <input type="hidden" name="Price" value="' . $_GET['price'] . '"/></td></tr>';
						}
						else {
								echo '<tr><td>قيمت : </td><td>
		                              <input type="text" name="Price" dir="ltr"  class="enput" id="txtPrice" style="width:100px"/> تومان</td></tr>';
						}
						echo '<tr><td>پرداخت کننده : </td><td><input type="text" name="Paymenter"  id="txtPaymenter" />&nbsp;&nbsp;<i>*</i></td></tr>' . '<tr><td>ايميل پرداخت کننده : </td><td><input type="text" dir="ltr" name="Email"  id="txtEmail" class="enput"/>&nbsp;&nbsp;<i>*</i></td></tr>' . '<tr><td>موبایل پرداخت کننده : </td><td><input type="text" dir="ltr" name="Mobile" id="txtMobile" class="enput"  maxlength="12"/>&nbsp;&nbsp;<i>*</i></td></tr>' . '<tr><td>توضیحات خرید : </td><td>';
						if (isset ($_GET['des']))
								echo str_replace($match, $replace, $_GET['des']) . '<input type="hidden" name="Description" value="' . str_replace($match, $replace, $_GET['des']) . '"/>';
						else {
								echo '<input type="text" name="Description" value="خرید "/>';
						}
						echo '</td></tr>';
						if ($ShowOrderNumberField)
								echo '<tr><td>شماره سفارش : </td><td><input type="text" name="ResNumber"/></td></tr>';
						else
								echo '<tr style="display:none"><td></td><td><input type="hidden" name="ResNumber" value="-"/></td></tr>';
						echo '<tr><td class="submit"></td><td><input type="submit" name="submit" style="font-family:tahoma" value="ادامه عمليات خريد"   class="sbtn" onclick="return Validate()"/></td></tr></table></form></div></div>';
}
?>
            <div style="text-align: center">
                <a href="http://www.parspal.com" style="font-size: 7pt; color:#D0D0D0" target="_blank">accept payment by www.parspal.com</a>
            </div>
                </td>
                <td valign="top" style="padding-right:5px;">
                    <div class="Info_acceptor">
                        <table>
                            <tr>
                               <td colspan="2">
                                <?php echo ($PageTitle) ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                   <?php echo $_SERVER['SERVER_NAME'] ?>
                                </td>
                            </tr>

                        </table>
                    </div>
                   <div  style="margin-top:12px;">

                    <a href="http://www.parspal.com" target="_blank" >
                        <img src="http://www.parspal.com/Images/Gateway/Icons/01.png" id="img" />
                    </a>
                     </div>
                </td>
            </tr>
        </table>
    </div>

   <script type="text/javascript" language="javascript">
        function Validate() {
           var _txtPaymenter = document.getElementById("txtPaymenter");
            var _txtEmail = document.getElementById("txtEmail");
            var _txtMobile = document.getElementById("txtMobile");
            var _txtPrice = document.getElementById("txtPrice");
            var atpos=_txtEmail.value.indexOf("@");
            var dotpos=_txtEmail.value.lastIndexOf(".");

            if(_txtPrice != null && _txtPrice.value == "")
            {
                alert("! کاربر گرامی لطفا مبلغ مورد نظر خود را وارد نمایید");
                _txtPrice.focus();
                return false;
            }
            else if(_txtPrice != null && _txtPrice.value.toString() != parseInt(_txtPrice.value,0).toString())
            {
                alert("! کاربر گرامی ، مبلغ وارد شده صحیح نمی باشد");
                _txtPrice.focus();
                return false;
            }
            else if (_txtPaymenter.value == "") {
                alert("! کاربر گرامی نام پرداخت کننده را وارد نمایید");
                _txtPaymenter.focus();
                return false;
            }
            else if (_txtEmail.value == "") {
                alert("! کاربر گرامی ایمیل خود را وارد نمایید");
                _txtEmail.focus();
                return false;
            }
            else if (_txtEmail.value != "" && (atpos<1 || dotpos<atpos+2 || dotpos+2 >= _txtEmail.value.length)) {
                alert("! کاربر گرامی ، ایمیل وارد شده صحیح نمی باشد");
                _txtEmail.focus();
                return false;
            }
            else if (_txtMobile.value == "") {
                alert("! کاربر گرامی شماره موبایل خود را وارد نمایید");
                _txtMobile.focus();
                return false;
            }


        }
    </script>
</body>
</html>
