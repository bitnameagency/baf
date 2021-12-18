<select id="groupKey" class="form-control custom-select form-control custom-select-lg mt-15" onchange="goTo()">
<option>
{{ $menuSelectplaceholder }}
</option>
@foreach($menuList as $groupKey)
<option value="{{ $groupKey }}" @php if($groupKey == @$_GET['groupKey']){echo 'selected';} @endphp>{{ $groupKey }}</option>
@endforeach
</select>
<script>
function goTo() {
  var x = document.getElementById("groupKey").value;
 window.location = '/adminPanel/menuSystem?groupKey='+x;
}
</script>