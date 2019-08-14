/********** Helper functions **********/

function setCookie(name,value,days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}
function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}
function eraseCookie(name) {   
    document.cookie = name+'=; Max-Age=-99999999;';  
}
function updateAuctionTime(el,v){
    	el.html(v);
    }
function getcd(wxy,did){
let x = setInterval(function() { 
let now = new Date().getTime(); 
let t = wxy - now; 
let days = Math.floor(t / (1000 * 60 * 60 * 24)); 
let hours = Math.floor((t%(1000 * 60 * 60 * 24))/(1000 * 60 * 60)); 
let minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60)); 
let seconds = Math.floor((t % (1000 * 60)) / 1000); 
document.getElementById(did).innerHTML = days + "d "  
+ hours + "h " + minutes + "m " + seconds + "s "; 
    if (t < 0) { 
        clearInterval(x); 
        document.getElementById(did).innerHTML = "ENDED"; 
    } 
}, 1000); 
}
function setPaymentAction(type){
	let paymentURL = "";
	
	if(type == "cod"){
		paymentURL = $("#cod-action").val();  
   }
   else if(type == "card"){
		paymentURL = $("#card-action").val();  
   }
   
   //alert(paymentURL);
   $('#checkout-form').attr('action',paymentURL);
   $('#checkout-form').submit();
}