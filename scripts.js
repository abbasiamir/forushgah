function load(ref,count){
	headerimage(ref,count);
	var choices=document.getElementsByName("choice");
	var quantity=document.getElementsByName("Quantity");
	for(i=0;i<choices.length;i++){
		choices[i].checked=false;
		quantity[i].value="";
	}
	var totals=document.getElementsByName("total");
	  for(i=0;i<totals.length;i++)
	   totals[i].value = 0;
       window.scrollTop=0;
       $("#emailaddrs").val("");
       payment_email();
}
function payment(){
	var prices=document.getElementsByName("price");
	var qntity=document.getElementsByName("Quantity");
	var quantity=document.getElementsByName("quantity");
	var fees=document.getElementsByName("fee");
	var choices=document.getElementsByName("choice");
	for(i=0;i<prices.length;i++){
		if(choices[i].checked){
			prices[i].innerHTML=choices[i].value*qntity[i].value;
			fees[i].innerHTML=choices[i].value;
			quantity[i].innerHTML=qntity[i].value;
			if(qntity[i].value==""){
				quantity[i].innerHTML=1;
				prices[i].innerHTML=choices[i].value;
			}
		}
		else
			prices[i].innerHTML="----";
	}
}
function headerimage(ref,count){
	
    if(ref>count+1){
		ref=count+1;
		return;
	}
	if(ref<1){
		ref=1;
		return;
	}
	if(ref==count+1)
		payment();
	
		for(ii=1;ii<count+2;ii++){
			
			document.getElementById(ii+="").style.visibility="hidden";
			document.getElementById('ht'+ii).style.color="yellow";
			document.getElementById('ht'+ii).style.textShadow="none"
		}
	
	
		
	document.getElementById(ref+="").style.visibility="visible";
	document.getElementById('ht'+ref).style.color="black";
	document.getElementById('ht'+ref).style.textShadow="1px 1px 2px white"
}
function checkTotal() {
	var sum = 0;
	var choices=document.getElementsByName("choice");
	var quantity=document.getElementsByName("Quantity");
    for (var i = 0; i < choices.length; i++) {
		 if (choices[i].checked) {
			 if(quantity[i].value=="")
					sum = sum + parseInt(choices[i].value);
			else
				sum=sum+(parseInt(choices[i].value)*parseInt(quantity[i].value));
		}
		
    }
	 
      var totals=document.getElementsByName("total");
	  for(i=0;i<totals.length;i++)
	   totals[i].value = sum;
	   
    }
	function print(count){
		document.getElementById("print").style.backgraound="white";
		document.getElementById("prntbtn").style.visibility="hidden";
		document.getElementById("tremail").style.display="none";
        document.getElementById("emailtd").style.border="none";
        document.getElementById("trdate").style.display="table-row";
         document.getElementById("caution").style.display="block";
         //document.getElementById("print").style.height = document.getElementsByName("pardakht")[0].style.height;
         //document.getElementsByTagName("body")[0].style.backgroundColor = "white";
		/*var divToPrint=document.getElementsByClassName("brdr")[0];
   newWin= window.open("");document
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();*/
   var pr=document.getElementById(count+1);     
   jQuery.print(pr)({
	   stylesheet:"print.css",
	   addGlobalStyle:true,
	   iframe:true
   });
   document.getElementById("prntbtn").style.visibility="visible";
    document.getElementById("tremail").style.display="table-row";
     document.getElementById("emailtd").style.border="2px solid black";
     document.getElementById("trdate").style.display="none";
      document.getElementById("caution").style.display="none";
      // document.getElementsByTagName("body")[0].style.backgroundImage = "url(images/bgindex.png)";
	}
function sendemail(address){
   
    //document.getElementById("trprnt").style.visibility="hidden";
    /*document.getElementById("prntbtn").style.visibility="hidden";
    document.getElementById("title").style.visibility="hidden";
    document.getElementById("emailaddrs").style.visibility="hidden";
    document.getElementById("send").style.visibility="hidden";
   document.getElementById("pay").style.visibility="hidden";*/
    var html=document.getElementById('tbl_email').outerHTML;
    var tables1=document.getElementsByName('tables');
    var len=tables1.length;
    var htmls=new Array(len);
    for(i=0;i<len;i++){
       htmls[i]=tables1[i].outerHTML;
    }
   $.ajax({
       type:"post",
       url:"admin/ajaxes.php",
       data:{addrs:address,message:html,msges:htmls},
       error:function(request,status,error){
           alert(request.responseText);
       }
   })
    .done(function(txt){ 
       if(txt=="successful")
        alert("ایمیل با موفقیت ارسال شد");
        else alert(txt);
        /* document.getElementById("prntbtn").style.visibility="visible";
   document.getElementById("title").style.visibility="visible";
    document.getElementById("emailaddrs").style.visibility="visible";
   document.getElementById("send").style.visibility="visible";
   document.getElementById("pay").style.visibility="visible"; */ 
   }) ;
   //document.getElementById("trprnt").style.visibility="visible";
   
}
function payment_email(){
	var prices=document.getElementsByName("price1");
	var qntity=document.getElementsByName("Quantity");
	var quantity=document.getElementsByName("quantity1");
	var fees=document.getElementsByName("fee1");
	var choices=document.getElementsByName("choice");
	for(i=0;i<prices.length;i++){
		if(choices[i].checked){
			prices[i].innerHTML=choices[i].value*qntity[i].value;
			fees[i].innerHTML=choices[i].value;
			quantity[i].innerHTML=qntity[i].value;
			if(qntity[i].value==""){
				quantity[i].innerHTML=1;
				prices[i].innerHTML=choices[i].value;
			}
		}
		else
			prices[i].innerHTML="----";
	}
}
function payonline(){
   var pric=document.getElementsByName("total")[0].value;
   
   window.location.replace("Payment.php?price="+pric+"&des=HostingPlan1");
}