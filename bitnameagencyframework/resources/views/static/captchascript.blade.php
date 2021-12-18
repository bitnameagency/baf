
	function captchaCode(){
		
		
		$.getJSON('/captchaRefresh', function(data) {
		
			captchaRefresh(data['code']);
		
		});	
		
	}

	function captchaReload(){		
			
		$.getJSON('/captchaReload', function(data) {			
			
			captchaRefresh();
			
		});
		
	}

	function captchaRefresh(code = null){
		
		captchaCodeDIV =  document.getElementById("captchaCode");
		var currentCode = captchaCodeDIV.innerHTML;		
		
		if(code == null){
			
			captchaCode();
			
		}else{
			
			if(currentCode !== code){
				
			<?php if(developerMode == true){
			?>
			
			/************************/
				
				$.getJSON('/viewCode', function(data) {	
				
				document.getElementById("captchaInput").value = data['viewCode'];
				
				});
				
			/************************/	
				
			<?php
			} 
			?>
						
				
				captchaCodeDIV.innerHTML = code;
				
				var cusid_ele = document.getElementsByClassName('captchaImg');
				for (var i = 0; i < cusid_ele.length; ++i) {
					var item = cusid_ele[i];  
					item.src += "";
				}
				
				
			}
		
			
			
		}
		
		
		
	}
	
	function imageChange(){
		
		var cusid_ele = document.getElementsByClassName('captchaImg');
		for (var i = 0; i < cusid_ele.length; ++i) {
			var item = cusid_ele[i];  
			item.src += "";
		}		
		
	}
	

	

	setInterval(function(){  captchaRefresh(); }, {{ heartbeat }});
