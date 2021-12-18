<div class="mb-20"></div>
@forelse($rolePermList as $permList)
<div class="border-right">
	<div class="card-body">
		<div class="row">
		
			<div class="col-11">
				<div class="alert alert-inv alert-inv-primary" role="alert">
						{{ $permList['permText'] }} <br>
						{{ $permList['projectKey'] }} @ {{ $permList['permKey'] }} <br>
                </div>
			</div>
		
		
			<div class="col-1">
				<form method="POST">
				<input style="display:none;" value="{{ $permList['permID'] }}" name="permID">
				<input style="display:none;" value="{{ $permList['roleID'] }}" name="roleID">
					<button name="negativePerm" style="border:none; background-color:white;" type="submit"><i style="font-size:5em; color:#f83f37;" class="fas fa-caret-right"></i></button>
				@csrf
				</form>
			</div>			
			
		
		</div>
	</div>
</div>


@empty
{{ $emptyPerm_text }}
@endforelse
