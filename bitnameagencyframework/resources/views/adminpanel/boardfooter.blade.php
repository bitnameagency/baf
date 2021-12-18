  <!-- Footer -->
            <div class="hk-footer-wrap container-fluid">
                <footer class="footer">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <p>Bitname Agency Framework ©2021</p>
                        </div><!--
                        <div class="col-md-6 col-sm-12">
                            <p class="d-inline-block">Follow us</p>
                            <a href="#" class="d-inline-block btn btn-icon btn-icon-only btn-indigo btn-icon-style-4"><span class="btn-icon-wrap"><i class="fa fa-facebook"></i></span></a>
                            <a href="#" class="d-inline-block btn btn-icon btn-icon-only btn-indigo btn-icon-style-4"><span class="btn-icon-wrap"><i class="fa fa-twitter"></i></span></a>
                            <a href="#" class="d-inline-block btn btn-icon btn-icon-only btn-indigo btn-icon-style-4"><span class="btn-icon-wrap"><i class="fa fa-google-plus"></i></span></a>
                        </div>-->
                    </div>
                </footer>
            </div>
            <!-- /Footer -->
        </div>
        <!-- /Main Content -->

    </div>
    <!-- /HK Wrapper -->

    <!-- jQuery -->
    <script src="{{ serverName }}/bitnameagencyframework/admin/themes/default/vendors/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ serverName }}/bitnameagencyframework/admin/themes/default/vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="{{ serverName }}/bitnameagencyframework/admin/themes/default/vendors/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Slimscroll JavaScript -->
    <script src="{{ serverName }}/bitnameagencyframework/admin/themes/default/dist/js/jquery.slimscroll.js"></script>

    <!-- Fancy Dropdown JS -->
    <script src="{{ serverName }}/bitnameagencyframework/admin/themes/default/dist/js/dropdown-bootstrap-extended.js"></script>

    <!-- FeatherIcons JavaScript -->
    <script src="{{ serverName }}/bitnameagencyframework/admin/themes/default/dist/js/feather.min.js"></script>

	@php	
	echo hookSystem::do_action("boardfooter");
	@endphp
	

    <!-- Toggles JavaScript -->
    <script src="{{ serverName }}/bitnameagencyframework/admin/themes/default/vendors/jquery-toggles/toggles.min.js"></script>
    <script src="{{ serverName }}/bitnameagencyframework/admin/themes/default/dist/js/toggle-data.js"></script>
	
	<!-- Counter Animation JavaScript -->
	<script src="{{ serverName }}/bitnameagencyframework/admin/themes/default/vendors/waypoints/lib/jquery.waypoints.min.js"></script>
	<script src="{{ serverName }}/bitnameagencyframework/admin/themes/default/vendors/jquery.counterup/jquery.counterup.min.js"></script>
	
	<!-- EChartJS JavaScript -->
    <script src="{{ serverName }}/bitnameagencyframework/admin/themes/default/vendors/echarts/dist/echarts-en.min.js"></script>

	<!-- Owl JavaScript -->
    <script src="{{ serverName }}/bitnameagencyframework/admin/themes/default/vendors/owl.carousel/dist/owl.carousel.min.js"></script>
	
	<!-- Toastr JS -->
    <script src="{{ serverName }}/bitnameagencyframework/admin/themes/default/vendors/jquery-toast-plugin/dist/jquery.toast.min.js"></script>
    
    <!-- Init JavaScript -->
    <script src="{{ serverName }}/bitnameagencyframework/admin/themes/default/dist/js/init.js"></script>
	<!-- <script src="{{ serverName }}/bitnameagencyframework/admin/themes/default/dist/js/dashboard4-data.js"></script>-->
	<script>
	@php

		echo hookSystem::do_action("script");		
		
	@endphp
	</script>
	
</body>

</html>