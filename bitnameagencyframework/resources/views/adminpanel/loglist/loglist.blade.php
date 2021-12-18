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
								
			
								
									<div class="table-wrap mb-20">
                                        <div class="table-responsive">
                                            <table class="table table-primary table-bordered mb-0">
                                                <thead class="thead-primary">
                                                    <tr>
                                                       <!-- <th>{{ $lineText }}</th> -->
                                                        <th>{{ $dateTimeText }}</th>
                                                        <th>{{ $downloadURLText }}</th>
                                           
                                                     
                                                    </tr>
                                                </thead>
                                                <tbody>
									@forelse($logList as $item)
							
							
                                                    <tr>
                                                      
															<td>{{ date('d/m/Y', $item['dateTime']) }}</td>
															<td><a href="{{ $item['downloadURL'] }}">{{ $item['downloadURL'] }}</a></td>													
                                                    </tr>
                                                   
                                    @empty   
									<tr>
                                                    
										<td>{{ $emptyText }}</td>
										<td>{{ $emptyText }}</td>
                                     </tr>
									@endforelse
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