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
								
								{{ $pathSelectView }}
									<div class="mb-20"></div>
									@php
									if(@$_GET['pathSelect']){
									@endphp
									<div class="table-wrap mb-20">
                                        <div class="table-responsive">
                                            <table class="table table-primary table-bordered mb-0">
                                                <thead class="thead-primary">
                                                    <tr>
                                                       <!-- <th>{{ $lineText }}</th> -->
                                                        <th>{{ $keyText }}</th>
                                                        <th>{{ $dataText }}</th>
                                                        <th>{{ $actionText }}</th>
                                                     
                                                    </tr>
                                                </thead>
                                                <tbody>
									@foreach($itemList as $item)
							
							
                                                    <tr>
                                                       <!-- <th scope="row">#{{ $item['sD_path_line'] }}</th>-->
															<td>{{ $item['sD_key'] }}</td>
															<td>{{ $item['sD_data'] }}</td>
															<td>
															<form method="POST">	
															 <button name="itemDelete" value="{{ $item['sD_ID'] }}" class="btn btn-icon btn-danger btn-icon-style-1"><span class="btn-icon-wrap"><i class="fa fa-trash"></i></span></button>
															 @csrf
															 </form>														
														</td>
                                                    </tr>
                                                   
                                       
							
									@endforeach
							         </tbody>
                                            </table>
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