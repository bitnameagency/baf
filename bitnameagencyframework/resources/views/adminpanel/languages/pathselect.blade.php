	@php
	
	if($pathList){
	$pathCount = count($pathList) -1 ;
	}
	
	if(@$_GET['pathSelect']){
		
		$pathNow = array_search($_GET['pathSelect'], $pathList);
		
	}else{
		
		$pathNow = -1;	
		
	}
	
	
	if(@$pathList[$pathNow + 1]){
		
		$next = @$pathList[$pathNow + 1];
		
	}else{
		
		$next = @$pathList[$pathNow];
		
	}
	
	
	
	
	if(@$pathList[$pathNow - 1]){
		
		$back = @$pathList[$pathNow - 1];
		
	}else{
		
		$back = @$pathList[$pathNow];
		
	}
	
	
	@endphp
										
										<div class="form-group mb-0">
                                            <div class="input-group">                                             
                                                    <a class="input-group-prepend" href="/adminPanel/languages?languageSelect={{ $_GET['languageSelect'] }}&pathSelect={{ $back }}"><button class="btn btn-light mt-15" type="button"><i class="fa fa-chevron-left"></i> {{ $backButton }}</button></a>
                                              	<select id="pathList" aria-describedby="basic-addon2" class="form-control custom-select custom-select-lg mt-15" onchange="goTo()">
												<option value="">
												{{ $PathSelectText }}
												</option>
												@foreach($pathList as $path)
												<option value="{{ $path }}" @php if(@$_GET['pathSelect'] == $path){echo 'selected';} @endphp>{{ $path }}</option>
												@endforeach
												</select>                                             
                                                   <a class="input-group-append" href="/adminPanel/languages?languageSelect={{ $_GET['languageSelect'] }}&pathSelect={{ $next }}"><button class="btn btn-light mt-15" type="button">{{ $nextButton }} <i class="fa fa-chevron-right"></i></button></a>
                                             </div>
                                        </div>
<script>
function goTo() {
  var x = document.getElementById("pathList").value;
 window.location = '/adminPanel/languages?languageSelect={{ $_GET['languageSelect'] }}&pathSelect='+x;
}
</script>