@php
	hookSystem::add_action("boardmeta", function(){
		
		return '<link href="'.serverName.'/bitnameagencyframework/admin/themes/default/vendors/nestable2/dist/jquery.nestable.min.css" rel="stylesheet" type="text/css" />';
		
	});
	@endphp	
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
					   <p class="mb-25">
					   {{ $sectionSub }}
						</p>
					   <div class="row">
						<div class="col-sm">
							<form method="POST">
							<div class="form-group">
                                            <div class="input-group">
                                                <input type="text" name="NewgroupKey" class="form-control" placeholder="{{ $new_menu_placeholder }}" >
                                                <div class="input-group-append">
                                                <button name="NewMenu" value="1" class="btn btn-outline-light"><i class="fa fa-plus"></i> 
												{{ $new_menu_button }}
												</button>
												@csrf
												</form>
						
                                                </div>
                                            </div>
                                        </div>
							
							
							{{ $menuselect }}	

						@php
						if(!empty($_GET['groupKey'])){
							 
							 echo '<hr><form method="POST"><button type="button" class="btn btn-gradient-info">'.$selectedMenu.' <i class="fa fa-chevron-circle-right"></i> '.$_GET['groupKey'].'</button>
							
							<button name="RemoveMenu" value="'.$_GET['groupKey'].'" class="btn btn-gradient-danger"><i class="fa fa-trash"></i> '.$deleteMenu.'</button>
							@csrf
							</form>
							 <div class="pb-30"></div>
							 ';
							@endphp
							<div class="container">
		
		
									<div class="row">
										<div class="col">
											@include('adminpanel/menusystem/nestable')
										</div>
										<div class="col">										
											@include('adminpanel/menusystem/menuitemadd')										
										</div>
									</div>
															
									
				
						   </div>
	@php
							}
							@endphp
                            </div>
							
                        </section>
						
						</div>
						
						</div>
                <!-- /Row -->
            </div>
            </div>
            <!-- /Container -->
			
			@php
			hookSystem::add_action("boardfooter", function(){
				
				return '<script src="'.serverName.'/bitnameagencyframework/admin/themes/default/vendors/nestable2/dist/jquery.nestable.min.js"></script>';
				
			});
			@endphp
			
@include('adminpanel/boardfooter')