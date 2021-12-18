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
							{{ $sectionTitle }}					
							</h5>
                            <p class="mb-40">
							{{ $sectionSub }}
							</p>
                            <div class="row">
							<div class="col-12">
		
		<form method="POST">
		<div class="form-group">
        <div class="input-group">
        <input type="text" name="NewProjectKey" class="form-control" placeholder="{{ $newProjectName_text }}">
        <div class="input-group-append">
        <button name="NewProject" value="1" class="btn btn-outline-light"><i class="fa fa-plus"></i> 
		{{ $newProjectAddbutton_text }}</button>
		</div></div></div>
		@csrf
		</form>
		
		{{ $projectSelectView }}

		@php
		if(isset($_GET['projectKey'])){
		@endphp	
		<hr>
		<form method="POST"><button type="button" class="btn btn-gradient-info">{{ $selectProject_text }} <i class="fa fa-chevron-circle-right"></i> {{ $_GET['projectKey'] }}</button>
		<button name="RemoveProject" class="btn btn-gradient-danger"><i class="fa fa-trash"></i> {{ $projectDeletebutton_text }}</button>
		@csrf
		</form>		
		<div class="row">
		<div class="col-lg-12">
		<hr>
		
		
		<form method="POST">
		<div class="form-group">
        <div class="input-group">
        <input type="text" name="NewPermKey" class="form-control" placeholder="{{ $newKeyName_text }}">
        <div class="input-group-append">
        <button class="btn btn-outline-light"><i class="fa fa-plus"></i> 
		{{ $newPermAddbutton_text }}</button>
		</div></div></div>
		@csrf
		</form>
		<hr>
		
		</div>
		@forelse($permList as $perm)			
			<div class="col-lg-4 col-md-6 col-sm-12 mb-30"> <!--  pt-30 -->
                <div class="card">
                    <div class="card-header">
					<form method="POST">
				<button value="{{ $perm['permKey'] }}" name="deletePermKey" class="btn btn-danger btn-wth-icon icon-wthot-bg btn-sm"><span class="icon-label"><i class="fas fa-trash-alt"></i> </span><span class="btn-text">{{ $permDelete_text }}</span></button>	{{ $perm['permText'] }} 
                   @csrf
				   </form>
				   </div>
                    <div class="card-body">

                        <h5 class="card-title alert alert-inv alert-inv-primary">
					
                                       {{ $perm['projectKey'] }} @ {{ $perm['permKey'] }}
                     
						</h5>
                        <p class="card-text">
						
						
						<div class="alert alert-dark alert-dismissible fade show" role="alert">Code:<br>
                           $User->permCheck("{{ $perm['projectKey'] }} @ {{ $perm['permKey'] }}");
                           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                               <span aria-hidden="true">×</span>
                           </button>
                      </div>
						
						</p>
               
                    </div>
               
                </div>
           </div>
		@empty								
										
		@endforelse							
		</div>	
		@php	
		}		
		@endphp
		
								

							</div>
                            </div>
                        </section>

				  
                </div>
				
                </div>
                <!-- /Row -->
            </div>
            <!-- /Container -->

			

			
			
@include('adminpanel/boardfooter')