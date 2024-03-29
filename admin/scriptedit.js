function markallf(){
    var checked = document.getElementById("markall").checked;
    alert(checked);
    var del=document.getElementsByName("delete");
    for (i = 0; i < del.length; i++)
        if (checked)
            del[i].checked = true;
        else
            del[i].checked = false;
}
function edit(partcount){
    var idsc = document.getElementsByName("ai");
    var namesc = document.getElementsByName("name");
    var telsc = document.getElementsByName("tel");
    var mobilesc = document.getElementsByName("mobile");
    var emailsc = document.getElementsByName("email");
    var usersc = document.getElementsByName("user");
    var passesc = document.getElementsByName("pass");
    var accessesc = document.getElementsByName("access");
    var delsc = document.getElementsByName("delete");
    var chbgs=new Array();
    for(i=0;i<partcount;i++){
        chbgs[i] = document.getElementsByName(i); 
    }
    var len = document.getElementsByName(0).length;
    var chbs = new Array(len);
    if (partcount != 0) {
        var k = 0;
        var chbs1 = new Array();
        for (j = 0; j < len; j++) {
            k = 0;
            for (i = 0; i < partcount; i++) {
                chbs1 = new Array();
                if (chbgs[i][j].checked) {
                    k++;
                }
            }
            chbs[j] = new Array();
            var a = 0;
            for (i = 0; i < partcount; i++)
                if (chbgs[i][j].checked)
                    chbs[j][a++] = chbgs[i][j].value;
            if (k == 0)
                chbs[j][0] = "";
        }
    }
    for (i = 0; i < len;i++ ){
        if (chbs[i].length == 0)
            chbs[i][0] = "";
    }
        var l = namesc.length;
     var ids = new Array();
    for (i = 0; i < l;i++ ){
        ids[i]=idsc[i].value;
    }
    var names = new Array();
    for (i = 0; i < l;i++ ){
        names[i]=namesc[i].value;
    }
    var tels = new Array();
    for (i = 0; i < l;i++ ){
        tels[i]=telsc[i].value;
    }
    var mobiles = new Array();
    for (i = 0; i < l;i++ ){
        mobiles[i]=mobilesc[i].value;
    }
    var emails = new Array();
    for (i = 0; i < l;i++ ){
        emails[i]=emailsc[i].value;
    }
     var emails = new Array();
    for (i = 0; i < l;i++ ){
        emails[i]=emailsc[i].value;
    }
     var users = new Array();
    for (i = 0; i < l;i++ ){
        users[i]=usersc[i].value;
    }
     var passes = new Array();
    for (i = 0; i < l;i++ ){
        passes[i]=passesc[i].value;
    }
     var accesses = new Array();
    for (i = 0; i < l;i++ ){
        e=accessesc[i];
        accesses[i] = e.options[e.selectedIndex].value;
    }
     var dels = new Array();
    for (i = 0; i < l;i++ ){
        dels[i]=delsc[i].checked;
    }
    $.ajax({
        type: "post",
        url: "ajaxes.php",
        data: { virayesh: true,ids:ids, names: names, tels: tels, mobiles: mobiles, emails: emails, users: users, passes: passes, accesses: accesses, dels: dels, chbs: chbs }
    }).done(function (message) {
        alert(message);
        window.location.assign("edit.php");
    });
}