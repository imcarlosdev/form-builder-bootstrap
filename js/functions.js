/*
==================================================================================
DEFAULT FUNCTIONS 
Las funciones son seguras, solo se invocan si no estan disponibles
==================================================================================
*/

// Minified version of isMobile included in the HTML since it's small
//https://github.com/kaimallea/isMobile
!function(a){var b=/iPhone/i,c=/iPod/i,d=/iPad/i,e=/(?=.*\bAndroid\b)(?=.*\bMobile\b)/i,f=/Android/i,g=/(?=.*\bAndroid\b)(?=.*\bSD4930UR\b)/i,h=/(?=.*\bAndroid\b)(?=.*\b(?:KFOT|KFTT|KFJWI|KFJWA|KFSOWI|KFTHWI|KFTHWA|KFAPWI|KFAPWA|KFARWI|KFASWI|KFSAWI|KFSAWA)\b)/i,i=/IEMobile/i,j=/(?=.*\bWindows\b)(?=.*\bARM\b)/i,k=/BlackBerry/i,l=/BB10/i,m=/Opera Mini/i,n=/(CriOS|Chrome)(?=.*\bMobile\b)/i,o=/(?=.*\bFirefox\b)(?=.*\bMobile\b)/i,p=new RegExp("(?:Nexus 7|BNTV250|Kindle Fire|Silk|GT-P1000)","i"),q=function(a,b){return a.test(b)},r=function(a){var r=a||navigator.userAgent,s=r.split("[FBAN");return"undefined"!=typeof s[1]&&(r=s[0]),s=r.split("Twitter"),"undefined"!=typeof s[1]&&(r=s[0]),this.apple={phone:q(b,r),ipod:q(c,r),tablet:!q(b,r)&&q(d,r),device:q(b,r)||q(c,r)||q(d,r)},this.amazon={phone:q(g,r),tablet:!q(g,r)&&q(h,r),device:q(g,r)||q(h,r)},this.android={phone:q(g,r)||q(e,r),tablet:!q(g,r)&&!q(e,r)&&(q(h,r)||q(f,r)),device:q(g,r)||q(h,r)||q(e,r)||q(f,r)},this.windows={phone:q(i,r),tablet:q(j,r),device:q(i,r)||q(j,r)},this.other={blackberry:q(k,r),blackberry10:q(l,r),opera:q(m,r),firefox:q(o,r),chrome:q(n,r),device:q(k,r)||q(l,r)||q(m,r)||q(o,r)||q(n,r)},this.seven_inch=q(p,r),this.any=this.apple.device||this.android.device||this.windows.device||this.other.device||this.seven_inch,this.phone=this.apple.phone||this.android.phone||this.windows.phone,this.tablet=this.apple.tablet||this.android.tablet||this.windows.tablet,"undefined"==typeof window?this:void 0},s=function(){var a=new r;return a.Class=r,a};"undefined"!=typeof module&&module.exports&&"undefined"==typeof window?module.exports=r:"undefined"!=typeof module&&module.exports&&"undefined"!=typeof window?module.exports=s():"function"==typeof define&&define.amd?define("isMobile",[],a.isMobile=s()):a.isMobile=s()}(this);
/*
if(  isMobile.phone ){
  alert("phone");
}
if(  isMobile.tablet ){
  alert("tablet");
}*/

if (typeof isJSON !== "function" ) {
    //Is Json
	function isJSON(str) {
	    try {
	        JSON.parse(str);
	    } catch (e) {
	        return false;
	    }
	    return true;
	}
}


if (typeof String.prototype.trunc !== "function" ) {
	//Ellipsis de texto, split, acortar
	String.prototype.trunc = 
	function(n){
	  return this.substr(0,n-1)+(this.length>n?'&hellip;':'');
	};
}
//Uso:
//var s = 'not very long';
//s.trunc(25); //=> not very long
//s.trunc(5); //=> not...



//Toggle content
//http://stackoverflow.com/questions/2155453/jquery-toggle-text
if ( !jQuery().toggleContent  ) {
	$.fn.extend({
	    toggleContent:function(a,b){
	        if(this.html()==a){this.html(b)}
	        else{this.html(a)}
	    }
	});
}
//Uso:
//$(this).toggleContent('<h1>a</h1>','<h2>b</h2>');
//<a href="#" onclick='$(this).toggleText("<strong>I got toggled!</strong>","<u>Toggle me again!</u>")'><i>Toggle me!</i></a>



//Saber si está disponible una conexión segura HTTPS
if( typeof isHttps !== "function" ){
    function isHttps(){
	    if (window.location.protocol != "https:"){
	        return false;
	    }else{
	        return true;
	    }
	}
}



if (typeof slug !== "function" ) {

	//Slug
	function slug(str){
	    // convert to lowercase (important: since on next step special chars are defined in lowercase only)
		if( typeof str==='undefined' ){

		}else{
			slugcontent = str;
			slugcontent = slugcontent.toLowerCase().trim();
			slugcontent = slugcontent.replace(/ +(?= )/g,'');//Evita multiples espacios "------"
			// convert special chars
			var   accents={a:/\u00e1/g,e:/\u00e9/g,i:/\u00ed/g,o:/\u00f3/g,u:/\u00fa/g,n:/\u00f1/g}
			for (var i in accents) slugcontent = slugcontent.replace(accents[i],i);

			var slugcontent_hyphens = slugcontent.replace(/\s/g,'-');
			var finishedslug = slugcontent_hyphens.replace(/[^a-zA-Z0-9\-]/g,'');
			finishedslug = finishedslug.toLowerCase();

			//console.log(finishedslug);
			return finishedslug;
		}
	}

}



//A href="#" return false
$(function(){
	//Prevent anchor links jumping if link only have === "#", but if ==="#section-something" link will jump to the anchor
	$(document).on('click', 'a', function(e){
	    var link_target = $(this).attr('href');
		if( link_target ==='#' ){
			e.preventDefault();	 
		}
	});

});


//Token ID
if (typeof token !== "function" ) {
	function token(){
	    var text = "";
	    var possible = "abcdefghijklmnopqrstuvwxyz0123456789";
	    for( var i=0; i < 5; i++ )
	        text += possible.charAt(Math.floor(Math.random() * possible.length));
	    return text;
	}
}


if (typeof currency !== "function" ) {
	//Format currency
	function currency(num) {
	    num = num.toString().replace(/\$|\,/g, '');
	    if (isNaN(num))
	        num = "0";
	    sign = (num == (num = Math.abs(num)));
	    num = Math.floor(num * 100 + 0.50000000001);
	    cents = num % 100;
	    num = Math.floor(num / 100).toString();
	    if (cents < 10)
	        cents = "0" + cents;
	    for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3); i++)
	        num = num.substring(0, num.length - (4 * i + 3)) + ',' +
	        num.substring(num.length - (4 * i + 3));
	    return (((sign) ? '' : '-') + '$' + num + '.' + cents);
	}
}


/*
=======================================================================
Scroll to #anchor on load
=======================================================================
*/
/*
if (typeof scrollToHash !== "function" ) {
    function scrollToElement(ele) {
        $('html, body').animate({ 
    	    scrollTop: $(ele).offset().top 
    	}, 400); 
        //$(window).scrollTop(ele.offset().top).scrollLeft(ele.offset().left);
    }
    window.onload = function(){
    	var hash = '#'+window.location.hash.substr(1); //#hash-name
    	scrollToHash(hash);
    }
}
*/