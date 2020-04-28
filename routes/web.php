<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Auth::routes();

Route::get('/index', 'PublicController@public_member');

Route::get('/', 'PublicController@public_member');

Route::get('/password', 'PublicController@password_login')->name('password.log');
Route::get('/begin-forgot-password', 'PublicController@begin_forgot_password')->name('begin_password_password.log');
Route::post('/begin-forgot-password', 'PublicController@begin_post_forgot_password')->name('begin_password_password.log.post');
Route::get('/reset-password/{params}', 'PublicController@reset_password')->name('reset_passoword.log');
Route::post('/reset-password', 'PublicController@reset_password_post')->name('reset_passoword_post.log');

Route::post('/password/post', 'PublicController@updatePassword')->name('password.post');

Route::get('/auth/{provider}', 'Auth\LoginController@redirectToProvider');

Route::get('/auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/logout/auth', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/login', 'PublicController@public_login')->middleware('notlogin');

Route::post('/login_send', 'Auth\LoginController@login');

Route::post('/register_send', 'Auth\RegisterController@register');

Route::get('/event/detail/{id}', 'EventController@halaman_detail_event_public');
Route::get('/event/maps/{koor}', 'EventController@event_maps_public');

Route::group(['middleware' => 'login'], function () {
	
	Route::get('/logout', 'Auth\LoginController@logout_admin');
		
	Route::post('/div_grafik_barang_masuk', 'GrafikController@div_grafik_barang_masuk');
	Route::post('/div_grafik_uang_keluar', 'GrafikController@div_grafik_uang_keluar');
	Route::post('/div_laporan_barang_masuk', 'GrafikController@div_laporan_barang_masuk');
	
	
	Route::group(['middleware' => ['admin']], function () {
		// --- Start Admin ---
		Route::get('/admin', 'PublicController@public_admin')->name('dashboard_admin');
		Route::get('/rumah-sakit', 'PublicController@public_rs')->name('dashboard_rs');

		Route::get('/admin/myprofile', 'ProfileController@my_profile_admin');
		Route::post('/admin/myprofile/{id}/ganti_password_admin', 'ProfileController@ganti_password_admin')->name('simpan_ganti_password_admin');
		Route::post('/admin/myprofile/{id}/ganti_username_email_admin', 'ProfileController@ganti_username_email_admin')->name('simpan_ganti_username_email_admin');
		Route::post('/admin/myprofile/{id}/ganti_rekening_admin', 'ProfileController@ganti_rekening_admin')->name('simpan_ganti_rekening_admin');
		
		
		Route::resource('/admin/master_admin_pusat', 'AdminPusatController');
		Route::post('/admin/master_admin_pusat/tambah', 'AdminPusatController@modal_tambah');
		Route::post('/admin/master_admin_pusat/tambah/simpan', 'AdminPusatController@create')->name('simpan_admin_pusat');
		Route::post('modal_edit_admin_pusat/{id}/modal_edit', 'AdminPusatController@modal_edit');
		Route::post('/admin/adminpusat/{id}/edit/simpan_ubah_admin', 'AdminPusatController@update_admin_pusat')->name('simpan_ubah_admin_pusat');
		Route::post('/admin/master_admin_pusat/{id}/hapus', 'AdminPusatController@destroy');
		
		
		Route::resource('/admin/master_admin_cabang', 'AdminCabangController');
		Route::post('/admin/master_admin_cabang/tambah', 'AdminCabangController@modal_tambah');
		Route::post('/admin/master_admin_cabang/tambah/simpan', 'AdminCabangController@create')->name('simpan_admin_cabang');
		Route::post('modal_edit_admin_cabang/{id}/modal_edit', 'AdminCabangController@modal_edit');
		Route::post('/admin/admincabang/{id}/edit/simpan_ubah_admin', 'AdminCabangController@update_admin_cabang')->name('simpan_ubah_admin_cabang');
		Route::post('/admin/master_admin_cabang/{id}/hapus', 'AdminCabangController@destroy');
		
		
		Route::resource('/admin/master_event_pusat', 'EventController');
		Route::get('/admin/master_event_cabang', 'EventController@index2');
		Route::post('/admin/master_event/tambah_pusat', 'EventController@create');
		Route::post('/admin/master_event/tambah_cabang', 'EventController@create2');
		Route::post('/admin/master_event/tambah/simpan', 'EventController@store')->name('simpan_master_event');
		Route::post('/admin/master_event/{id}/ubah_pusat', 'EventController@edit');
		Route::post('/admin/master_event/{id}/ubah_cabang', 'EventController@edit2');
		Route::post('/admin/master_event/{id}/ubah/simpan', 'EventController@update')->name('simpan_ubah_master_event');
		Route::post('/admin/master_event/{id}/hapus', 'EventController@destroy');
		
		
		Route::resource('/admin/master_member_belum_verif', 'MemberController');
		Route::get('/admin/master_member_sudah_verif', 'MemberController@index2');
		Route::post('/admin/master_member/tambah', 'MemberController@create');
		Route::post('/admin/master_member/tambah/simpan', 'MemberController@store')->name('simpan_master_member');
		Route::post('/admin/master_member/{id}/ubah', 'MemberController@edit');
		Route::post('/admin/master_member/{id}/ubah/simpan', 'MemberController@update')->name('simpan_ubah_master_member');
		Route::post('/admin/master_member/{id}/hapus', 'MemberController@destroy');
		Route::post('/admin/master_member/{id}/verif_cabang/simpan', 'MemberController@simpan_verif_cabang')->name('simpan_verifikasi_member_cabang');
		Route::post('/admin/master_member/{id}/verif_pusat/simpan', 'MemberController@simpan_verif_pusat')->name('simpan_verifikasi_member_pusat');
		
		Route::post('/admin/master_event/isi_buku_tamu', 'EventController@isi_buku_tamu');
		
		Route::post('/admin/master_event/update_status_hadir_n_acc', 'EventController@update_status_hadir_n_acc');
		Route::post('/admin/master_member/{id}/histori_pengajuan', 'MemberController@histori_pengajuan');

		Route::get('/admin/master_member_belum_verif_pusat', 'MemberController@index_pusat_1');
		Route::post('/admin/master_member/div_tabel_member_belum_verif_pusat', 'MemberController@div_tabel_member_belum_verif_pusat');
		Route::get('/admin/master_member_sudah_verif_pusat', 'MemberController@index_pusat_2');
		Route::post('/admin/master_member/div_tabel_member_sudah_verif_pusat', 'MemberController@div_tabel_member_sudah_verif_pusat');
		Route::get('/admin/master_member_inactive_pusat', 'MemberController@index_pusat_inactive');
		Route::post('/admin/master_member/div_tabel_member_inactive_pusat', 'MemberController@div_tabel_member_inactive_pusat');



		Route::get('/admin/master_member_belum_verif_cabang', 'MemberController@index_cabang_1');
		Route::post('/admin/master_member/div_tabel_member_belum_verif_cabang', 'MemberController@div_tabel_member_belum_verif_cabang');
		Route::get('/admin/master_member_sudah_verif_cabang', 'MemberController@index_cabang_2');
		Route::post('/admin/master_member/div_tabel_member_sudah_verif_cabang', 'MemberController@div_tabel_member_sudah_verif_cabang');
		Route::get('/admin/master_member_inactive_cabang', 'MemberController@index_cabang_inactive');
		Route::post('/admin/master_member/div_tabel_member_inactive_cabang', 'MemberController@div_tabel_member_inactive_cabang');

		Route::post('/admin/master_member_pusat/{id}/update_modal_verif_pusat', 'MemberController@update_modal_verif_pusat');
		Route::post('/admin/master_member_cabang/{id}/update_modal_verif_cabang', 'MemberController@update_modal_verif_cabang');


		Route::post('/admin/master_event/div_tabel_event_cabang', 'EventController@div_tabel_event_cabang');
		Route::post('/admin/master_event/div_tabel_event_pusat', 'EventController@div_tabel_event_pusat');


		Route::post('/admin/master_event_pusat/{id}/modal_onoff_pendaftaran_pusat', 'EventController@modal_onoff_pendaftaran_pusat');
		Route::post('/admin/master_event_pusat/{id}/simpan_modal_onoff_pendaftaran_pusat', 'EventController@simpan_modal_onoff_pendaftaran_pusat');

		Route::post('/admin/master_event_cabang/{id}/modal_onoff_pendaftaran_cabang', 'EventController@modal_onoff_pendaftaran_cabang');
        Route::post('/admin/master_event_cabang/{id}/simpan_modal_onoff_pendaftaran_cabang', 'EventController@simpan_modal_onoff_pendaftaran_cabang');

        Route::post('/admin/master_event/{id}/modal_kehadiran', 'EventController@modal_kehadiran');
        Route::post('/admin/master_event/update_status_hadir', 'EventController@update_status_hadir');

        Route::post('/admin/master_member/{id}/modal_reset_password', 'MemberController@modal_reset_password');
        Route::post('/admin/master_member/{id}/simpan_form_update_reset_password_admin', 'MemberController@simpan_form_update_reset_password_admin');

        Route::post('/admin/master_event/{id}/modal_daftar_harga_event', 'EventHargaController@modal_daftar_harga_event');
        Route::post('/admin/master_event/{id}/div_tabel_data_harga_event', 'EventHargaController@div_tabel_data_harga_event');

        Route::post('/admin/master_event/{id}/div_tambah_data_harga_event', 'EventHargaController@div_tambah_data_harga_event');
        Route::post('/admin/master_event/{id}/div_ubah_data_harga_event', 'EventHargaController@div_ubah_data_harga_event');

        Route::post('/admin/master_event/{id}/simpan_harga_event', 'EventHargaController@simpan_harga_event');
        Route::post('/admin/master_event/{id}/simpan_harga_event_ubah', 'EventHargaController@simpan_harga_event_ubah');
        Route::post('/admin/master_event/{id}/delete_harga_event', 'EventHargaController@delete_harga_event');
        Route::post('/admin/master_event/{id}/edit_harga_event', 'EventHargaController@edit_harga_event');

        Route::post('/admin/master_event/tambah_point', 'EventController@tambah_point');




        Route::get('/admin/master_borang_belum_verif_pusat', 'BorangController@borang_belum_verif_pusat');
		Route::post('/admin/master_borang/div_tabel_borang_belum_verif_pusat', 'BorangController@div_tabel_borang_belum_verif_pusat');
		Route::get('/admin/master_borang_sudah_verif_pusat', 'BorangController@borang_sudah_verif_pusat');
		Route::post('/admin/master_borang/div_tabel_borang_sudah_verif_pusat', 'BorangController@div_tabel_borang_sudah_verif_pusat');



		Route::get('/admin/master_borang_belum_verif_cabang', 'BorangController@borang_belum_verif_cabang');
		Route::post('/admin/master_borang/div_tabel_borang_belum_verif_cabang', 'BorangController@div_tabel_borang_belum_verif_cabang');
		Route::get('/admin/master_borang_sudah_verif_cabang', 'BorangController@borang_sudah_verif_cabang');
		Route::post('/admin/master_borang/div_tabel_borang_sudah_verif_cabang', 'BorangController@div_tabel_borang_sudah_verif_cabang');



		Route::get('/rumah-sakit/master_borang_belum_verif', 'BorangController@rs_borang_belum_verif');
		Route::post('/rumah-sakit/master_borang/div_tabel_borang_belum_verif', 'BorangController@div_rs_tabel_borang_belum_verif');
		Route::get('/rumah-sakit/master_borang_sudah_verif', 'BorangController@rs_borang_sudah_verif');
		Route::post('/rumah-sakit/master_borang/div_tabel_borang_sudah_verif', 'BorangController@div_rs_tabel_borang_sudah_verif');
		Route::post('/rumah-sakit/master_borang/verifikasi', 'BorangController@modal_verif_rs');
		Route::post('/rumah-sakit/master_borang/verif/simpan', 'BorangController@simpan_verif_rs')->name('simpan_verifikasi_borang_rs');


		Route::post('/modal_active_member/{id}', 'MemberController@modalactive');
		Route::post('/admin/master_member/{id}/active_member/simpan', 'MemberController@simpan_member_active')->name('simpan_member_active');


		Route::get('/admin/master_event/{id}/halaman_isi_buku_tamu', 'EventController@halaman_isi_buku_tamu');
		Route::get('/admin/master_event/{id}/halaman_kehadiran', 'EventController@halaman_kehadiran');
		Route::get('/admin/master_event/{id}/halaman_detail_event', 'EventController@halaman_detail_event');

		// START MASTER DATA 
		Route::get('/admin/master_rumah_sakit_page', 'AdminPusatController@master_rumah_sakit_page');
		Route::post('/admin/master_rumah_sakit_hapus/{id}', 'AdminPusatController@master_rumah_sakit_hapus');
		Route::post('/admin/tambah_modal_rumah_sakit', 'AdminPusatController@tambah_modal_rumah_sakit');
		Route::post('/admin/edit_modal_rumah_sakit/{id}', 'AdminPusatController@edit_modal_rumah_sakit');
		Route::post('/admin/edit_modal_akun_rs/{id}', 'AdminPusatController@edit_modal_akun_rs');
		Route::post('/admin/reset_password_rs/{id}', 'AdminPusatController@reset_password_rs');

		Route::post('/admin/simpan_rumah_sakit', 'AdminPusatController@simpan_rumah_sakit')->name('simpan_rumah_sakit');
		Route::post('/admin/simpan_edit_rumah_sakit/{id}', 'AdminPusatController@simpan_edit_rumah_sakit')->name('simpan_edit_rumah_sakit');
		Route::post('/admin/simpan_edit_modal_akun_rs/{id}', 'AdminPusatController@simpan_edit_modal_akun_rs')->name('simpan_edit_modal_akun_rs');
		Route::post('/admin/simpan_reset_password_rs/{id}', 'AdminPusatController@simpan_reset_password_rs')->name('simpan_reset_password_rs');


		Route::get('/admin/master_minat_bidang_page', 'AdminPusatController@master_minat_bidang_page');
		Route::post('/admin/tambah_modal_minat_bidang', 'AdminPusatController@tambah_modal_minat_bidang');
		Route::post('/admin/simpan_minat_bidang', 'AdminPusatController@simpan_minat_bidang')->name('simpan_minat_bidang');
		Route::post('/admin/edit_modal_minat_bidang/{id}', 'AdminPusatController@edit_modal_minat_bidang');
		Route::post('/admin/simpan_edit_minat_bidang/{id}', 'AdminPusatController@simpan_edit_minat_bidang')->name('simpan_edit_minat_bidang');

		Route::get('/admin/master_banner_page', 'AdminPusatController@master_banner_page');
		Route::post('/admin/tambah_modal_banner', 'AdminPusatController@tambah_modal_banner');
		Route::post('/admin/simpan_banner', 'AdminPusatController@simpan_banner')->name('simpan_banner');
		Route::post('/admin/edit_modal_banner/{id}', 'AdminPusatController@edit_modal_banner');
		Route::post('/admin/simpan_edit_minat_bidang/{id}', 'AdminPusatController@simpan_edit_minat_bidang')->name('simpan_edit_minat_bidang');
		Route::post('/admin/master_minat_bidang_hapus/{id}', 'AdminPusatController@master_minat_bidang_hapus');
		Route::post('/admin/simpan_edit_banner/{id}', 'AdminPusatController@simpan_edit_banner')->name('simpan_edit_banner');
		Route::post('/admin/master_banner_hapus/{id}', 'AdminPusatController@master_banner_hapus');


		Route::get('/admin/master_berita_page', 'AdminPusatController@master_berita_page');
		Route::post('/admin/tambah_berita', 'AdminPusatController@tambah_berita');
		Route::post('/admin/tambah_modal_berita', 'AdminPusatController@tambah_modal_berita');
		Route::post('/admin/simpan_berita', 'AdminPusatController@simpan_berita')->name('simpan_berita');
		Route::post('/admin/edit_modal_berita/{id}', 'AdminPusatController@edit_modal_berita');
		Route::post('/admin/simpan_edit_berita/{id}', 'AdminPusatController@simpan_edit_berita')->name('simpan_edit_berita');
		Route::post('/admin/master_berita_hapus/{id}', 'AdminPusatController@master_berita_hapus');

		Route::get('/admin/master_tentang_pabi', 'AdminPusatController@master_tentang_pabi'); 

		Route::post('/admin/tambah_modal_tentang_pabi', 'AdminPusatController@tambah_modal_tentang_pabi');
		Route::post('/admin/simpan_tentang_pabi', 'AdminPusatController@simpan_tentang_pabi')->name('simpan_tentang_pabi');
		Route::post('/admin/edit_modal_tentang_pabi/{id}', 'AdminPusatController@edit_modal_tentang_pabi');
		Route::post('/admin/simpan_edit_tentang_pabi/{id}', 'AdminPusatController@simpan_edit_tentang_pabi')->name('simpan_edit_tentang_pabi');
		Route::post('/admin/simpan_edit_landing_page_pabi/{id}', 'AdminPusatController@simpan_edit_landing_page_pabi')->name('simpan_edit_landing_page_pabi');
		Route::post('/admin/master_tentang_pabi_hapus/{id}', 'AdminPusatController@master_tentang_pabi_hapus');
		// END MASTER DATA  

		Route::get('/admin/pembayaran_pusat_page', 'EventController@pembayaran_pusat_page');

		Route::get('/admin/pembayaran_cabang_page', 'EventController@pembayaran_cabang_page');

		Route::post('/admin/master_event/div_tabel_pembayaran_pusat', 'EventController@div_tabel_pembayaran_pusat'); 
		Route::post('/admin/master_event/pembayaran_pusat_page', 'EventController@div_event_admin_pusat');
		Route::post('/admin/master_event/set_status_bayar/{id}', 'EventController@set_status_bayar');
		Route::post('/admin/master_event/div_tabel_pembayaran_cabang', 'EventController@div_tabel_pembayaran_cabang'); 
		Route::post('/admin/master_event/pembayaran_cabang_page', 'EventController@div_event_admin_cabang'); 
		// --- Finish Admin ---

		Route::post('/admin/master_borang/verifikasi_cabang', 'BorangController@modal_verif_cabang');
		Route::post('/admin/master_borang/verif_cabang/simpan', 'BorangController@simpan_verif_cabang')->name('simpan_verifikasi_borang_cabang');

		Route::get('/admin/pengajuan_pindah_cabang_belum_verif1', 'MemberController@pengajuan_pindah_cabang_belum_verif1');
		Route::post('/admin/pengajuan_pindah_cabang/div_tabel_pengajuan_pindah_cabang_belum_verif1', 'MemberController@div_tabel_pengajuan_pindah_cabang_belum_verif1');
		Route::get('/admin/pengajuan_pindah_cabang_sudah_verif1', 'MemberController@pengajuan_pindah_cabang_sudah_verif1');
		Route::post('/admin/pengajuan_pindah_cabang/div_tabel_pengajuan_pindah_cabang_sudah_verif1', 'MemberController@div_tabel_pengajuan_pindah_cabang_sudah_verif1');

		Route::get('/admin/pengajuan_pindah_cabang_belum_verif2', 'MemberController@pengajuan_pindah_cabang_belum_verif2');
		Route::post('/admin/pengajuan_pindah_cabang/div_tabel_pengajuan_pindah_cabang_belum_verif2', 'MemberController@div_tabel_pengajuan_pindah_cabang_belum_verif2');
		Route::get('/admin/pengajuan_pindah_cabang_sudah_verif2', 'MemberController@pengajuan_pindah_cabang_sudah_verif2');
		Route::post('/admin/pengajuan_pindah_cabang/div_tabel_pengajuan_pindah_cabang_sudah_verif2', 'MemberController@div_tabel_pengajuan_pindah_cabang_sudah_verif2');

		Route::post('/admin/pengajuan_pindah_cabang/verif_cabang_lama/{id}/simpan', 'MemberController@simpan_verifikasi_pengajuan_pindah_cabang_lama')->name('simpan_verifikasi_pengajuan_pindah_cabang_lama');

		Route::post('/admin/pengajuan_pindah_cabang/verif_cabang_baru/{id}/simpan', 'MemberController@simpan_verifikasi_pengajuan_pindah_cabang_baru')->name('simpan_verifikasi_pengajuan_pindah_cabang_baru');

		Route::post('/admin/pengajuan_pindah_cabang/detail', 'MemberController@modal_detail_verif_pindah_cabang');
		Route::post('/admin/pengajuan_pindah_cabang/verifikasi_cabang_lama', 'MemberController@modal_verif_pindah_cabang1');
		Route::post('/admin/pengajuan_pindah_cabang/verifikasi_cabang_baru', 'MemberController@modal_verif_pindah_cabang2');

		Route::get('/admin/kredit_poin', 'KreditPoinController@master_kredit_poin');
		Route::get('/admin/master_data_user', 'MemberController@master_data_user');
		Route::post('/div_grafik_jumlah_kredit_poin', 'GrafikController@div_grafik_jumlah_kredit_poin');
		Route::post('/div_grafik_borang', 'GrafikController@div_grafik_borang');
		Route::post('/div_grafik_ranah', 'GrafikController@div_grafik_ranah');
		
		Route::post('/div_grafik_borang_pie_cabang', 'GrafikController@div_grafik_borang_pie_cabang');
		Route::post('/div_grafik_ranah_bar_cabang', 'GrafikController@div_grafik_ranah_bar_cabang');
		//Route::post('/admin/kredit_poin/div_tabel_kredit_poin', 'KreditPoinController@div_tabel_kredit_poin');

		Route::get('/admin/expired_pembayaran_pusat_page', 'EventController@expired_pembayaran_pusat_page');
		Route::get('/admin/expired_pembayaran_cabang_page', 'EventController@expired_pembayaran_cabang_page');
		Route::post('/admin/master_event/div_tabel_expired_pembayaran_pusat', 'EventController@div_tabel_expired_pembayaran_pusat');
		Route::post('/admin/master_event/div_tabel_expired_pembayaran_cabang', 'EventController@div_tabel_expired_pembayaran_cabang');
		Route::post('/admin/master_event/set_status_bayar_menunggu_bayar/{id}', 'EventController@set_status_bayar_menunggu_bayar');
	}); 
	
	Route::group(['middleware' => ['member']], function () {
		// --- Start Member ---
		Route::get('/member', 'PublicController@public_admin_member')->name('dashboard_member');
		Route::get('/member/myprofile', 'ProfileController@my_profile_member');
		Route::post('/member/myprofilemember/edit', 'ProfileController@edit');
		Route::post('/member/detail_pengajuan', 'ProfileController@detail_pengajuan');

		Route::post('/member/myprofile/{id}/ganti_password_member', 'ProfileController@ganti_password_member')->name('simpan_ganti_password_member');
		Route::post('/member/myprofile/{id}/ganti_username_email_member', 'ProfileController@ganti_username_email_member')->name('simpan_ganti_username_email_member');
		
		Route::post('/member/set_kota_by_prov', 'ProfileController@set_kota_by_prov');
		
		
		Route::post('/member/myprofilemember/{id}/edit/simpan_data_idi', 'ProfileController@simpan_ubah_my_profile_data_idi')->name('simpan_ubah_my_profile_data_idi');
		Route::post('/member/myprofilemember/{id}/edit/simpan_identitas_diri', 'ProfileController@simpan_ubah_my_profile_identitas_diri')->name('simpan_ubah_my_profile_identitas_diri');
		Route::post('/member/myprofilemember/{id}/edit/simpan_foto_profile', 'ProfileController@simpan_ubah_my_profile_foto_profile')->name('simpan_ubah_my_profile_foto_profile');
		
		Route::post('/member/myprofilemember/{id}/edit/simpan_data_bank', 'ProfileController@simpan_ubah_my_profile_bank')->name('simpan_ubah_my_profile_bank');
		
		
		Route::post('/member/myprofilemember/{id}/edit/simpan_data_pasangan', 'MemberPasanganController@simpan_ubah_my_profile_data_pasangan')->name('simpan_ubah_my_profile_data_pasangan');
		Route::post('/member/myprofilemember/tabel_detail_pasangan/{id}/hapus', 'MemberPasanganController@tabel_detail_pasangan_hapus');
		Route::post('/member/myprofilemember/tabel_detail_pasangan', 'MemberPasanganController@tabel_detail_pasangan');
		
		
		Route::post('/member/myprofilemember/{id}/edit/simpan_data_anak', 'MemberAnakController@simpan_ubah_my_profile_data_anak')->name('simpan_ubah_my_profile_data_anak');
		Route::post('/member/myprofilemember/tabel_detail_anak/{id}/hapus', 'MemberAnakController@tabel_detail_anak_hapus');
		
		
		Route::post('/member/myprofilemember/{id}/edit/simpan_data_pendidikan', 'MemberPendidikanController@simpan_ubah_my_profile_data_pendidikan')->name('simpan_ubah_my_profile_data_pendidikan');
		Route::post('/member/myprofilemember/tabel_detail_pendidikan/{id}/hapus', 'MemberPendidikanController@tabel_detail_pendidikan_hapus');
		
		
		Route::post('/member/myprofilemember/{id}/edit/simpan_minat_bidang', 'MemberMinatBidangController@simpan_ubah_my_profile_minat_bidang')->name('simpan_ubah_my_profile_minat_bidang');
		Route::post('/member/myprofilemember/tabel_detail_minat_bidang/{id}/hapus', 'MemberMinatBidangController@tabel_detail_minat_bidang_hapus');
		
		
		Route::post('/member/myprofilemember/{id}/edit/simpan_data_ujian', 'MemberUjianController@simpan_ubah_my_profile_data_ujian')->name('simpan_ubah_my_profile_data_ujian');
		Route::post('/member/myprofilemember/tabel_detail_ujian/{id}/hapus', 'MemberUjianController@tabel_detail_ujian_hapus');
		
		
		Route::post('/member/myprofilemember/{id}/simpan_pengajuan_member', 'ProfileController@simpan_pengajuan_member')->name('simpan_pengajuan_member_m');
		
		Route::get('/member/event_pusat', 'EventController@member');
		Route::get('/member/event_cabang', 'EventController@member2');
		

		Route::get('/member/keanggotaan', 'KeanggotaanController@index');
		Route::post('/member/keanggotaan/{id}/edit', 'KeanggotaanController@edit');
		Route::post('/member/keanggotaan/{id}/div_identitas_diri_keanggotaan', 'KeanggotaanController@div_identitas_diri_keanggotaan');
		Route::post('/member/keanggotaan/{id}/div_data_idi_keanggotaan', 'KeanggotaanController@div_data_idi_keanggotaan');
		Route::post('/member/keanggotaan/{id}/div_foto_profile_keanggotaan', 'KeanggotaanController@div_foto_profile_keanggotaan');

		Route::post('/member/keanggotaan/{id}/div_data_pasangan_keanggotaan', 'KeanggotaanController@div_data_pasangan_keanggotaan');
		Route::post('/member/keanggotaan/{id}/div_tabel_data_pasangan_keanggotaan', 'KeanggotaanController@div_tabel_data_pasangan_keanggotaan');

		Route::post('/member/keanggotaan/{id}/div_data_anak_keanggotaan', 'KeanggotaanController@div_data_anak_keanggotaan');
		Route::post('/member/keanggotaan/{id}/div_tabel_data_anak_keanggotaan', 'KeanggotaanController@div_tabel_data_anak_keanggotaan');

		Route::post('/member/keanggotaan/{id}/div_data_pendidikan_keanggotaan', 'KeanggotaanController@div_data_pendidikan_keanggotaan');
		Route::post('/member/keanggotaan/{id}/div_tabel_data_pendidikan_keanggotaan', 'KeanggotaanController@div_tabel_data_pendidikan_keanggotaan');

		Route::post('/member/keanggotaan/{id}/div_minat_bidang_keanggotaan', 'KeanggotaanController@div_minat_bidang_keanggotaan');
		Route::post('/member/keanggotaan/{id}/div_tabel_minat_bidang_keanggotaan', 'KeanggotaanController@div_tabel_minat_bidang_keanggotaan');

		Route::post('/member/keanggotaan/{id}/div_data_ujian_keanggotaan', 'KeanggotaanController@div_data_ujian_keanggotaan');
		Route::post('/member/keanggotaan/{id}/div_tabel_data_ujian_keanggotaan', 'KeanggotaanController@div_tabel_data_ujian_keanggotaan'); 
		Route::post('/member/buku_tamu', 'EventController@dafar_peserta_event');
		// --- Finish Member ---

		// Mail Invoice
		Route::get('/member/send-invoice/{buku_tamu_id}', 'EventController@sendInvoice')->name('send.invoice');
		// End Mail Invoice

		Route::post('/member/event/div_tabel_event_pusat_member', 'EventController@div_tabel_event_pusat_member');
        Route::post('/member/event/div_tabel_event_cabang_member', 'EventController@div_tabel_event_cabang_member');

        Route::post('/member/event/isi_buku_tamu_member', 'EventController@isi_buku_tamu_member');

        Route::get('/member/event_saya/belum_bayar', 'EventController@event_saya');
        Route::post('/member/event/div_tabel_event_saya_member', 'EventController@div_tabel_event_saya_member');
        Route::post('/member/event/div_tabel_event_saya_member_div_pendek', 'EventController@div_tabel_event_saya_member_div_pendek');

        Route::get('/member/event_saya/sudah_bayar', 'EventController@event_saya2');
        Route::get('/member/event_saya/histori_event', 'EventController@event_saya_histori');
        Route::post('/member/event/div_tabel_event_saya_member2', 'EventController@div_tabel_event_saya_member2');
 
		Route::get('/member/master_event/{id}/halaman_detail_event', 'EventController@halaman_detail_event');
        // --- Start Tambahan Baru ---
        Route::post('/member/keanggotaan/{id}/div_data_jurnal_keanggotaan', 'KeanggotaanController@div_data_jurnal_keanggotaan');
        Route::post('/member/keanggotaan/{id}/div_tabel_data_jurnal_keanggotaan', 'KeanggotaanController@div_tabel_data_jurnal_keanggotaan');
        Route::post('/member/myprofilemember/{id}/edit/simpan_data_jurnal', 'MemberJurnalController@simpan_ubah_my_profile_data_jurnal');
        Route::post('/member/myprofilemember/tabel_detail_jurnal/{id}/hapus', 'MemberJurnalController@tabel_detail_jurnal_hapus');



        Route::post('/member/keanggotaan/{id}/div_data_file_keanggotaan', 'KeanggotaanController@div_data_file_keanggotaan');
        Route::post('/member/keanggotaan/{id}/div_tabel_data_file_keanggotaan', 'KeanggotaanController@div_tabel_data_file_keanggotaan');
        Route::post('/member/myprofilemember/{id}/edit/simpan_data_file', 'MemberFileController@simpan_ubah_my_profile_data_file');
        Route::post('/member/myprofilemember/tabel_detail_file/{id}/hapus', 'MemberFileController@tabel_detail_file_hapus');
        
        Route::post('/member/keanggotaan/{id}/div_data_bank_keanggotaan', 'KeanggotaanController@div_data_bank_keanggotaan');
        // --- Finish Tambahan Baru --- 

        Route::post('/member/keanggotaan/{id}/div_pekerjaan_keanggotaan', 'KeanggotaanController@div_pekerjaan_keanggotaan');

        Route::post('/member/myprofilemember/{id}/edit/simpan_data_pekerjaan', 'MemberPekerjaanController@simpan_ubah_my_profile_data_pekerjaan')->name('simpan_ubah_my_profile_data_pekerjaan');

        Route::post('/member/keanggotaan/{id}/div_tabel_data_pekerjaan_keanggotaan', 'KeanggotaanController@div_tabel_data_pekerjaan_keanggotaan');
  
		Route::post('/member/myprofilemember/tabel_detail_pekerjaan/{id}/hapus', 'MemberPekerjaanController@tabel_detail_pekerjaan_hapus'); 


        Route::post('/member/keanggotaan/{id}/div_praktek_keanggotaan', 'KeanggotaanController@div_praktek_keanggotaan'); 

        Route::post('/member/myprofilemember/{id}/edit/simpan_data_praktek', 'MemberPraktekController@simpan_ubah_my_profile_data_praktek')->name('simpan_ubah_my_profile_data_praktek');

        Route::post('/member/keanggotaan/{id}/div_tabel_data_praktek_keanggotaan', 'KeanggotaanController@div_tabel_data_praktek_keanggotaan');

        Route::post('/member/myprofilemember/tabel_detail_praktek/{id}/hapus', 'MemberPraktekController@tabel_detail_praktek_hapus');

		Route::post('/member/master_wilayah/kota_by_provinsi_id', 'WilayahController@kota_by_provinsi_id');
		Route::post('/member/master_wilayah/kecamatan_by_kota_id', 'WilayahController@kecamatan_by_kota_id');

		Route::post('/member/master_event/{id}/modal_daftar_event', 'EventController@modal_daftar_event');
		Route::post('/member/master_event/simpan_form_modal_daftar_event', 'EventController@simpan_form_modal_daftar_event');

		
		Route::post('/admin/master_member/{id}/histori_pengajuan', 'MemberController@histori_pengajuan');

		Route::post('/member/keanggotaan/{id}/div_nomor_anggota_pabi', 'KeanggotaanController@div_nomor_anggota_pabi');
		Route::post('/member/myprofilemember/{id}/edit/simpan_div_nomor_anggota_pabi', 'ProfileController@simpan_div_nomor_anggota_pabi');

		Route::post('/member/keanggotaan/{id}/div_data_ujian_keanggotaan_ubah', 'KeanggotaanController@div_data_ujian_keanggotaan_ubah');
		Route::post('/member/myprofilemember/{id}/edit/simpan_perubahan_data_ujian', 'MemberUjianController@simpan_perubahan_data_ujian');

		Route::post('/member/master_borang/jenis_kegiatan_by_borang', 'BorangController@jenis_kegiatan_by_borang');
		Route::post('/member/master_borang/nama_kegiatan_by_jenis_kegiatan', 'BorangController@nama_kegiatan_by_jenis_kegiatan');

		Route::get('/member/master_borang', 'BorangController@master_borang_member');
		Route::get('/member/master_borang_isi_kalender', 'BorangController@master_borang_isi_kalender');
		
		Route::post('/member/master_borang_modal_tambah', 'BorangController@master_borang_modal_tambah');
		Route::post('/member/div_master_borang', 'BorangController@div_master_borang'); 

		Route::post('/member/master_borang/tambah', 'BorangController@modal_tambah_member');
		Route::post('/member/master_borang/ubah', 'BorangController@tampilkan_form_borang_ubah'); 
		Route::post('/member/master_borang/tampilkan_form_borang_tambah', 'BorangController@tampilkan_form_borang_tambah');

		Route::post('/member/buku_tamu/{id}/hapus', 'EventController@delete_buku_tamu');
		Route::post('/member/master_event/upload_bukti_bayar_event', 'EventController@upload_bukti_bayar_event');  
 
		Route::get('/member/master_event/{buku_tamu_id}/halaman_invoice', 'EventController@halaman_invoice');
		Route::get('/member/master_event/{buku_tamu_id}/print_halaman_invoice', 'EventController@print_halaman_invoice');


		Route::post('/member/master_event/bukti_pembayaran/simpan', 'EventController@simpan_upload_bukti_bayar_event');

		Route::post('/member/master_borang/kegiatan_pembelajaran_pribadi/simpan', 'BorangController@simpan_kegiatan_pembelajaran_pribadi');
		Route::post('/member/master_borang/pengabdian_masyarakat/simpan', 'BorangController@simpan_pengabdian_masyarakat');
		Route::post('/member/master_borang/pengembangan_ilmu_pendidikan/simpan', 'BorangController@simpan_pengembangan_ilmu_pendidikan');
		Route::post('/member/master_borang/profesional/simpan', 'BorangController@simpan_profesional');
		Route::post('/member/master_borang/publikasi_ilmiah/simpan', 'BorangController@simpan_publikasi_ilmiah');

		Route::post('/member/master_borang/detail', 'BorangController@modal_detail_member');
		Route::post('/member/master_borang/upload_file', 'BorangController@modal_upload_file_borang');
		Route::post('/member/master_borang/delete', 'BorangController@destroy_borang_member');

		Route::post('/member/master_borang/kegiatan_pembelajaran_pribadi/ubah', 'BorangController@ubah_kegiatan_pembelajaran_pribadi');
		Route::post('/member/master_borang/pengabdian_masyarakat/ubah', 'BorangController@ubah_pengabdian_masyarakat');
		Route::post('/member/master_borang/pengembangan_ilmu_pendidikan/ubah', 'BorangController@ubah_pengembangan_ilmu_pendidikan');
		Route::post('/member/master_borang/profesional/ubah', 'BorangController@ubah_profesional'); 
		Route::post('/member/master_borang/publikasi_ilmiah/ubah', 'BorangController@ubah_publikasi_ilmiah');

		Route::post('/member/master_borang/ajukan_borang', 'BorangController@ajukan_borang');
		Route::post('/member/master_borang/div_data_borang_file', 'BorangController@div_data_borang_file');
		Route::post('/member/master_borang/simpan_borang_file', 'BorangController@simpan_borang_file');
		Route::post('/member/master_borang/hapus_borang_file/{id}', 'BorangController@hapus_borang_file'); 

		Route::post('/member/modal_pengajuan_pindah_cabang', 'MemberController@modal_pengajuan_pindah_cabang'); 
		Route::post('/member/simpan_pengajuan_pindah_cabang', 'MemberController@simpan_pengajuan_pindah_cabang')->name('simpan_pengajuan_pindah_cabang');

		Route::post('/member/master_admin/admin_cabang_by_admin_pusat', 'AdminCabangController@admin_cabang_by_admin_pusat');

		Route::get('/member/kredit_poin', 'KreditPoinController@master_kredit_poin_member');
		Route::post('/member/kredit_poin/div_tabel_kredit_poin', 'KreditPoinController@div_tabel_kredit_poin_member');
		Route::post('/member/kredit_poin/div_tabel_per_member', 'KreditPoinController@div_tabel_per_member');

		Route::post('/member/keanggotaan/{id}/div_periode_poin_member', 'KeanggotaanController@div_periode_poin_member');
		Route::post('/member/myprofilemember/{id}/edit/simpan_div_periode_poin_member', 'ProfileController@simpan_div_periode_poin_member');
        Route::post('/member/notification', 'NotifController@get_notif');


		Route::post('/div_grafik_borang_bulan', 'GrafikController@div_grafik_borang_bulan');
		Route::post('/div_grafik_borang_bulan_bar', 'GrafikController@div_grafik_borang_bulan_bar');

		Route::post('/member/master_event/cek_ikut_serta_event_induk', 'EventController@cek_ikut_serta_event_induk');

		Route::post('/member/keanggotaan/{id}/div_nomor_pabi_sejahtera', 'KeanggotaanController@div_nomor_pabi_sejahtera');
		Route::post('/member/myprofilemember/{id}/edit/simpan_div_nomor_pabi_sejahtera', 'ProfileController@simpan_div_nomor_pabi_sejahtera');

		Route::post('/member/master_borang/tindakan_by_jenis_tindakan', 'BorangController@tindakan_by_jenis_tindakan');
	});
});

Route::get('/list_dokter', 'PublicDokterController@list_dokter');
Route::post('/identitas_dokter/{name}', 'PublicDokterController@detail_per_dokter')->name('public_identitas_dokter');
Route::post('/master_dokter/div_public_tabel_master_dokter', 'PublicDokterController@div_public_tabel_master_dokter');


Route::get('/berita-acara', 'PublicDokterController@berita_acara');
Route::get('/berita-acara/{nama}/{id}', 'PublicDokterController@berita_acara_detail');
Route::get('/tentang-pabi', 'PublicDokterController@tentang_pabi');