<form method="POST">
<input placeholder="{{ $New_Password_placeholder }}" name="New_Password">
<input placeholder="{{ $TryNew_Password_placeholder }}" name="TryNew_Password">
	@php
	echo hookSystem::do_action("resetPasswordAlert");
	@endphp
@captcha
<button> {{ $changePassword_button }} </button>
</form>