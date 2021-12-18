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
								<div class="col-12">
								
						
									<div class="mb-20"></div>
								
								
									<div class="table-wrap mb-20">
                                        <div class="table-responsive">
                                            <table class="table table-primary table-bordered mb-0">
                                                <thead class="thead-primary">
                                                    <tr>
                                                       <!-- <th>{{ $lineText }}</th> -->
                                                        <th>{{ $slugText }}</th>
                                                        <th>{{ $filepathText }}</th>
                                                        <th>{{ $lineText }}</th>
                                                     
                                                    </tr>
                                                </thead>
                                                <tbody>
									
									@php
									$i = 0;
									foreach($routeList['slug'] as $item){
									@endphp
							
                                        <tr>
												<td>{{ $routeList['slug'][$i] }}</td>
												<td>{{ $routeList['filepath'][$i] }}</td>
												<td>{{ $routeList['line'][$i] }}</td>													
                                        </tr>	
													                                                   
                                     @php
									 $i++;
									}
									@endphp 
							
								
							         </tbody>
                                            </table>
                                        </div>
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