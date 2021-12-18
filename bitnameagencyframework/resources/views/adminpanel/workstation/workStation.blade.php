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
							{{ $workstation_title }}					
							</h5>
                            <p class="mb-40">
							{{ $workstation_title_sub }}
							</p>
                            <div class="row">
							
							
							
                                <div class="col-sm">
								
								<div class="list-group">
								@foreach($workstationModeldataList as $data)
								@php if($data['ws_Category'] !== "engine"){ @endphp
								
								@php
								if($data['ws_Category'] == "engine"){
									
									$class = 'success';									
									
								}else{
								if($data['status'] == 1){
									
									$class = 'success';
									
								}else{
											
									$class = 'danger';		
									
								}}
								
								
								if($data['status'] == 1){
									
									$statusButtontext = $disableButtontext.' <i class="fa fa-pause"></i>';
									$statusButtontvalue = 0;
									
								}else{
									
									$statusButtontext = $enableButtontext.' <i class="fa fa-play"></i>';
									$statusButtontvalue = 1;
								}
								
								@endphp
								
							  <div class="list-group-item list-group-item-action flex-column align-items-start">
								<div class="d-flex w-100 justify-content-between">
								  <h5 class="mb-1"><button type="button" class="btn btn-{{ $class }}">{{ $data['ws_Category'] }}</button></h5>
								  <small><button type="button" class="btn btn-danger btn-xs">{{ $priority }}: {{ $data['ws_Priority'] }}</button></small>
								</div>
								<p class="mb-1">
								<form method="POST">
								<input type="hidden" name="ws_IS" value="{{ $data['ws_IS'] }}">
								<input placeholder="{{ $placeholder_title }}" style="margin:0; padding:0; height:35px; font-size:25px;" type="text" class="form-control transparent-input" name="ws_Title" value="{{ $data['ws_Title'] }}">
								<input placeholder="{{ $placeholder_desc }}" style="margin:0; padding:0; height:25px; font-size:15px;" type="text" class="form-control transparent-input" name="ws_Description" value="{{ $data['ws_Description'] }}">
								<button name="saveTitleDesc" value="1" class="btn btn-light btn-xs">{{ $save }}</button>
								@csrf
								</form>	
								@php echo $location; @endphp {{ $data['ws_Path'] }}<br>				
								</p>
							
								<form method="POST">
								<input type="hidden" name="ws_IS" value="{{ $data['ws_IS'] }}">
								<button name="status" value="{{ $statusButtontvalue }}" class="btn btn-light btn-xs"><b>{{ $statusButtontext }}</b></button>								
								<button name="delete" value="1" class="btn btn-light btn-xs">{{ $delete }}</button>
								@csrf
								</form>							
								
								
							
							  </div><br>
							 @php } @endphp	
							 @endforeach	
							</div>																
								
                                </div>
                            </div>
                        </section>

				  
                </div>
				
                </div>
                <!-- /Row -->
            </div>
            <!-- /Container -->
			
@include('adminpanel/boardfooter')