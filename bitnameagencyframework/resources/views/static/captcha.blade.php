<script src="{{ serverName }}/bitnameagencyframework/src/js/jquery.min.js"></script>
<script src="{{ serverName }}/captcha.js"></script>
<div style="border: 1px dotted rgba(0,0,0,0.5); padding:15px" class="form-group">

	<div class="input-group">			
		<img onclick="imageChange()" class="captchaImg" style="height:35px;" src="../captcha.jpg">
		<img onclick="captchaReload();" style="height:35px;" src="../bitnameagencyframework/src/images/svg/reload.svg">
	</div>

	<div class="input-group">
		<input id="captchaInput" @php if(developerMode == true){ @endphp value="{{ captcha::ViewCode() }}" @php } @endphp style="margin-top: 1rem; text-transform:uppercase;" maxlength="4" class="form-control" placeholder="{{ $captchaPlaceholder }}" name="captcha">
	</div>
	<div style="display:none;" id="captchaCode">{{ $captchaCode }}</div>
	@php
	echo hookSystem::do_action("captchaAlert");
	@endphp
	
</div>
