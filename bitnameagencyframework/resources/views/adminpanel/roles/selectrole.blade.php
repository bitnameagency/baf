<select id="roles" class="form-control custom-select form-control custom-select-lg mt-15" onchange="goTo()">
<option value="">
{{ $roleSelect_text }}
</option>
@foreach($roleList as $role)
<option value="{{ $role['roleKey'] }}" @php if($role['roleKey'] == @$_GET['roleKey']){echo 'selected';} @endphp>{{ $role['roleText'] }}</option>
@endforeach
</select>
<script>
function goTo() {
  var x = document.getElementById("roles").value;
 window.location = '/adminPanel/roles?roleKey='+x;
}
</script>