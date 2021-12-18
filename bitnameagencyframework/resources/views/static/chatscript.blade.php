


function listenRoom(roomKey){	
	//alert(roomKey);
}



function realTime(){
	
	listenRoom("roomKey")
	
}





function realTimeRun(){	realTime.call(); setInterval(realTime, {{ heartbeat }});} document.addEventListener("DOMContentLoaded", function(event){realTimeRun();});
