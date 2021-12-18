<form method="POST">
<div class="form-group">
<h5 class="hk-sec-title">{{ $item_add_title }}</h5>
<input name="itemKey" type="text" class="form-control"  placeholder="{{ $itemKey_Placeholder }}"><div class="pb-5"></div>    
<input name="itemLink" type="text" class="form-control"  placeholder="{{ $itemLink_Placeholder }}"><div class="pb-5"></div>    
<select name="itemTarget" class="form-control custom-select ">
<option selected="">{{ $itemTarget }}</option>
<option value="_self">_self</option>
<option value="_blank">_blank</option>                                                
<option value="_parent">_parent</option>
<option value="_top">_top</option>
<option value="framename">framename</option>  
</select><div class="pb-5"></div>    
<button name="item_add_button" value="1" type="submit" class="btn btn-success float-right">{{ $item_add_button }}</button>
</div>
@csrf
</form>

