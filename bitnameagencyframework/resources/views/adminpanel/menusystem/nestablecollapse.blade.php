<div class="input-group">
<p>
  <a class="btn btn-outline-success btn-rounded btn-xs" data-toggle="collapse" href="#{{ $collapseID }}" role="button" aria-expanded="false" aria-controls="{{ $collapseID }}">
	<i class="fa fa-edit"></i>
	{{ $edit_item_button }}
  </a>
<div style="width:5px;"></div>
  <form method="POST">  
  <button value="{{ $ID }}" name="delete-item" class="btn btn-outline-danger btn-rounded btn-xs" ><i class="fa fa-trash"></i> 
	  {{ $delete_item_button }}
  </button>
    @csrf
  </form>
  
</p></div><div class="pb-10"></div>
<div class="collapse" id="{{ $collapseID }}">
<div class="card card-body">
<form method="POST">
<div class="form-group">
<div class="alert alert-warning alert-dismissible fade show" role="alert">                                    
{{ $collepseNote }}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
 <span aria-hidden="true">×</span>
</button>
</div>

<input value="{{ $itemKey }}" name="itemKey" type="text" class="form-control"  placeholder="{{ $Collapse_itemKey }}"><div class="pb-5"></div>    
<input value="{{ $itemLink }}" name="itemLink" type="text" class="form-control"  placeholder="{{ $Collapse_itemLink }}"><div class="pb-5"></div>    
<input style="display:none;" value="{{ $ID }}" name="childrenID" type="text" class="form-control"><div class="pb-5"></div>    
<select name="itemTarget" class="form-control custom-select ">
<option @php if($itemTarget == "_self"){echo ' selected="" ';} @endphp value="_self">_self</option>
<option @php if($itemTarget == "_blank"){echo ' selected="" ';} @endphp value="_blank">_blank</option>                                                
<option @php if($itemTarget == "_parent"){echo ' selected="" ';} @endphp value="_parent">_parent</option>
<option @php if($itemTarget == "_top"){echo ' selected="" ';} @endphp value="_top">_top</option>
<option @php if($itemTarget == "framename"){echo ' selected="" ';} @endphp value="framename">framename</option></select>
<div class="pb-5"></div>    
<button name="childrenEditbutton" value="1" type="submit" class="btn btn-primary">{{ $childrenEditbutton }}</button>
 </div>
@csrf
</form>
</div>
</div>