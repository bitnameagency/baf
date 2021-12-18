<div class="mb-20"></div>
@forelse($userRoleList as $userRole)
<div class="border-right">
	<div class="card-body">
		<div class="row">
		
			<div class="col-11">
				<div class="alert alert-inv alert-inv-primary" role="alert">
						{{ $userRole['roleText'] }} <br>
						{{ $userRole['roleKey'] }} <br>
                </div>
			</div>
		
		
			<div class="col-1">
				<form method="POST">
				<input style="display:none;" value="{{ $userRole['roleID'] }}" name="roleID">
					<button name="negativeRole" style="border:none; background-color:white;" type="submit"><i style="font-size:5em; color:#f83f37;" class="fas fa-caret-right"></i></button>
				@csrf
				</form>
			</div>			
			
		
		</div>
	</div>
</div>


@empty
{{ $emptyRole_text }}
@endforelse
