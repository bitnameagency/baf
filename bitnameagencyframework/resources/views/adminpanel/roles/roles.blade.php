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
        <input type="text" name="NewRoleKey" class="form-control" placeholder="{{ $newRoleName_text }}">
        <div class="input-group-append">
        <button name="NewRole" value="1" class="btn btn-outline-light"><i class="fa fa-plus"></i> 
		{{ $newRoleAddbutton_text }}</button>
		</div></div></div>
		@csrf
		</form>
		
			{{ $roleSelectView }}

		@php
		if(isset($_GET['roleKey'])){
		@endphp	
		<hr>
		<form method="POST"><button type="button" class="btn btn-gradient-info">{{ $selectRoleText }} <i class="fa fa-chevron-circle-right"></i> {{ $_GET['roleKey'] }}</button>
		<button name="RemoveRole" class="btn btn-gradient-danger"><i class="fa fa-trash"></i> {{ $roleDeletebutton_text }}</button>
		@csrf
		</form>		
		<div class="row">
		<div class="col-xl-6">
		<hr>
		<!--------------  Role Perm List ---------------->
		{{ $RolePermListView }}
		<!--------------  ------------ ------------------>		
		</div>
		
		<div class="col-xl-6">
		<hr>
		<!------------  Project Perm List --------------->
		{{ $ProjectPermListView }}
		<!--------------  ------------ ------------------>		
		</div>						
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