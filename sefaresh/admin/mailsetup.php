<?php
  
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>تنظیم ایمیل</title>
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
        <script>
            var type = "members";
            function customer() {
                document.getElementById("name").style.visibility = "hidden";
                document.getElementById("pass").style.visibility = "hidden";
                document.getElementById("to").style.visibility = "hidden";
                type = "customer"
            }
            function members() {
                document.getElementById("name").style.visibility = "visible";
                document.getElementById("pass").style.visibility = "visible";
                document.getElementById("to").style.visibility = "visible";
                type = "members"
            }
            function save() {
                if (type == "members") {
                    $.ajax({
                        type: "post",
                        url: "ajaxes.php",
                        data: { savemembers: true, user: document.getElementById("user").value, pass: document.getElementById("password").value,
                            subject: document.getElementById("sub").value, from: document.getElementById("from").value, to: document.getElementById("reciver").value
                        }
                    }).done(function (txt) {
                        alert(txt);
                        
                    });
                    $("#user").val("");
                    $("#password").val("");
                    $("#sub").val("");
                    $("#from").val("");
                    $("#reciver").val("");
                }
                if (type == "customer") {
                    $.ajax({
                        type: "post",
                        url: "ajaxes.php",
                        data: { savecustomer: true, subject: document.getElementById("sub").value, from: document.getElementById("from").value }
                    }).done(function (txt) {
                        alert(txt);
                    });
                    $("#sub").val("");
                    $("#from").val("");
                }
            }
        </script>
    </head>
    <body style="background: url(../images/bgadmin.png)" onload="customer()">
        <!--<center><span onclick="members()" style="cursor:pointer;font: bold 20px arial;color: blue" >ایمیل به اعضا</span>  |   <span onclick="customer()" style="cursor:pointer;font: bold 20px arial;color: blue" >ایمیل به مشتری</span></center>-->
        <br><br><br><br><br>
        <table align="center">
        <tr id="name"><td><input type="text" id="user" value="" ></td><td>نام کاربر</td></tr>
         <tr id="pass"><td><input type="password" id="password" value="" ></td><td>رمز عبور</td></tr>
         <tr id="subject"><td><input type="text" id="sub" value="" ></td><td>عتوان ایمیل</td></tr>
         <tr id="sender"><td><input type="text" id="from" value=""></td><td>آدرس فرستنده</td></tr>
         <tr id="to"><td><input type="text" id="reciver" value=""></td><td>آدرس گیرنده</td></tr>
         <tr><td><input type="button" style="width: 157px" value="درج" onclick="save()"></td><td></td></tr>
        </table>
    </body>
</html>
