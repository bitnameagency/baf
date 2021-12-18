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
							<section class="col-xs-12 col-sm-6 col-md-12">
				 
			
							 @forelse($result as $article)
						<div class="mb-20"></div>

							 	<article class="search-result row">
								<div class="col-xs-12 col-sm-12 col-md-12 excerpet">
									<h3><a href="{{ $article['viewURL'] }}" title="">{{ $article['ts_sentence'] }}</a></h3>
									<p>{{ $article['viewURL'] }}<br>{{ $article['ts_path'] }}</p>						
								</div>
								<span class="clearfix borda"></span>
							</article>
							 <hr>
							 @empty
							 
							 {{ $empty_text }}
							 
							 @endforelse
					
	

       

							</section>
							</div>
                            </div>
                        </section>

				  
                </div>
				
                </div>
                <!-- /Row -->
            </div>
            <!-- /Container -->
			
@include('adminpanel/boardfooter')