@forelse($roleList as $role)


<div class="border-left">
	<div class="card-body">
		<div class="row">
			<div class="col-1">
				<form method="POST">
					<input style="display:none;" value="{{ $role['roleID'] }}" name="roleID">
					<button name="positiveRole" style="border:none; background-color:white;" type="submit"><i style="font-size:5em; color:#22af47;" class="fas fa-caret-left"></i> </button>
				@csrf
				</form>
			</div>
			
			
			<div class="col-11">
				<div class="alert alert-inv alert-inv-primary" role="alert">
						{{ $role['roleText'] }} <br>
						{{ $role['roleKey'] }} <br>
                </div>
			</div>
		</div>
	</div>
</div>


@empty
{{ $emptyRole_text }}
@endforelse

