<select id="projects" class="form-control custom-select form-control custom-select-lg mt-15" onchange="goTo()">
<option>
{{ $projectSelect_text }}
</option>
@foreach($projectList as $project)
<option value="{{ $project['projectKey'] }}" @php if($project['projectKey'] == @$_GET['projectKey']){echo 'selected';} @endphp>{{ $project['projectText'] }}</option>
@endforeach
</select>
<script>
function goTo() {
  var x = document.getElementById("projects").value;
 window.location = '/adminPanel/projects?projectKey='+x;
}
</script>