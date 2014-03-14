/*
Wallpaper Site Script front-end javascript functions

Author: Andy Venus
Rating stars rollover by Addam M. Driver

*/

var sMax;	// Isthe maximum number of stars
var holder; // Is the holding pattern for clicked state
var preSet; // Is the PreSet value onces a selection has been made
var rated;

// AJAX for all browsers
function GetXmlHttpObject() {
    var xmlHttp = null;
    try {
        // Firefox, Opera 8.0+, Safari
        xmlHttp = new XMLHttpRequest();
    }
    catch(e) {
        //Internet Explorer
        try {
            xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch(e) {
            xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
    }
    return xmlHttp;
}

// AJAX POST FUNCTION
function AjaxPost(url, param, success_function) {
	xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Your browser doesn't support AJAX. You should upgrade it!")
        return
    }
    xmlHttp.onreadystatechange = success_function;
    xmlHttp.open("POST", url, true);
    xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xmlHttp.send(param);
}

function div(d) {
    return document.getElementById(d);
}

// Rollover for image Stars //
function rating(num){
	sMax = 0;	// Isthe maximum number of stars
	for(n=0; n<num.parentNode.childNodes.length; n++){
		if(num.parentNode.childNodes[n].nodeName == "A"){
			sMax++;	
		}
	}
	
	if(!rated){
		s = num.id.replace("_", ''); // Get the selected star
		a = 0;
		for(i=1; i<=sMax; i++){		
			if(i<=s){
				document.getElementById("_"+i).className = "on";
				holder = a+1;
				a++;
			}else{
				document.getElementById("_"+i).className = "";
			}
		}
	}
}

// For when you roll out of the the whole thing //
function off(me){
	if(!rated){
		if(!preSet){	
			for(i=1; i<=sMax; i++){		
				document.getElementById("_"+i).className = "";
			}
		}else{
			rating(preSet);
		}
	}
}

// When you actually rate something //
function rateIt(me, id, site_url){
	if(!rated){
		preSet = me;
		rated=1;
		sendRate(me, id, site_url);
		rating(me);
	}
}

// Send the rating information somewhere using Ajax
function sendRate(sel, id, site_url){
	AjaxPost(site_url+"/includes/wallpaper/ajax/add_rating.php", "id=" + id + "&rating=" + sel.title, 
			 function () {}
	)
}

// ADD/DELETE FAV WALLPAPER
function AddFav(id, typ, site_url, unfav, fav) {
	AjaxPost(site_url+"/includes/wallpaper/ajax/add_fav.php", "id=" + id, 
			 function () {}
	)
	
	if (typ == 0) {
		div('favbutton').innerHTML = '<a href="#" onclick="AddFav('+id+', 1, \''+site_url+'\', \''+unfav+'\', \''+fav+'\'); return false">'+unfav+'</a>';
	}
	else {
		div('favbutton').innerHTML = '<a href="#" onclick="AddFav('+id+', 0, \''+site_url+'\', \''+unfav+'\', \''+fav+'\'); return false">'+fav+'</a>';
	}
}


// ADD COMMENT

function AddComment(id, site_url, type) {
	if (div('the_comment').value != '') {
	div('comment_submit').disabled=true;
	div('comment_submit').value=ADDING_COMMENT+"...";
	
	thecomment = div('the_comment').value; 
	
	if (type == 'wallpaper') {
		post_url = "/includes/wallpaper/ajax/add_comment.php"
	}
	else {
		post_url = "/includes/news/ajax/news_add_comment.php"
	}
	
	AjaxPost(site_url+post_url, "comment="+thecomment+"&id="+id, 
	function () {
		if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
 			if (xmlHttp.responseText == '') {
	 			alert(COMMENT_ERROR);
 			}
 			else if (xmlHttp.responseText == '<e1>') {
	 			alert(COMMENT_WAIT);
	 			div('comment_submit').value= WALLPAPER_SUBMIT_COMMENT;
				div('comment_submit').disabled=false;
 			}
 			else {
 				if (type == 'wallpaper') {
  					var container = document.getElementById('comment_list');
  				}
  				else {
  					var container = document.getElementById('news_comment_list');
  				}
  				var new_element = document.createElement('li');
  				new_element.innerHTML = xmlHttp.responseText;
  				container.insertBefore(new_element, container.firstChild);
  				window.location.hash="1"; 
  				div('comment_submit').value= COMMENT_ADDED;
  				div('the_comment').value = '';
  				setTimeout("EnableButton()",30000);
  			}
		}
	}
	)
	}
}

// Re-enable add-comment button

function EnableButton () {
	div('comment_submit').value="Add comment";
	div('comment_submit').disabled=false;
}

function clickclear(thisfield, defaulttext) {
	if (thisfield.value == defaulttext) {
		thisfield.value = "";
	}
}
    
function clickrecall(thisfield, defaulttext) {
	if (thisfield.value == "") {
		thisfield.value = defaulttext;
	}
}

// Ajax delete comment
function DeleteComment(id, site_url) {
	AjaxPost(site_url+"/admin/includes/delete_comment.php", "id=" + id, 
			 function () {
					div('comment-' + id).style.display = 'none';
    		}
	)
}


// Ajax delete news comment
function DeleteNewsComment(id, site_url) {
	AjaxPost(site_url+"/admin/includes/delete_news_comment.php", "id=" + id, 
			 function () {
					div('comment-' + id).style.display = 'none';
    		}
	)
}

