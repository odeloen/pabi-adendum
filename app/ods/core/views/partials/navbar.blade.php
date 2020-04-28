<div class="pace pace-inactive">
    <div class="pace-progress" style="transform: translate3d(100%, 0px, 0px);" data-progress-text="100%"
        data-progress="99">
        <div class="pace-progress-inner"></div>
    </div>
    <div class="pace-activity"></div>
</div>

<div class="navbar navbar-inverse bg-indigo">
    <div class="navbar-header">
        {{--@if(request()->session()->get('pabi_role_id') == 4)--}}
		<a class="navbar-brand" href="{{ url('/member') }}" style="width: 100%; padding-top: 5px !important;">
			<img src="{{ asset('template/images/logo_light.png') }}" alt="" style="height: 100%;">
		</a>
		{{--@else 
		<a class="navbar-brand" href="{{ url('/admin') }}" style="width: 100%; padding-top: 5px !important;">
			<img src="{{ asset('assets/images/logo_light.png') }}" alt="" style="height: 100%;">
		</a>
        @endif--}}        
        @empty($need_sidebar)
            <ul class="nav navbar-nav pull-right visible-xs-block">
                <li><a data-toggle="collapse" data-target="#navbar-mobile" class="legitRipple"><i class="icon-tree5"></i></a></li>
                <li><a class="sidebar-mobile-main-toggle legitRipple"><i class="icon-paragraph-justify3"></i></a></li>
                @if(isset($two_sidebar)) 
                    <li><a class="sidebar-mobile-opposite-toggle"><i class="icon-menu"></i></a></li>
                @endif
            </ul>
        @endempty
    </div>
    @empty($need_sidebar)
        <div class="navbar-collapse collapse" id="navbar-mobile">
            <ul class="nav navbar-nav">
                <li>
                    <a class="sidebar-control sidebar-main-toggle hidden-xs">
                        <i class="icon-paragraph-justify3"></i>
                    </a>
                </li>
            </ul>

            <div class="navbar-right">
                    <p class="navbar-text">Selamat Datang, {{ request()->session()->get('pabi_username') }}!</p>
                    <p class="navbar-text"><span class="label bg-success-400">Online</span></p>
        
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-bell2"></i>
                                <span class="visible-xs-inline-block position-right">Activity</span>
                                {{-- <span class="status-mark border-orange-400"></span> --}}
                                <span id="bell"></span>
                            </a>
        
                            <div class="dropdown-menu dropdown-content">
                                <div class="dropdown-content-heading">
                                    Activity
                                    <ul class="icons-list">
                                        <li><a href="#"><i class="icon-menu7"></i></a></li>
                                    </ul>
                                </div>
        
                                <ul class="media-list dropdown-content-body width-350">                                    
                                </ul>
                            </div>
                        </li>
        
                    </ul>
                </div>
        </div>        
    @endempty
</div>
<script>
	$(document).ready(function() {
		function loadNotif(read = null) {
			var userId = <?= session()->get('pabi_user_id') ?>;
			$.ajax({
				url: '/member/notification',
				method: 'POST',
				data: { 
					"read": read,
					"userId": userId,
					"_token": "{{ csrf_token() }}",
				},
				dataType: 'json',
				success: function(data) {
					$('.dropdown-content-body').html(data.notification);

					if (data.unseenNotif > 0) {
						$('#bell').addClass('status-mark border-orange-400');
					} else {
						$('#bell').removeClass('status-mark border-orange-400');
					}
				}   
			})
		}

		loadNotif();

		$(document).on('click', '.dropdown-toggle', function() {
			loadNotif(1);
		});

		setInterval(() => {
			loadNotif();
		}, 30000);
	})
</script>