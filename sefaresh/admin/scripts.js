function insert(){
	var id1=$("#id").val();
	var number1=$("#number").val();
	var fac1=$("#facilities").val();
	var price1=$("#price").val();
	var titr1=document.getElementById("titr").checked;
	var groups=document.getElementById("group");
	var name=$('select#group option:selected').text();
	if((id1==""||fac1==""||price1=="")&&!titr1){
		document.getElementById("warning").innerHTML="<h4 align=center>لطفا تمامی قسمت ها را پر کنید</h4>";
		return;
	}
	else
		document.getElementById("warning").innerHTML="";
	$.ajax({
		type:"post",
		url:"ajaxes.php",
		data:{insert:true,id:id1,number:number1,fac:fac1,price:price1,titr:titr1,group:name},
		
	
	})
	.done(function(text){
		show();
	});
	$("#facilities").val("");
	$("#price").val("");
	$("#number").val("");
	document.getElementById('titr').checked=false;
	
}
function show(){
	
	var groups=document.getElementById("group");
	var name=$('select#group option:selected').text();
	$.ajax({
		type:"post",
		url:"ajaxes.php",
		data:{show:true,group:name},
})
	.done(function(html){
		document.getElementById("list").innerHTML=html;
	});
	available();
}
function deleteAll(){
	var groups=document.getElementById("group");
	var name=$('select#group option:selected').text();
	$.ajax({
		type:"post",
		url:"ajaxes.php",
		data:{deleteAll:true,group:name},
})
.done(function(){
	show();
});

}
function delet(){
	var id1=$("#id").val();
	var groups=document.getElementById("group");
	var name=$('select#group option:selected').text();
	$.ajax({
		type:"post",
		url:"ajaxes.php",
		data:{delet:true,id:id1,group:name},
})
.done(function(){
	show();
});

}
function available(){
	var groups=document.getElementById("group");
	var name=$('select#group option:selected').text();
	$.ajax({
		type:"post",
		url:"ajaxes.php",
		data:{ave:true,group:name},
})
.done(function(id){
	$("#id").val(id);
});
}
function edit(){
	var id1=$("#id").val();
	var number1=$("#number").val();
	var fac1=$("#facilities").val();
	var price1=$("#price").val();
	var groups=document.getElementById("group");
	var name=$('select#group option:selected').text();
	var titr1=document.getElementById("titr").checked;
	$.ajax({
		type:"post",
		url:"ajaxes.php",
		data:{edit:true,id:id1,number:number1,fac:fac1,group:name,price:price1,titr:titr1}
	})
	.done(function(){
		show();
	});
	$("#facilities").val("");
	$("#price").val("");
	$("#number").val("");
	document.getElementById('titr').checked=false;
}
function logout(){
	$.ajax({
		type:"post",
		url:"ajaxes.php",
		data:{logout:true}
	})
	.done(function(){
		window.location.assign("../index.php");
		
	});
	alert("شما با موفقیت خارج شدید");
	
	
}
function users(){
	$.ajax({
		type:"post",
		url:"ajaxes.php",
		data:{users:true}
	})
	.done(function(){
		window.location.assign("users.php");
		
	});
	
}
function adpart(){
	var name1=$('#part2add').val();
	var indx=$("#indx").val();
	//var indxname=document.getElementById("partscombo").options[indx].text;
	if(name1=="") return;
	$.ajax({
		type:"get",
		url:"ajaxes.php",
		data:{nameaddpart:name1,index1:indx},
}).done(function(){
	//alert("عمل درج انجام شد");
	document.getElementById("adminform").submit();
});
	
	
}
function delpart(){
	var name=$('select#partscombo option:selected').text();
	$.ajax({
		type:"GET",
		url:"ajaxes.php",
		data:{namedelpart:name},
		})
	.done(function(val){
		//alert("عمل حذف صورت گرفت");
		document.getElementById("adminform").submit();
	});
	
}
function home(){
	window.location.assign("../index.php");
}
function savemerchent(){
    var merchent=$("#merchent").val();
    var pass=$("#password").val();
    if(merchent==""||pass==""){
        alert("لطفا تمامی قسمت ها را پر کنید");
        return;
    }
    $.ajax({
        type:"post",
        url:"ajaxes.php",
        data:{pay:true,merchent:merchent,pass:pass}
    }).done(function(text){
        alert(text);
        $("#merchent").val("");
        $("#password").val("");
    });
}