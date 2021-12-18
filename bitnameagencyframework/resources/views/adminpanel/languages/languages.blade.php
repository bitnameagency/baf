@include('adminpanel/boardmeta')
@include('adminpanel/boardheadermenu')
@include('adminpanel/boardheader')

        <!-- Main Content -->
        <div class="hk-pg-wrapper">
			<!-- Container -->
            <div class="container-fluid mt-xl-50 mt-sm-30 mt-15">
				<!-- Row -->
                <div class="row">
				<div class="col-xl-12">
				
			
				<section class="hk-sec-wrapper">
					   <h5 class="hk-sec-title">
					   {{ $sectionTitle }} {{ $debugView }}
						</h5>
						
						
						
					
						
						
						
					   <p class="mb-25">
					   {{ $sectionSub }}
						</p>
					   <div class="row">
						<div class="col-12">
							<form method="POST">
							<div class="form-group">
                            <div class="input-group">
                                <input type="text" name="NewLanguageName" class="form-control" placeholder="{{ $NewLanguage_placeholder }}" >
                                <div class="input-group-append">
                                <button name="NewLanguage" value="1" class="btn btn-outline-light"><i class="fa fa-plus"></i> 
								{{ $NewLanguage_button }}
								</button>
								@csrf
								</form>
						
                                </div>
                            </div>
                        </div>
							{{ $languageselect }}	

						@php
					if(!empty($_GET['languageSelect'])){
						@endphp							
						<!-- düzenlenecek -->
						
						
			<hr><form method="POST"><button type="button" class="btn btn-gradient-info">{{ $selectedLanguageText }} <i class="fa fa-chevron-circle-right"></i> {{ $selectedLanguage }}</button>
				
				<button name="RemoveLanguage" value="{{ $selectedLanguageID }}" class="btn btn-gradient-danger"><i class="fa fa-trash"></i> {{$deleteLanguageText}}</button>
				<button class="btn btn-gradient-warning" type="button" data-toggle="collapse" data-target="#languageEdit" aria-expanded="true" aria-controls="languageEdit">
				<i class="fa fa-edit"></i> {{ $languageEditbutton_text }} 
             </button>
				@csrf
				</form>
				   
                      </div>
                   
				 
				
			
				<div class="container">		

					<div class="row">
					
						<div class="col-12">
						
						
						<div class="pb-15"></div>
				   	<!-- collapse start -->	
				   <div class="collapse" id="languageEdit">
                          <div class="card card-body">

									<form method="POST">
										<div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">{{ $lang_name_text }}</span>
                                                </div>
                                                <input name="lang_name" value="{{ $lang_name_value }}" type="text" class="form-control">                                           
                                            </div>										
                                        </div>
									
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">{{ $lang_code_text }}</span>
                                                </div>
                                                <input name="lang_code" value="{{ $lang_code_value }}" type="text" class="form-control">                                           
                                                <input style="display:none;" name="old_lang_code" value="{{ $lang_code_value }}">                                           
                                            </div>										
                                        </div>   <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">{{ $lang_flag_text }}</span>
                                                </div>
                                                <input name="lang_flag" value="{{ $lang_flag_value }}" type="text" class="form-control">                                           
                                            </div>										
                                        </div>   
										<button name="lang_update" class="btn btn-success float-right"> {{ $lang_update_text }} </button>
										@csrf                                   
								   </form>

                          </div>
                      </div>
				<!-- collapse finish -->		
		
									
                      </div>	
						</div>
				</div>
	<!-- tablo basla -->
	
	
	
                                <div class="col-12">
                                    <div class="table-wrap">
									{{ $pathselect }}							
								
									
									<p><br></p>
									
									@php
									if(@$_GET['pathSelect']){
									@endphp
									
                                        <div class="table-responsive">
                                            <table class="table table-hover table-bordered mb-0">
                                                <thead>
                                                    <tr>
													
													 <th>{{ $action_text }}</th>   
													 <th>{{ $sentence_text }}</th>   
													<th>{{ $key_text }}</th>													 
                                                        <th>{{ $line_text }}</th>
                                                        
                                                                                                           
                                                   
                                                    </tr>
                                                </thead>
                                                <tbody>
												
												
					@foreach($sentenceList as $sentence)	

					<?php
					$translators = new translators;
					$sentenceCheck = $translators->sentence()->check([
					"lang_codeorlang_ID" => $_GET['languageSelect'],
					"ts_path" => $_GET['pathSelect'],
					"ts_path_line" => $sentence['ts_path_line'],
					"ts_key" => $sentence['ts_key']
					]);	
					
					$divID = $sentence['ts_ID'];
					
					if(@$sentenceCheck['ts_ID']){					
						
						
						$sentenceID = @$sentenceCheck['ts_ID'];
						$sentenceValue = @$sentenceCheck['ts_sentence'];						
						$sentenceUpdateClass = '';
						$sentenceNewClass = ' display:none; ';
						
					}else{
						
						$sentenceID = '';
						$sentenceValue = '';
						$sentenceUpdateClass = ' display:none; ';;
						$sentenceNewClass = '';
		
						
					}
					$fileReader = urlencode(encryptData(json_encode([
					"pathSelect" => $_GET['pathSelect'],
					"pathLine" => $sentence['ts_path_line'],
					"ts_key" => $sentence['ts_key'],
					"ts_sentence" => $sentence['ts_sentence'],
					"ts_ID" => $sentence['ts_ID']
					
					])));
					?>
					
					<tr>
					 <td><div class="form-group">	
					 <form method="POST">	
					 <button name="sentenceDelete" value="{{ $sentenceID }}" class="btn btn-icon btn-danger btn-icon-style-1"><span class="btn-icon-wrap"><i class="fa fa-trash"></i></span></button>
					 @csrf
					 </form></div>
					<div class="form-group"><a target="_blank" href="{{ serverName }}{{ $sentence['viewURL'] }}"><button value="{{ $sentenceID }}" class="btn btn-icon btn-primary btn-icon-style-1"><span class="btn-icon-wrap"><i class="fa fa-eye"></i></span></button></a></div>
					
					 </td>
					 
					 <td>
					<script> 
					window.addEventListener('load', function () {
					sentenceStatus("{{ serverName }}/adminPanel/fileReader?hash={{ $fileReader }}&random={{ rand(111111111,999999999) }}", "innerID_{{ $divID }}");
					});
					 </script>
					 <div id="innerID_{{ $divID }}">...</div>
						@php
						if($sentenceValue){
							
							$inputColor = '#28a745';
							
						}else{
							
							$inputColor = '#dc3545';
							
						}
						@endphp
							<div id="ID_{{$divID}}" class="alert alert-info" role="alert">{{ $sentence['ts_sentence'] }}</div>
							
							<form style="{{ $sentenceNewClass }}" method="POST">							
							<div class="form-group">							
								<div class="input-group">
									<input style="display:none;" name="divID" type="text" value="{{ $divID }}" class="form-control" placeholder="{{ $sentence_text }}">
									<input style="display:none;" name="ts_path_line" type="text" value="{{ $sentence['ts_path_line'] }}" class="form-control" placeholder="{{ $sentence_text }}">
									<input style="display:none;" name="ts_key" type="text" value="{{ $sentence['ts_key'] }}" class="form-control" placeholder="{{ $sentence_text }}">
									<div style="background-color: {{ $inputColor }}; width:10px;"></div><input style="border: 3px solid {{ $inputColor }};" name="ts_sentence" type="text" value="{{ $sentenceValue }}" class="form-control" placeholder="{{ $sentence_text }}">
									<div class="input-group-append">
										<button name="sentenceNew" class="btn btn-outline-light"><i class="fa fa-plus"></i> {{ $saveText }}</button>						
									</div>
								</div>							
							</div>	
							@csrf
							</form>						
							
							<form style="{{ $sentenceUpdateClass }}" method="POST">							
							<div class="form-group">							
								<div class="input-group">
									<input style="display:none;" name="divID" type="text" value="{{ $divID }}" class="form-control" placeholder="{{ $sentence_text }}">
									<input style="display:none;" name="ts_ID" type="text" value="{{ $sentenceID }}" class="form-control" placeholder="{{ $sentence_text }}">
									<div style="background-color: {{ $inputColor }}; width:10px;"></div><input style="border: 3px solid {{ $inputColor }};" name="ts_sentence" type="text" value="{{ $sentenceValue }}" class="form-control" placeholder="{{ $sentence_text }}">
									<div class="input-group-append">
										<button name="sentenceUpdate" class="btn btn-outline-light"><i class="fa fa-plus"></i> {{ $saveText }}</button>						
									</div>
								</div>							
							</div>	
							@csrf
							</form>

						</td>
						<td>{{ $sentence['ts_key'] }}</td>
						<td>#{{ $sentence['ts_path_line'] }}</td>
						
                        
						 
                       
						
						 
					</tr>
                    @endforeach                          
                                                  
                                               
                                            
                                                </tbody>
                                            </table>
                                        </div>
										
										@php
											}
										@endphp
										
                                    </div>
                                </div>
                     	<!-- tablo bitir -->
				
				 
			<!-- düzenlenecek bitti -->			
				@php
				}
				@endphp
              </div>
				
          </section>


	  
  </div>
	
  </div>
  <!-- /Row -->
   </div>
   <!-- /Container -->
   
<script>
function sentenceStatus(url, innerHTML){
	
$.getJSON(url, function(data) {
	
	if(data['status'] == true){
	document.getElementById(innerHTML).innerHTML = '<button class="btn btn-icon btn-success"><span class="btn-icon-wrap"><i class="fa fa-thumbs-up"></i></span></button> Code: '+data['lineData']+'<hr>';
	}else if(data['status'] == "warning"){
	document.getElementById(innerHTML).innerHTML = '<button class="btn btn-icon btn-warning"><span class="btn-icon-wrap"><i class="fa fa-exclamation"></i></span></button> Code: '+data['lineData']+'<hr>';
	}else{		
	document.getElementById(innerHTML).innerHTML = '<button class="btn btn-icon btn-danger"><span class="btn-icon-wrap"><i class="fa fa-times-circle"></i></span></button> Code: '+data['lineData']+'<hr>';
	}

   
});

}
</script>
                         
    
			
@include('adminpanel/boardfooter')