// REPORT WALLPAPER
function SendReport(id, site_url, type) {
	div('report_submit').disabled=true;
	div('report_submit').value="Reporting wallpaper...";
	
	thereport = div('the_report').value; 
	
	AjaxPost(site_url+"/includes/wallpaper/ajax/add_report.php", "report="+thereport+"&id="+id+"&type="+type, 
	function () {
	div('report_submit').disabled=true;
	div('report_submit').value="Wallpaper Reported!";
	HidePopup('ava-popup');
	}
	)
//setTimeout("toggleSlide('reportform')",1000);
}

// Window popup
function ShowJsPopup(id, url, title) {
	window.open (url,
"mywindow","menubar=1,resizable=1,width=620,height=250"); 
}

// Get the document height
function getDocHeight() {
    var D = document;
    return Math.max(
        Math.max(D.body.scrollHeight, D.documentElement.scrollHeight),
        Math.max(D.body.offsetHeight, D.documentElement.offsetHeight),
        Math.max(D.body.clientHeight, D.documentElement.clientHeight)
    );
}

// Show JS popup
function ShowPopup(id, url, title) {
	page_height = getDocHeight();
	div('overlay').style.height = page_height + 'px';
	div('overlay').style.display = 'inline';
	FadeDiv('overlay', 0, 'up', 0.5);
	
	div(id + '-title').innerHTML = title;
	div(id).style.display = 'inline';
	div('overlay').onclick = HidePopup;
	
	div(id + '-content').innerHTML = '<img src="'+SITE_URL+'/images/loader.gif" />';

	AjaxPost(url, "", 
		function () {
			if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
				div(id + '-content').innerHTML = xmlHttp.responseText;
  			}
		}
	)
}

// Hide Wallpaper Site Script JS popup
function HidePopup(id) {
	div('ava-popup').style.display = 'none';
    div('overlay').style.display = 'none';
}

// Fade a div into view
function FadeDiv(id, opacity, fade, limit) {
    	if (opacity < limit) {
       	    opacity = opacity + 0.08
        	div(id).style.opacity = opacity;
        	setTimeout('FadeDiv("' + id + '", ' + opacity + ', "up", ' + limit + ')', 10); // call doMove() in 20 msec
    	}
}

function searchSubmit(site_url, extension) {
	value = div('search_textbox').value;
	value = value.replace(' ', '+');
	window.location = site_url+'/search/'+value+extension;
}

function setScreenRes(type) {
	res = screen.width+'x'+screen.height;
	if (type == 'dd') {
	
		var dd = div('resolution');
		for (var i = 0; i < dd.options.length; i++) {
			if (dd.options[i].value === res) {
				dd.selectedIndex = i;
				break;
			}
		}

		//div('resolution').value = res;
	}
	else {
		if (div('resolution_link_'+res)) {
			div('resolution_link_'+res).style.fontWeight = 'bold';
			div('resolution_link_'+res).style.fontSize = '14px';
		}
	}
}

function gcd (a, b) {
	return (b == 0) ? a : gcd (b, a%b);
}

function getWallpaper(id, filename, display, type, ext, download) {
	if (SEO_ON != 0) {
		if (type == 'image') {
			window.open(SITE_URL+'/file/'+id+'/'+div('resolution').value+'/'+type+'/'+filename+'.'+ext,'wallpaper_preview');
		}
		else if (type == 'download') {
			location.href = SITE_URL+'/download/'+id+'/'+div('resolution').value+'/'+type+'/'+filename+'.'+ext;
		}
		else {
			window.open(SITE_URL+'/preview/'+id+'/'+div('resolution').value+'/'+filename+ext,'wallpaper_preview');
		}
	}
	else {
		dimensions = div('resolution').value.split('x');
		
		if (type == 'image') {
			window.open(SITE_URL+'/image.php?id='+id+'&width='+dimensions[0]+'&height='+dimensions[1]+'&crop='+type,'wallpaper_preview');
		}
		else if (type == 'download') {
			window.open(SITE_URL+'/image.php?id='+id+'&width='+dimensions[0]+'&height='+dimensions[1]+'&crop='+type+'&download=1','wallpaper_preview');
		}
		else {
			window.open(SITE_URL+'/wallpaper_preview.php?id='+id+'&width='+dimensions[0]+'&height='+dimensions[1],'wallpaper_preview');
		}
	}
	
	countDownload(id);
}

function countDownload(id) {
	AjaxPost(SITE_URL+'/includes/wallpaper/ajax/count_download.php', 'wallpaper_id='+id, 
		function () {}
	)
}

// Track outbound click
function LinkOut(id) {
	AjaxPost(SITE_URL+"/includes/misc/link_out.php", "id=" + id, 
			 	function () {}
		)	
}

function setResFilter() {
	setCookie('wss_resfilter', div('resolution_filter').value, 365);
	location.reload();
}

function setCookie(c_name,value,exdays) {
	var exdate=new Date();
	exdate.setDate(exdate.getDate() + exdays);
	var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
	document.cookie=c_name + "=" + c_value;
}
function getCookie(c_name) {
	var i,x,y,ARRcookies=document.cookie.split(";");
	for (i=0;i<ARRcookies.length;i++) {
		x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
		y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
		x=x.replace(/^\s+|\s+$/g,"");
		if (x==c_name) {
			return unescape(y);
		}
	}
}

// Profile page submissions & favourites
function UserWallpapers(id, type, page) {
	div('profile_'+type+'_pages').innerHTML = '<img src="'+SITE_URL+'/images/loader.gif" />';
	
	AjaxPost(SITE_URL+'/includes/profile/'+type+'.inc.php', "page="+page+"&id="+id, 
		function () {
			if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
				div('user_'+type+'_section').innerHTML = xmlHttp.responseText;
  			}
		}
	)
}