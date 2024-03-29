<?php
  
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>تنظیم حساب کاربری</title>
        <style>
            td{
             padding: 10px; 
            }
           input{
                width: 150px;
                border-radius: 5px;
                height: 25px;
            }
        </style>
        <script language="javascript " type="text/javascript" src="jquery.js"></script>
        <script language="javascript " type="text/javascript" src="scripts.js"></script>
    </head>
    <body style="background: url(../images/bgadmin.png)" onload="customer()">
        <!--<center><span onclick="members()" style="cursor:pointer;font: bold 20px arial;color: blue" >ایمیل به اعضا</span>  |   <span onclick="customer()" style="cursor:pointer;font: bold 20px arial;color: blue" >ایمیل به مشتری</span></center>-->
        <br><br><br><br><br>
        <table align="center">
        <tr id="name"><td><input type="text" id="merchent" value="" ></td><td>مرچنت آی دی</td></tr>
         <tr id="pass"><td><input type="password" id="password" value="" ></td><td>رمز</td></tr>
         <tr><td><input type="button" style="width: 157px" value="درج" onclick="savemerchent()"></td><td></td></tr>
        </table>
    </body>
</html>
