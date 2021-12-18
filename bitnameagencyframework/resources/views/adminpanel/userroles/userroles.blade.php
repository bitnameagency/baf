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
							@if($_GET['userKey'])
							<div class="media align-items-center">
								<div class="media-img-wrap d-flex mr-10">
									<div class="avatar avatar-sm">
										<img src="{{ serverName }}/bitnameagencyframework/src/images/png/avatar.png" alt="user" class="avatar-img rounded-circle">
									</div>
								</div>
								<div class="media-body">
								
									<div style="text-transform:none !important;" class="text-capitalize font-weight-500 text-dark">{{ $userData['loginInput'] }}</div>
									<div style="text-transform:none !important;" class="font-13">{{ $userData['userKey'] }}</div>
								</div>
							</div>
							
							<!-- ---------------------------------------------- -->
							
							<div class="row">
							<div class="col-xl-6">
							<hr>
							<!--------------  User Role List ---------------->
							{{ $userRoleListView }}
							<!--------------  ------------ ------------------>		
							</div>
							
							<div class="col-xl-6">
							<hr>
							<!------------  Role List --------------->							
							{{ $roleListView }}
							<!--------------  ------------ ------------------>		
							</div>						
							</div>	
												
							
							<!-- ---------------------------------------------- -->
							@else
								
								@php header("Location: /adminPanel/users"); @endphp
								
							@endif
						</div>
                    </div>
				</section>

				  
                </div>				
                </div>
                <!-- /Row -->
            </div>
            <!-- /Container -->

			
			
@include('adminpanel/boardfooter')