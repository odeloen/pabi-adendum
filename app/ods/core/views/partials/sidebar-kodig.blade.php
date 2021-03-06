<ul class="navigation navigation-main navigation-accordion">

	@if(request()->session()->get('pabi_role_id') != 4)
	<li class="dashboard"><a href="{{ url('/admin') }}"><i class="icon-home4"></i>
			<span>Dashboard</span></a></li>
	@if(request()->session()->get('pabi_role_id') == 1)
	<li>
		<a href="#"><i class="icon-person"></i> <span>Master Admin</span></a>
		<ul>
			<li class="master_admin_pusat"><a href="{{ url('/admin/master_admin_pusat') }}">Master
					Admin Pusat</a></li>
			<li class="master_admin_cabang"><a href="{{ url('/admin/master_admin_cabang') }}">Master
					Admin Cabang</a></li>
		</ul>
	</li>
	@endif
	@if(request()->session()->get('pabi_role_id') == 10)
	<li>
		<a href="#"><i class="icon-people"></i> <span>Master Member</span></a>
		<ul>
			<li class="master_member_belum_verif">
				<a href="{{ url('/admin/master_member_belum_verif') }}">Member Belum Verif</a>
			</li>
			<li class="master_member_sudah_verif">
				<a href="{{ url('/admin/master_member_sudah_verif') }}">Member Sudah Verif</a>
			</li>
		</ul>
	</li>
	@endif
	@if(in_array(request()->session()->get('pabi_role_id'), $role_pusat))
	<?php
	$pabi_member_verif_belum = request()->session()->get('pabi_member_verif_belum');
	$pabi_member_verif_setuju = request()->session()->get('pabi_member_verif_setuju');
	$pabi_member_verif_tolak = request()->session()->get('pabi_member_verif_tolak');
	
	if (empty($pabi_member_verif_belum)) {
		$pabi_member_verif_belum = 0;
	}
	if (empty($pabi_member_verif_setuju)) {
		$pabi_member_verif_setuju = 0;
	}
	if (empty($pabi_member_verif_tolak)) {
		$pabi_member_verif_tolak = 0;
	}
	
	?>
	<li>
		<a href="#"><i class="icon-people"></i>
			@if(!empty($pabi_member_verif_belum))
			<span class="badge bg-primary">
				{{$pabi_member_verif_belum}}
			</span>
			@endif
			<span>
				Master Member <small>(Pusat)</small>
			</span>
		</a>
		<ul>
			<li class="master_member_belum_verif_pusat">
				<a href="{{ url('/admin/master_member_belum_verif_pusat') }}">
					@if(!empty($pabi_member_verif_belum))
					<span class="badge bg-primary">
						{{$pabi_member_verif_belum}}
					</span>
					@endif
					Member Belum Verif
				</a>
			</li>
			<li class="master_member_sudah_verif_pusat">
				<a href="{{ url('/admin/master_member_sudah_verif_pusat') }}">Member Sudah Verif</a>
			</li>
		</ul>
	</li>
	@endif
	@if(in_array(request()->session()->get('pabi_role_id'), $role_cabang))
	<?php
	$pabi_member_verif_belum = request()->session()->get('pabi_member_verif_belum');
	$pabi_member_verif_setuju = request()->session()->get('pabi_member_verif_setuju');
	$pabi_member_verif_tolak = request()->session()->get('pabi_member_verif_tolak');
	
	if (empty($pabi_member_verif_belum)) {
		$pabi_member_verif_belum = 0;
	}
	if (empty($pabi_member_verif_setuju)) {
		$pabi_member_verif_setuju = 0;
	}
	if (empty($pabi_member_verif_tolak)) {
		$pabi_member_verif_tolak = 0;
	}
	
	?>
	<li>
		<a href="#"><i class="icon-people"></i>
			@if(!empty($pabi_member_verif_belum))
			<span class="badge bg-primary">
				{{$pabi_member_verif_belum}}
			</span>
			@endif
			<span>
				Master Member <small>(Cabang)</small>
			</span>
		</a>
		<ul>
			<li class="master_member_belum_verif_cabang">
				<a href="{{ url('/admin/master_member_belum_verif_cabang') }}">
					@if(!empty($pabi_member_verif_belum))
					<span class="badge bg-primary">
						{{$pabi_member_verif_belum}}
					</span>
					@endif
					Member Belum Verif
				</a>
			</li>
			<li class="master_member_sudah_verif_cabang">
				<a href="{{ url('/admin/master_member_sudah_verif_cabang') }}">
					Member Sudah Verif
				</a>
			</li>
		</ul>
	</li>
	@endif

	@if(in_array(request()->session()->get('pabi_role_id'), $role_cabang))
	<?php
	$pabi_pindah_cabang_asal_belum_verif = request()->session()->get('pabi_pindah_cabang_asal_belum_verif');
	$pabi_pindah_cabang_asal_sudah_verif = request()->session()->get('pabi_pindah_cabang_asal_sudah_verif');
	$pabi_pindah_cabang_tujuan_belum_verif = request()->session()->get('pabi_pindah_cabang_tujuan_belum_verif');
	$pabi_pindah_cabang_tujuan_sudah_verif = request()->session()->get('pabi_pindah_cabang_tujuan_sudah_verif');
	
	if (empty($pabi_pindah_cabang_asal_belum_verif)) { $pabi_pindah_cabang_asal_belum_verif = 0; }
	if (empty($pabi_pindah_cabang_asal_sudah_verif)) { $pabi_pindah_cabang_asal_sudah_verif = 0; }
	if (empty($pabi_pindah_cabang_tujuan_belum_verif)) { $pabi_pindah_cabang_tujuan_belum_verif = 0; }
	if (empty($pabi_pindah_cabang_tujuan_sudah_verif)) { $pabi_pindah_cabang_tujuan_sudah_verif = 0; }
	
	$pabi_total_pindah_cabang=$pabi_pindah_cabang_asal_belum_verif 
				+ $pabi_pindah_cabang_tujuan_belum_verif ; 
	?>
	<li>
		<a href="#">
			<i class="icon-move-up"></i> 
			@if(!empty($pabi_total_pindah_cabang))
			<span class="badge bg-primary">
				{{$pabi_total_pindah_cabang}}
			</span>
			@endif
			<span>Pindah Cabang</span>
		</a>
		<ul>
			<li>
				<a href="#">
					@if(!empty($pabi_pindah_cabang_asal_belum_verif))
					<span class="badge bg-primary">
						{{$pabi_pindah_cabang_asal_belum_verif}}
					</span>
					@endif
					Cabang Asal
				</a>
				<ul>
					<li class="pengajuan_pindah_cabang_belum_verif1">
						<a href="{{ url('/admin/pengajuan_pindah_cabang_belum_verif1') }}">
							@if(!empty($pabi_pindah_cabang_asal_belum_verif))
							<span class="badge bg-primary">
								{{$pabi_pindah_cabang_asal_belum_verif}}
							</span>
							@endif
							Pengajuan Belum Verif
						</a>
					</li>
					<li class="pengajuan_pindah_cabang_sudah_verif1">
						<a href="{{ url('/admin/pengajuan_pindah_cabang_sudah_verif1') }}">
							Pengajuan Sudah Verif
						</a>
					</li>
				</ul>
			</li>
			<li>
				<a href="#">
					@if(!empty($pabi_pindah_cabang_tujuan_belum_verif))
					<span class="badge bg-primary">
						{{$pabi_pindah_cabang_tujuan_belum_verif}}
					</span>
					@endif
					Cabang Tujuan
				</a>
				<ul>
					<li class="pengajuan_pindah_cabang_belum_verif2">
						<a href="{{ url('/admin/pengajuan_pindah_cabang_belum_verif2') }}">
							@if(!empty($pabi_pindah_cabang_tujuan_belum_verif))
							<span class="badge bg-primary">
								{{$pabi_pindah_cabang_tujuan_belum_verif}}
							</span>
							@endif
							Pengajuan Belum Verif
						</a>
					</li>
					<li class="pengajuan_pindah_cabang_sudah_verif2">
						<a href="{{ url('/admin/pengajuan_pindah_cabang_sudah_verif2') }}">
							Pengajuan Sudah Verif
						</a>
					</li>
				</ul>
			</li>
		</ul>
	</li>
	@endif

	<?php
	$pabi_event_akan_datang_pusat = request()->session()->get('pabi_event_akan_datang_pusat'); 
	$pabi_event_belum_verif_bayar_pusat = request()->session()->get('pabi_event_belum_verif_bayar_pusat'); 
	
	if (empty($pabi_event_akan_datang_pusat)) { $pabi_event_akan_datang_pusat = 0; } 
	if (empty($pabi_event_belum_verif_bayar_pusat)) { $pabi_event_belum_verif_bayar_pusat = 0; } 


	$pabi_event_akan_datang_cabang_pusat = request()->session()->get('pabi_event_akan_datang_cabang_pusat'); 
	$pabi_event_belum_verif_bayar_cabang = request()->session()->get('pabi_event_belum_verif_bayar_cabang'); 
	
	if (empty($pabi_event_akan_datang_cabang_pusat)) { $pabi_event_akan_datang_cabang_pusat = 0; } 
	if (empty($pabi_event_belum_verif_bayar_cabang)) { $pabi_event_belum_verif_bayar_cabang = 0; } 
	
	$pabi_total_event=0;
	if(in_array(request()->session()->get('pabi_role_id'), $role_pusat)){
		$pabi_total_event += ($pabi_event_akan_datang_pusat + $pabi_event_belum_verif_bayar_pusat);
	} 
	if(in_array(request()->session()->get('pabi_role_id'), $role_cabang) 
		|| in_array(request()->session()->get('pabi_role_id'), $role_pusat)){
		$pabi_total_event += ($pabi_event_akan_datang_cabang_pusat + $pabi_event_belum_verif_bayar_cabang);
	}
	?>
	<li>
		<a href="#"><i class="icon-calendar"></i> 
			<span> 
				@if(!empty($pabi_total_event))
				<span class="badge bg-primary">
					{{$pabi_total_event}}
				</span>
				@endif
				Master Event
			</span>
		</a>
		<ul>
			@if(in_array(request()->session()->get('pabi_role_id'), $role_pusat))
			<li class="master_event_pusat">
				<a href="{{ url('/admin/master_event_pusat') }}">
					@if(!empty($pabi_event_akan_datang_pusat))
					<span class="badge bg-primary">
						{{$pabi_event_akan_datang_pusat}}
					</span>
					@endif
					Master Event Pusat
				</a>
			</li>
			<li class="pembayaran_pusat_page">
				<a href="{{ url('/admin/pembayaran_pusat_page') }}">
					@if(!empty($pabi_event_belum_verif_bayar_pusat))
					<span class="badge bg-primary">
						{{$pabi_event_belum_verif_bayar_pusat}}
					</span>
					@endif
					Pembayaran Pusat
				</a>
			</li>
			<li class="expired_pembayaran_pusat_page">
				<a href="{{ url('/admin/expired_pembayaran_pusat_page') }}">
					Expired Pembayaran Pusat
				</a>
			</li> 
			@endif

			@if(in_array(request()->session()->get('pabi_role_id'), $role_cabang) ||
			in_array(request()->session()->get('pabi_role_id'), $role_pusat))
			<li class="master_event_cabang">
				<a href="{{ url('/admin/master_event_cabang') }}">
					@if(!empty($pabi_event_akan_datang_cabang_pusat))
					<span class="badge bg-primary">
						{{$pabi_event_akan_datang_cabang_pusat}}
					</span>
					@endif
					Master Event Cabang
				</a>
			</li>
			<li class="pembayaran_cabang_page">
				<a href="{{ url('/admin/pembayaran_cabang_page') }}">
					@if(!empty($pabi_event_belum_verif_bayar_cabang))
					<span class="badge bg-primary">
						{{$pabi_event_belum_verif_bayar_cabang}}
					</span>
					@endif
					Pembayaran Cabang
				</a>
			</li>
			<li class="expired_pembayaran_cabang_page">
				<a href="{{ url('/admin/expired_pembayaran_cabang_page') }}">
					Expired Pembayaran Cabang
				</a>
			</li>
			@endif
		</ul>
	</li>
	@if(in_array(request()->session()->get('pabi_role_id'), $role_pusat))
	<li>
		<a href="#"><i class="icon-book"></i>
			<span>Borang <small><!-- (Pusat) --></small></span></a>
		<ul>
			<li class="master_borang_belum_verif_pusat">
				<a href="{{ url('/admin/master_borang_belum_verif_pusat') }}">Borang Belum Verif</a>
			</li>
			<li class="master_borang_sudah_verif_pusat">
				<a href="{{ url('/admin/master_borang_sudah_verif_pusat') }}">Borang Sudah Verif</a>
			</li>
		</ul>
	</li>
	@endif
	@if(in_array(request()->session()->get('pabi_role_id'), $role_cabang))
	<?php
	$pabi_borang_belum_verif_admin_cabang = request()->session()->get('pabi_borang_belum_verif_admin_cabang');
	
	if (empty($pabi_borang_belum_verif_admin_cabang)) { $pabi_borang_belum_verif_admin_cabang = 0; }
	?>
	<li>
		<a href="#"><i class="icon-book"></i> 
			<span>
				@if(!empty($pabi_borang_belum_verif_admin_cabang))
				<span class="badge bg-primary">
					{{$pabi_borang_belum_verif_admin_cabang}}
				</span>
				@endif
				Borang 
				<small>(Cabang)</small>
			</span>
		</a>
		<ul>
			<li class="master_borang_belum_verif_cabang">
				<a href="{{ url('/admin/master_borang_belum_verif_cabang') }}">
					@if(!empty($pabi_borang_belum_verif_admin_cabang))
					<span class="badge bg-primary">
						{{$pabi_borang_belum_verif_admin_cabang}}
					</span>
					@endif
					Borang Belum Verif
				</a>
			</li>
			<li class="master_borang_sudah_verif_cabang">
				<a href="{{ url('/admin/master_borang_sudah_verif_cabang') }}">Borang Sudah
					Verif</a>
			</li>
		</ul>
	</li>
	@endif
	@endif
	@if(request()->session()->get('pabi_role_id') == 4)
	<li class="dashboard"><a href="{{ url('/member') }}"><i class="icon-home4"></i>
			<span>Dashboard</span></a></li>
	<li class="menu_keanggotaan"><a href="{{ url('member/keanggotaan') }}"><i
					class="icon-person"></i> <span>Keanggotaan</span></a></li>
	<!-- <li><a href="{{ url('member/kredit_poin') }}"><i class="icon-coins"></i> <span>Kredit Poin</span></a></li>  -->
	@if((session('pabi_pusat_verif') == 2) || (
	(in_array(request()->session()->get('pabi_role_id'), $role_pusat))
	) ||
	(in_array(request()->session()->get('pabi_role_id'), $role_cabang))
	)
	<?php
	$jml_event_menunggu_bayar = 0;
	$jml_event_akan_datang = 0;
	if ((session('pabi_event_menunggu_bayar'))) {
		$jml_event_menunggu_bayar = session('pabi_event_menunggu_bayar');
	}
	if ((session('pabi_event_akan_datang'))) {
		$jml_event_akan_datang = session('pabi_event_akan_datang');
	}
	$jml_event = $jml_event_akan_datang + $jml_event_menunggu_bayar;
	?>
	<li>
		<a href="#">
			<i class="icon-calendar"></i>
			<span> 
				@if(!empty($jml_event))
				<span class="badge bg-indigo">
					{{$jml_event}}
				</span>
				@endif
				Event
			</span>
		</a>
		<ul>
			<li class="event_pusat"><a href="{{ url('/member/event_pusat') }}">Event Pusat</a></li>
			<li class="event_cabang"><a href="{{ url('/member/event_cabang') }}">Event Cabang</a>
			</li>
			<li>
				<a href="#">
					@if(!empty($jml_event))
					<span class="badge bg-primary">
						{{$jml_event}}
					</span>
					@endif
					Event Saya
				</a>
				<ul>
					<li class="event_saya_belum_bayar">
						<a href="{{ url('/member/event_saya/belum_bayar') }}">
							@if(!empty($jml_event_menunggu_bayar))
							<span class="badge bg-primary">
								{{$jml_event_menunggu_bayar}}
							</span>
							@endif
							Event Menunggu Bayar
						</a>
					</li>
					<li class="event_saya_sudah_bayar">
						<a href="{{ url('/member/event_saya/sudah_bayar') }}">
							@if(!empty($jml_event_akan_datang))
							<span class="badge bg-primary">
								{{$jml_event_akan_datang}}
							</span>
							@endif
							Event Akan Datang
						</a>
					</li>
					<li class="event_saya_histori"><a
								href="{{ url('/member/event_saya/histori_event') }}">Histori
							Partisipasi Event</a></li>
				</ul>
			</li>
			<!-- <li class="event_saya"><a href="{{ url('/member/event_saya') }}">Event Saya</a></li> -->
		</ul>
	</li>
	<?php
	$pabi_borang_proses = request()->session()->get('pabi_borang_proses');
	$pabi_borang_disetujui = request()->session()->get('pabi_borang_disetujui');
	$pabi_borang_ditolak = request()->session()->get('pabi_borang_ditolak');
	
	if (empty($pabi_borang_proses)) {
		$pabi_borang_proses = 0;
	}
	if (empty($pabi_borang_disetujui)) {
		$pabi_borang_disetujui = 0;
	}
	if (empty($pabi_borang_ditolak)) {
		$pabi_borang_ditolak = 0;
	}
	
	?>
	<li>
		<a href="#">
			<i class="icon-book"></i>
			<span> 
				@if(!empty($pabi_borang_proses))
				<span class="badge bg-indigo">
					{{$pabi_borang_proses}}
				</span>
				@endif
				Borang
			</span>
		</a>
		<ul>
			<li class="master_borang">
				<a href="{{ url('/member/master_borang') }}">
					@if(!empty($pabi_borang_proses))
					<span class="badge bg-primary">
						{{$pabi_borang_proses}}
					</span>
					@endif
					List Borang
				</a>
			</li>
			<li class="kredit_poin_member"><a href="{{ url('/member/kredit_poin') }}">Kredit
					Point</a></li>
		</ul>
	</li>
	@endif
	@endif
	@if(in_array(request()->session()->get('pabi_role_id'), $role_admin))
	<li>
		<a href="{{ url('/admin/kredit_poin') }}">
			<i class="icon-coins"></i>
			<span>Kredit Poin</span>
		</a>
	</li>
	@endif
	@if(in_array(request()->session()->get('pabi_role_id'), $role_admin))
		<li>
			<a href="#"><i class="fas fa-copy"></i> <span>Master Data</span></a>
			<ul>
				<li>
					<a href="#">Sistem</a>
					<ul>

						<li class="master_rumah_sakit_page">
							<a href="{{ url('/admin/master_rumah_sakit_page') }}">
								Master RS
							</a>
						</li>
						@if(in_array(request()->session()->get('pabi_role_id'), $role_superadmin))
						<li class="master_minat_bidang_page">
							<a href="{{ url('/admin/master_minat_bidang_page') }}">
								Master Minat Bidang
							</a>
						</li>
						@endif
						<!-- <li class="master_data_user">
							<a href="{{ url('/admin/master_data_user') }}">
								Master User
							</a>
						</li> -->
					</ul>
				</li>
				@if(in_array(request()->session()->get('pabi_role_id'), $role_superadmin))
				<li>
					<a href="#">Landing Page</a>
					<ul>
						<li class="master_tentang_pabi">
							<a href="{{ url('/admin/master_tentang_pabi') }}">
								Tentang PABI
							</a>
						</li>
						<li class="master_banner_page">
							<a href="{{ url('/admin/master_banner_page') }}">
								Banner
							</a>
						</li>
						<li class="master_berita_page">
							<a href="{{ url('/admin/master_berita_page') }}">
								Berita
							</a>
						</li>
					</ul>
				</li>
				@endif
			</ul> 
		</li>
		@endif