	@section('headermenu')
	


            <div class="collapse navbar-collapse" id="navbarCollapseAlt">
			
			
		@php
		$headermenu = $this->helper('adminpanel/headermenurender');
		$headerMenu = $headermenu->groupKey("adminpanelmenu")->Render(); //key: adminpanelmenu
		@endphp
		{{ $headerMenu }}
		 
		 
                <form action="../adminPanel/search" class="navbar-search-alt">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><span class="feather-icon"><i data-feather="search"></i></span></span>
                        </div>
                        <input class="form-control" name="q" value="{{ @$_GET['q'] }}" type="search" placeholder="{{ $search_text }}" aria-label="Search">
                    </div>
                </form>
            </div>
			
			
			@endsection