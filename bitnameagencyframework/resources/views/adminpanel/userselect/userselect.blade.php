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
								<!-- ------------------------------- -->
							

									<div class="col-lg-12">
											<div class="card card-profile-feed">
                                                <div class="card-header card-header-action">
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
													<div class="d-flex align-items-center card-action-wrap">
														<div class="inline-block dropdown">
															<a class="dropdown-toggle no-caret" data-toggle="dropdown" href="#" aria-expanded="false" role="button"><i class="ion ion-ios-settings"></i></a>
															<div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(17px, 25px, 0px); top: 0px; left: 0px; will-change: transform;">
																<form method="POST">
																	<button type="button" data-toggle="modal" data-target="#userDeletemodal" class="dropdown-item"><i class="fas fa-times-circle"></i> {{ $deleteUser_text }}</button>		
																	<button type="button" data-toggle="modal" data-target="#userBannedmodal" class="dropdown-item"><i class="fas fa-ban"></i> {{ $userBanned_text }}</button>		
																@csrf
																</form>
															</div>
														</div>
													</div>
												</div>
										
									<!-- ------------- Delete Modal ---------------- -->	
									<div class="modal fade" id="userDeletemodal" tabindex="-1" role="dialog" aria-labelledby="userDeletemodal" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">{{ $deleteUser_text }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                <form method="POST">
													<div class="form-group">													
														@captcha
														<button name="userDelete" value="1" class="btn btn-primary btn-block" type="submit">{{ $deleteUser_text }}</button>
													</div>													
												</form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ $userBannedClose_text }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
									<!-- ------------- ------------ ---------------- -->

									<!-- ------------- Banned Modal ---------------- -->	
									<div class="modal fade" id="userBannedmodal" tabindex="-1" role="dialog" aria-labelledby="userBannedmodal" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">{{ $userBanned_text }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                <form method="POST">
													<div class="form-group">
														<div class="input-group">
															  <input name="bannedDay" type="number" placeholder="{{ $bannedDay_placeholder }}" id="typeNumber" class="form-control" />
														</div>
														@captcha
														<button class="btn btn-primary btn-block" type="submit">{{ $bannedButton }}</button>
													</div>													
												</form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ $userBannedClose_text }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
									<!-- ------------- ------------ ---------------- -->			
												
												<div class="row text-center">
													<div class="col-sm">
													
													{{ $deletedAlert }}
													{{ $bannedAlert }}
													
													
													</div>
												</div>
												
												<div class="row text-center">												
													<div class="col-4 border-right pr-0">
														<div class="pa-15">
															<a target="_blank" href="{{ $resetPasswordURL }}"><span class="d-block display-6 text-dark mb-5"><i class="fas fa-key"></i></span></a>
															<span class="d-block text-capitalize font-14">{{ $resetPassword_text }}</span>
														</div>
													</div>
													<div class="col-4 border-right px-0">
														<div class="pa-15">
															<a target="_blank" href="../adminPanel/userroles?userKey={{ $_GET['userKey'] }}"><span class="d-block display-6 text-dark mb-5"><i class="fas fa-user-tag"></i></span></a>
															<span class="d-block text-capitalize font-14">{{ $Roles_text }}</span>
														</div>
													</div>
													<div class="col-4 pl-0">
														<div class="pa-15">
															<a target="_blank" href="../adminPanel/sessionlist?sessionSelect=userKey&search={{ $_GET['userKey'] }}"><span class="d-block display-6 text-dark mb-5"><i class="fas fa-sign-in-alt"></i></span></a>
															<span class="d-block text-capitalize font-14">{{ $sessions_text }}</span>
														</div>
													</div>
												</div>
												<div class="card-header card-header-action">
													<h6>{{ $userOptions_text }}</h6>												
												</div>
												<ul class="list-group list-group-flush">
												
												@forelse($userOptions as $Option)
												    
													<li class="list-group-item"><span><i class="fas fa-angle-right font-18 text-light-20 mr-10"></i><span>{{ $Option['optionKey'] }}:</span></span><span class="ml-5 text-dark">{{ $Option['optionData'] }}</span></li>

												@empty
												
													<li class="list-group-item"><span><i class="fas fa-angle-right font-18 text-light-20 mr-10"></i></span>{{ $emptyOption }}</li>
													
												@endforelse
												
      
                                                </ul>
											 </div>
										
										
										
										</div>
								
								
								<!-- ------------------------------- -->
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