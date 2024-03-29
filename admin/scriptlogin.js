function deluser(){
	
	var user1=$("#user").val();
	var pass1=$("#pass").val();
	if(user1==""||pass1==""){
		alert("لطفا تمامی قسمت ها را پر کنید");
		return;
	}
	$.ajax({
		type:"post",
		url:"ajaxes.php",
		data:{deluser:true,user:user1,pass:pass1}
	})
	.done(function(text){
		alert(text);
	});
	$("#user").val("");
	$("#pass").val("");
}
function adduser(){
     
	var user1=$("#user").val();
	
	var pass1=$("#pass").val();
	var repass1=$("#repass").val();
    var name=$("#name").val();
    var tel=$("#tel").val();
    var mobile=$("#mobile").val();
    var email=$("#email").val();
    var desc=$("#desc").val();
    var e =document.getElementById("access");
    var access = e.options[e.selectedIndex].value;
	if(user1==""||pass1==""||repass1==""||name==""||tel==""||mobile==""||email==""){
		alert("لطفا تمامی قسمت ها را پر کنید");
		return;
	}
	if(pass1!=repass1){
		alert("تکرار کلمه عبور اشتباه است");
		return;
	}
	var checkboxes = document.getElementsByName("tickets");
	
    var chbs=new Array();
    var j = 0;
    for(i=0;i<checkboxes.length;i++){
        if(checkboxes[i].checked)
            chbs[j++] = checkboxes[i].value;
        
     }
     if (chbs.length == 0)
         chbs[0] = "";
         $.ajax({
             type: "post",
             url: "ajaxes.php",
             data: { adduser: true, user: user1, pass: pass1, name: name, tel: tel, mobile: mobile, email: email, desc: desc, chbs: chbs, access: access }
         })
	.done(function (text) {
	    alert(text);

	});
	$('#name').val("");
	$("#user").val("");
	$("#pass").val("");
	$("#repass").val("");
    $('#tel').val("");
    $('#mobile').val("");
    $('#email').val("");
    $('#desc').val("");
    for (i = 0; i < checkboxes.length; i++)
        checkboxes[i].checked = false;
    document.getElementById("access").selectedIndex = 0;
}
function changpass(){
	var user1=$("#user").val();
	var pass1=$("#pass").val();
	var repass1=$("#repass").val();
	var lastpass=$("#lastpass").val();
	if(user1==""||pass1==""||repass1==""||lastpass==""){
		alert("لطفا تمامی قسمت ها را پر کنید");
		return;
	}
	if(pass1!=repass1){
		alert("تکرار کلمه عبور اشتباه است");
		return;
	}
	$.ajax({
		type:"post",
		url:"ajaxes.php",
		data:{changuser:true,user:user1,pass:pass1,lastpass:lastpass}
	})
	.done(function(text){
		alert(text);
	});
	$("#user").val("");
	$("#pass").val("");
	$("#repass").val("");
	$("#lastpass").val("");
}