<select id="pathList" class="form-control custom-select form-control custom-select-lg mt-15" onchange="goTo()">
<option>
{{ $pathListplaceholder }}
</option>
@foreach($pathList as $path)
<option value="{{ $path }}" @php if($path == @$_GET['pathSelect']){echo 'selected';} @endphp>{{ $path }}</option>
@endforeach
</select>
<script>
function goTo() {
  var x = document.getElementById("pathList").value;
 window.location = '/adminPanel/savedisk?pathSelect='+x;
}
</script>