@include('public_admin.include.function')
<table class="table table-bordered table-hover datatable-basic">
	<thead>
		<tr>
			<th width="1%">No</th>
			<th>Tanggal</th> 
			<th>Kegiatan</th>
			<th>Nilai SKP</th>
			<th>Status</th>
			<th style="width: 1%">Act</th> 
		</tr>
	</thead>
	<tbody>
		<?php $no = 0; ?>
		@foreach ($data_kegiatan as $r)
		<?php 
		$no ++; 
		$id = $r['id'];
		$rb_id = $r['ranah_borang_id'];
        //$s_ver_cab = '<span class="label label-flat border-grey text-grey-600">Belum Diajukan</span>';
		$s_ver_cab = '<span class="label label-flat border-primary text-primary-600">Diproses</span>';
		if ($r['cabang_verif'] == 2) {
			$s_ver_cab = '<span class="label label-flat border-danger text-danger-600">Ditolak</span>';
		} else if ($r['cabang_verif'] == 1) {
			$s_ver_cab = '<span class="label label-flat border-success text-success-600">Disetujui</span>';
		} 
        // else if ($r['cabang_verif'] == 1) {
        //     $s_ver_cab = '<span class="label label-flat border-primary text-primary-600">Progress</span>';
        // }
		?>
		<tr>
			<td>{{ $no }}</td>
			<td>{!! tgl_indo($r['tgl']) !!}</td> 
			<td>
				<small>
					Nama : <b>{{ $r['nama_member'] }}</b>
					<br>Rumah Sakit : <b>{{ $r['rumah_sakit'] }}</b>
					<br>Ranah : <b>{{ $r['nama_ranah'] }}</b>
					<br>Jenis : <b>{{ $r['nama_jenis_kegiatan'] }}</b>
					<br>Keg : <b>{{ $r['nama_kegiatan'] }}</b>
				</small>
			</td>
			<td>{{ $r['nilai_skp'] }}</td>
			<td> 
				<?php
				if ($s_ver_cab == '' && 1==0) {
					?>
					<button type="button" onclick="ajukan_borang('{{csrf_token()}}', '{{$id}}', '{{$rb_id}}')" id="modal_update_barang" class="btn bg-grey-400 btn-xs btn-block">
						<i class="glyphicon glyphicon-send"></i> Ajukan
					</button>
					<?php
				} else {
					echo $s_ver_cab;
				}
				?>
			</td>
			<td> 
				<ul class="dropdown-menus">
					<li>
						<button type="button" onclick="
						detail_modal_borang('{{csrf_token()}}', '{{$id}}', '{{$rb_id}}', '#ModalGreenSm')
						" id="modal_update_barang" class="btn bg-green-400 btn-xs btn-block">
						<i class="glyphicon glyphicon-search"></i> Detail Data</button> 
					</li>
					<li>
						<button type="button" onclick="
						update_modal_borang('{{csrf_token()}}', '{{$id}}', '{{$rb_id}}', '#ModalTeal')
						" id="modal_update_barang" class="btn bg-indigo-400 btn-xs btn-block">
						<i class="glyphicon glyphicon-edit"></i> Ubah Data</button> 
					</li> 
					<li>
						<button type="button" onclick="
						upload_modal_borang_file('{{csrf_token()}}', '{{$id}}', '{{$rb_id}}', '#ModalBrown')
						" id="modal_update_barang" class="btn bg-brown-400 btn-xs btn-block">
						<i class="glyphicon glyphicon-file"></i> Borang File</button> 
					</li>
					<li>
						<button type="button" onclick="
						verif_modal_borang('{{csrf_token()}}', '{{$id}}', '{{$rb_id}}', '#ModalKuningSm')
						" id="modal_update_barang" class="btn btn-warning btn-xs btn-block">
						<i class="glyphicon glyphicon-check"></i> Verifikasi</button> 
					</li> 
					<li style="display: none;">
						<button type="button" onclick="delete_master_borang('{{csrf_token()}}', '{{$id}}', '{{$rb_id}}')" data-toggle="modal" class="btn btn-danger btn-xs btn-block">
							<i class="glyphicon glyphicon-remove"></i> Hapus Data
						</button>
					</li>
				</ul> 
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

<script type="text/javascript"> 
    if($('.select22').length){
        $('.select22').select2();
    }
    // START SCRIPT TABEL
    $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,
            width: '100px' 
        }], 
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        language: {
            search: '<span>Filter:</span> _INPUT_',
            // searchPlaceholder: 'Type to filter...',
            lengthMenu: '<span>Menampilkan :</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
        },
        drawCallback: function () {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
        },
        preDrawCallback: function() {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
        }
    }); 
    $('.datatable-basic').DataTable();
    // END SCRIPT TABEL 
</script>