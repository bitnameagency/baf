	@php
	hookSystem::add_action("boardmeta", function($data){
		
		return $data.'<link href="'.serverName.'/bitnameagencyframework/admin/themes/default/vendors/datatables.net-dt/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="'.serverName.'/bitnameagencyframework/admin/themes/default/vendors/datatables.net-responsive-dt/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css" />';
		
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
                            <p class="mb-40">
							{{ $sectionSub }}
							</p>
                            <div class="row">
							<div class="col-12">
							
<!------------------------------------------------------------------------------------->

<select id="sessionList" class="form-control custom-select form-control custom-select-lg" onchange="goTo()">
<option value="">
{{ $sessionListplaceholder }}
</option>
@foreach($sessionList as $session)
<option value="{{ $session }}" @php if($session == @$_GET['sessionSelect']){echo 'selected';} @endphp>{{ $session }}</option>
@endforeach
</select>
<script>
function goTo() {
  var x = document.getElementById("sessionList").value;
 window.location = '/adminPanel/sessionlist?sessionSelect='+x;
}
</script>
<div class=" mt-15"></div>

<!------------------------------------------------------------------------------------->

@php
if(@$_GET['sessionSelect']){
@endphp
	
         
                                    <div class="table-wrap">
                                        <table id="datable" class="table table-hover w-100 pb-30">
                                            <thead>
                                                <tr>
													<th>{{ $ID_text }}</th>	
													<th>{{ $sessionKey_text }}</th>
													<th>{{ $sessionSecureKey_text }}</th>
													<th>{{ $sessionData_text }}</th>												
													<th>{{ $sessionDelete_text }}</th>												
		
												</tr>
                                            </thead>
                                            <tbody>
											@foreach($sessionListData as $session)
												
													<tr>
														<td>{{ $session['sS_ID'] }}</td>
														<td>{{ $session['sessionKey'] }}</td>
														<td>{{ $session['sessionSecureKey'] }}</td>
														<td>{{ $session['sessionData'] }}</td>
														<td>
										<form method="POST">			
										<button name="sessionIDremove" value="{{ $session['sS_ID'] }}" class="btn btn-dark btn-wth-icon icon-wthot-bg btn-rounded icon-right btn-sm"><span class="btn-text">{{ $sessionDelete_text }}</span> <span class="icon-label"> <i class="fas fa-eraser"></i></span></button>
										@csrf
										</form>
										
														</td> 
													</tr> 
											@endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
													<th>{{ $ID_text }}</th>	
													<th>{{ $sessionKey_text }}</th>
													<th>{{ $sessionSecureKey_text }}</th>
													<th>{{ $sessionData_text }}</th>
													<th>{{ $sessionDelete_text }}</th>												
													
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                             


@php
}
@endphp
<!------------------------------------------------------------------------------------->

							</div>
                            </div>
                        </section>

				  
                </div>
				
                </div>
                <!-- /Row -->
            </div>
            <!-- /Container -->
			@php
			hookSystem::add_action("boardfooter", function($data){
				
				return $data.'  <!-- Data Table JavaScript -->
    <script src="https://cdn.datatables.net/plug-ins/1.11.3/i18n/tr.json"></script>
    <script src="'.serverName.'/bitnameagencyframework/admin/themes/default/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="'.serverName.'/bitnameagencyframework/admin/themes/default/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="'.serverName.'/bitnameagencyframework/admin/themes/default/vendors/datatables.net-dt/js/dataTables.dataTables.min.js"></script>
    <script src="'.serverName.'/bitnameagencyframework/admin/themes/default/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="'.serverName.'/bitnameagencyframework/admin/themes/default/vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="'.serverName.'/bitnameagencyframework/admin/themes/default/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="'.serverName.'/bitnameagencyframework/admin/themes/default/vendors/jszip/dist/jszip.min.js"></script>
    <script src="'.serverName.'/bitnameagencyframework/admin/themes/default/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="'.serverName.'/bitnameagencyframework/admin/themes/default/vendors/pdfmake/build/vfs_fonts.js"></script>
    <script src="'.serverName.'/bitnameagencyframework/admin/themes/default/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="'.serverName.'/bitnameagencyframework/admin/themes/default/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="'.serverName.'/bitnameagencyframework/admin/themes/default/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script>
    $("#datable").DataTable({
					
			"order": [[0, "asc"]],
			        dom: "Bfrtip",
        buttons: [
            "excel", "pdf", "print"
        ],
		 columnDefs : [
   { targets: 0, type: "currency" }
  ],
    "language": {
            "url": "'.serverName.'/adminPanel/users/datatablelang.json"
        }
    });
	
	
	
$(document).ready(function() {
    $("table.display").DataTable();
} );





</script>
	';
				
			});
			@endphp
			
	<script>
	setTimeout(function(){ $('input[type="search"]').val("{{ $_GET['search'] }}").keyup(); }, 500);
	</script>
			<script>
jQuery.extend( jQuery.fn.dataTableExt.oSort, {
	"turkish-pre": function ( a ) {
		var special_letters = {
            "C": "Ca", "c": "ca", "Ç": "Cb", "ç": "cb",
            "G": "Ga", "g": "ga", "Ğ": "Gb", "ğ": "gb",
            "I": "Ia", "ı": "ia", "İ": "Ib", "i": "ib",
            "O": "Oa", "o": "oa", "Ö": "Ob", "ö": "ob",
            "S": "Sa", "s": "sa", "Ş": "Sb", "ş": "sb",
            "U": "Ua", "u": "ua", "Ü": "Ub", "ü": "ub"
            };
        for (var val in special_letters)
           a = a.split(val).join(special_letters[val]).toLowerCase();
        return a;
	},

	"turkish-asc": function ( a, b ) {
		return ((a < b) ? -1 : ((a > b) ? 1 : 0));
	},

	"turkish-desc": function ( a, b ) {
		return ((a < b) ? 1 : ((a > b) ? -1 : 0));
	}
} );
			</script>
		
			
			
@include('adminpanel/boardfooter')