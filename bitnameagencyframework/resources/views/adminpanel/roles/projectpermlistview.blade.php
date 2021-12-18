<select id="projects" class="form-control custom-select form-control custom-select-lg mt-15" onchange="projectgoTo()">
<option value="">
{{ $projectsSelect_text }}
</option>
@foreach($projectList as $project)
<option value="{{ $project['projectKey'] }}" @php if($project['projectKey'] == @$_GET['projectKey']){echo 'selected';} @endphp>{{ $project['projectText'] }}</option>
@endforeach
</select>
<script>
function projectgoTo() {
  var x = document.getElementById("projects").value;
 window.location = '/adminPanel/roles?roleKey={{ $_GET['roleKey'] }}&projectKey='+x;
}
</script>
<div class="mb-20"></div>
@php
if(isset($_GET['projectKey'])){
@endphp

@forelse($projectPermList as $permList)



<div class="border-left">
	<div class="card-body">
		<div class="row">
			<div class="col-1">
				<form method="POST">
					<input style="display:none;" value="{{ $permList['permID'] }}" name="permID">
					<button name="positivePerm" style="border:none; background-color:white;" type="submit"><i style="font-size:5em; color:#22af47;" class="fas fa-caret-left"></i> </button>
				@csrf
				</form>
			</div>
			
			
			<div class="col-11">
				<div class="alert alert-inv alert-inv-primary" role="alert">
						{{ $permList['permText'] }} <br>
						{{ $permList['projectKey'] }} @ {{ $permList['permKey'] }} <br>
                </div>
			</div>
		</div>
	</div>
</div>


@empty
{{ $emptyPerm_text }}
@endforelse


@php
}
@endphp