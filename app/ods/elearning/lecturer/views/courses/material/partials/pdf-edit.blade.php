
<!-- kalo dia jenisnya PDF-->
<div class="form-group">
    <label class="control-label col-lg-2">File</label>
    <div class="col-lg-10">
        <input name="content[file]" type="file" class="file-styled" accept="application/pdf">
        <span class="help-block">Hanya menerima file pdf, ukuran maksimal 15MB</span>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-2">Keterangan Tambahan</label>
    <div class="col-md-10">
        <textarea name="description[file]" class="textarea form-control" rows="1" style="resize:vertical;">{{$material->instance->description}}</textarea>
    </div>
</div>
