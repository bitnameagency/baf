<select id="languageList" class="form-control custom-select form-control custom-select-lg mt-15" onchange="goTolanguage()">
<option>
{{ $languageSelectplaceholder }}
</option>
@foreach($languageList as $language)
<option value="{{ $language['lang_code'] }}" @php if(@$_GET['languageSelect'] == $language['lang_code']){echo 'selected';} @endphp>{{ $language['lang_name'] }}</option>
@endforeach
</select>
<script>
function goTolanguage() {
  var x = document.getElementById("languageList").value;
 window.location = '/adminPanel/languages?languageSelect='+x;
}
</script>