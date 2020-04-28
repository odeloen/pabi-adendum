<?php
$role_superadmin = array(1);
$role_pusat = array(1, 2);
$role_cabang = array(1, 3);
$role_admin = array(1, 2, 3);
?>
<?php
include(app_path('ods/utils/helpers/DoesURLExists.php'));
?>
<div class="sidebar sidebar-main sidebar-default  ">
    <div class="siebar-fixed">
        <div class="sidebar-content">
            <!-- User menu -->
            <div class="sidebar-user-material">
                <div class="category-content">
                    <div class="sidebar-user-material-content">
						<?php
						if (does_url_exists(env('URL_API_IP') . request()->session()->get('pabi_image_compress')) == 1 && !empty(request()->session()->get('pabi_image_compress'))) {
							?>
							<a href="{{env('URL_API_IP')}}{{ request()->session()->get('pabi_image')}}" target="_blank">
								<img src="{{env('URL_API_IP')}}{{ request()->session()->get('pabi_image_compress')}}"
								     class="img-circle img-responsive" alt="">
							</a>
							<?php
						} else {
							if (request()->session()->get('pabi_gender') == 'P') {
								?>
								<a href="#" class="display-inline-block content-group-sm">
									<img src="{{ asset('assets/images/profile_member/member_pr.png') }}"
									     class="img-circle img-responsive" alt="" style="width: 110px; height: 110px;">
								</a>
								<?php
							} else {
								?>
								<a href="#" class="display-inline-block content-group-sm">
									<img src="{{ asset('assets/images/profile_member/deafult_profile.png') }}"
									     class="img-circle img-responsive" alt="" style="width: 110px; height: 110px;">
								</a>
								<?php
							}
						}
						?>
						<!-- <a href="#">
							<img src="{{ asset('assets/images/profile_member/deafult_profile.png') }}" class="img-circle img-responsive" alt="">
						</a> -->
						<h6>{{ request()->session()->get('pabi_username') }}</h6>
						<span class="text-size-small">
							{{ request()->session()->get('pabi_role_name') }}
							@if ((request()->session()->get('pabi_cabang_nama')))
								@if (!empty(request()->session()->get('pabi_cabang_nama')))
									<br>
									<b>{{ request()->session()->get('pabi_cabang_nama') }}</b>
								@endif
							@endif
						</span>
					</div>

                    <div class="sidebar-user-material-menu menu_profile">
                        <a href="#user-nav" data-toggle="collapse" class="legitRipple collapsed" aria-expanded="false"><span>My account</span> <i class="caret"></i><span class="legitRipple-ripple" style="left: 67.8571%; top: 57.1429%; transform: translate3d(-50%, -50%, 0px); width: 282.843%; opacity: 0;"></span><span class="legitRipple-ripple" style="left: 67.8571%; top: 57.1429%; transform: translate3d(-50%, -50%, 0px); width: 282.843%; opacity: 0;"></span></a>
                    </div>
                </div>

                <div class="navigation-wrapper menu_profile collapse" id="user-nav" aria-expanded="false" style="height: 1px;">
                    <ul class="navigation">
						@if(request()->session()->get('pabi_role_id') != 4)
						<li class="menu_profile"><a href="{{ url('admin/myprofile') }}"><i class="icon-user-plus"></i>
								<span>My profile</span></a></li>
						@endif
						@if(request()->session()->get('pabi_role_id') == 4)
						<li class="menu_profile"><a href="{{ url('member/myprofile') }}"><i class="icon-user-plus"></i>
								<span>My profile</span></a></li>
						@endif
						<li class="logout"><a href="{{ url('logout/auth') }}"><i class="icon-switch2"></i>
								<span>Logout</span></a></li>
					</ul>
                </div>
            </div>
            <!-- /user menu -->


            <!-- Main navigation -->
            <div class="sidebar-category sidebar-category-visible">
                <div class="category-content no-padding">
                    <ul class="navigation navigation-main navigation-accordion">

                        <!-- Main -->
                        <li class="navigation-header"><span>Main</span> <i class="icon-menu" title="" data-original-title="Main pages"></i></li>
                        @include('Ods\Core::partials.sidebar-kodig')
						<!-- /page kits -->
						@if(in_array(request()->session()->get('pabi_role_id'), [1,2]))
							<li>
								<a href="#"><i class="icon-coins"></i>
									<span>Iuran</span></a>
								<ul>
									<li class="dashboard"><a href="{{route('admin.master.list')}}" class="legitRipple"><span>Master Iuran</span></a></li>
									<li class="dashboard"><a href="{{route('admin.tuition.verification.list')}}" class="legitRipple"><span>Verifikasi Iuran</span></a></li>
									<li class="dashboard"><a href="{{route('admin.tuition.history')}}" class="legitRipple"><span>Histori Iuran</span></a></li>
								</ul>
							</li>
							<li>
								<a href="#"><i class="icon-display"></i>
									<span>Pembelajaran Online</span></a>
								<ul>
									{{-- <li class="dashboard"><a href="{{route('admin.category.list')}}" class="legitRipple"><span>Master Data</span></a></li> --}}
									<li class="dashboard"><a href="{{route('admin.submission.list')}}" class="legitRipple"><span>Pengajuan Kelas</span></a></li>
								</ul>
							</li>
						@endif
						@if(request()->session()->get('pabi_role_id') == 4 && request()->session()->get('pabi_pusat_verif') == 2)
							<li class="dashboard"><a href="{{route('member.tuition.list')}}" class="legitRipple"><i class="icon-coins"></i> <span>Pembayaran Iuran</span></a></li>
							<li>
								<a href="#"><i class="icon-coins"></i>
									<span>Pembelajaran Online</span></a>
								<ul>
									<li class="dashboard"><a href="{{route('member.course.search')}}" class="legitRipple"><span>Cari Kelas</span></a></li>
									<li class="dashboard"><a href="{{route('member.course.list')}}" class="legitRipple"><span>Kelas yang Diikuti</span></a></li>
									<li class="dashboard"><a href="{{route('lecturer.course.list')}}" class="legitRipple"><span>Kelola Kelas</span></a></li>
								</ul>
							</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
