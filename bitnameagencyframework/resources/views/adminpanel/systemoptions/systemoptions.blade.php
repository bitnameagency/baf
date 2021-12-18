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
				
							@foreach($allSystemOptions as $Option)
							<form method="POST">
						
							
							  <div class="form-group">
								<label for="exampleInputEmail1">{{ $Option['optionKey'] }}</label>
								<input type="text" class="form-control" value="{{ $Option['optionData'] }}" name="{{ $Option['optionKey'] }}">
							  </div>
							    <button class="btn btn-primary">{{ $save_text }}</button>

							<hr>
							@csrf
							</form>
							@endforeach
				
							</div>
                            </div>
                        </section>

				  
                </div>
				
                </div>
                <!-- /Row -->
            </div>
            <!-- /Container -->
			
@include('adminpanel/boardfooter')