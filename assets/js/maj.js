
var notifications = setInterval(function(){
	var xhr;
	if(window.XMLHttpRequest){
		xhr = new XMLHttpRequest();
	}else if(window.ActiveXObject){
		xhr = new ActiveXObject('Microsoft.XMLHTTP');
	}

	xhr.open('GET', noti, true);
	xhr.send(null);
	
	xhr.onreadystatechange = function(){
		if(xhr.readyState == xhr.DONE && xhr.status == 200){
			var pageCon=xhr.responseText;
			document.getElementById("notifications").innerHTML = pageCon;
			// console.log(pageCon);
		}
	}
}, 1000);


var nbNotifications = setInterval(function(){
	var xhr;
	if(window.XMLHttpRequest){
		xhr = new XMLHttpRequest();
	}else if(window.ActiveXObject){
		xhr = new ActiveXObject('Microsoft.XMLHTTP');
	}
	
	xhr.open('GET', nbNoti, true);
	xhr.send(null);
	
	xhr.onreadystatechange = function(){
		if(xhr.readyState == xhr.DONE && xhr.status == 200){
			var pages=xhr.responseText;
			document.getElementById("nbNotifications").innerHTML = pages;
			// console.log(pages);
		}
	}
}, 1000);
