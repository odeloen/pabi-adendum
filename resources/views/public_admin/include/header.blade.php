<div class="page-header page-header-default">
	<!-- <div class="page-header-content"> -->
		<!-- <div class="page-title"> -->
			<div class="breadcrumb-line">
			@if(request()->session()->get('pabi_role_id') == 4)
				<ul class="breadcrumb">
					<li><a href="{{ url('/member') }}"><i class="icon-home2 position-left"></i> Home</a></li>
					<li class="active"> 
						@if (session()->has('nama_menu_header'))
					    	{{ session()->get('nama_menu_header') }}
					    @else
					    	Dashboard
					    @endif 
					</li>
				</ul> 
			@else 
				<ul class="breadcrumb">
					<li><a href="{{ url('/admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
					<li class="active">
						@if (session()->has('nama_menu_header'))
					    	{{ session()->get('nama_menu_header') }}
					    @else
					    	Dashboard
					    @endif 
					</li>
				</ul>
			@endif
				
			</div>
		<!-- </div> -->
		
	<!-- </div> -->

</div>