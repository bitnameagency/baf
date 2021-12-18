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
				  @php
				  echo hookSystem::do_action("boardWidgetAlert"); 
				  @endphp

				 <section class="hk-sec-wrapper">
                            <h5 class="hk-sec-title">
							{{ $boardWidget }}
							</h5>
                            <p class="mb-40">
							{{ $boardWidgetSub }}
							</p>
                            <div class="row">
                                <div class="col-sm">
                                    <div class="row">
                                     
									@php
									echo hookSystem::do_action("boardWidget"); 
									@endphp
                                  
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