	
	<button class="btn btn-danger btn-rounded btn-xs" data-toggle="modal" data-target="#debugModal"><i class="fas fa-redo"></i> {{ $debugText }}</button>

						
						<div class="modal fade" id="debugModal" tabindex="-1" role="dialog" aria-labelledby="debugModal" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">{{ $debugText }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p style="text-align:center; font-size:50px; color:#28a745;" id="debugModalinner">
													
													<i onclick="debugStart()" class="fas fa-play"></i><br>
													{{ $startText }}
													
													</p>												
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ $closeText }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
									
									<script>						
									
									function debugStart(){
										
										document.getElementById("debugModalinner").innerHTML = '<i class="fas fa-spinner"></i><br>{{ $loadingText }}';
																			
										$.getJSON('/adminPanel/debugStart', function(data) {
											
											if(data['status'] == true){
												
												document.getElementById("debugModalinner").innerHTML = '<i class="fas fa-clipboard-check"></i><br>{{ $successText }}';
												 setTimeout(function () {
																														window.location.reload("Refresh")
											window.location.reload("Refresh")

												}, 1000); 
											}
											
										});
										
									}
									
									</script>