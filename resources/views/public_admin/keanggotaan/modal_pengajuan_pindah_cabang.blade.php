<form onsubmit="simpan_pengajuan_pindah_cabang('{{csrf_token()}}', '{{ $id_member }}', '.btn_pindah_cb_data_file'); return false;  " class="form-horizontal div_pengajuan_pindah_cabang" enctype="multipart/form-data" id="formPindahCabang"
      method="POST">
	<div class="row">
		<div class="col-md-12">
			<?php
			// print_r($data_member); exit();
			?>
			<div class="form-group">
				{{ csrf_field() }}
			</div>
			<div class="form-group">
				<label style="text-align: right;" class="col-md-4 control-label">
					Dari Cabang :
				</label>
				<label class="col-md-7 control-label">
					{{ $data_member['admin_cabang_nama'] }}
					<input type="hidden" name="pindah_cb_dari" id="pindah_cb_dari"
					       value="{{ $data_member['admin_cabang_id'] }}">
				</label>
			</div>
			<div class="form-group">
				<label style="text-align: right;" class="col-md-4 control-label">
					Ke Cabang <span style="color:red"><b>*</b></span> :
				</label>
				<div class="col-md-7">
					<select required="required" data-placeholder="Pilih" class="select22" name="pindah_cb_ke"
					        id="pindah_cb_ke" required="" style="width: 100%">
						<option value="" admpstid="">-- Pilih --</option>
						<?php
						foreach ($data_admin_cabang as $dac) {
							if ($dac['id'] != $data_member['admin_cabang_id']) {
								echo '<option value="' . $dac['id'] . '" admpstid="' . $dac['admin_pusat_id'] . '" >' . $dac['name'] . '</option>';
							}
						}
						?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="file_name" style="text-align: right;" class="col-md-4 control-label">
					Lampiran File <span style="color:red"><b>*</b></span> :
				</label>
				<div class="col-md-7">
					<input required="required" type="file" name="pindah_cb_file_name" id="pindah_cb_file_name"
					       class="file-styled">
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-11">
					<button style="float: right;" type="submit" 
					        class="btn btn-primary btn-ladda btn_pindah_cb_data_file" data-style="expand-left"
					        data-spinner-color="#333" data-spinner-size="20">
						<i class="icon-check"></i> Simpan
					</button>
					<button style="float: right;" type="button" class="btn btn-danger "
					        onclick="$('.modal').modal('hide');">
						<i class="icon-cross"></i> Batal
					</button>
				</div>
			</div>
		</div>
	</div>
</form>
<script type="text/javascript">
	$(document).ready(function () {
		$('.select22').select2();
	});
</script>