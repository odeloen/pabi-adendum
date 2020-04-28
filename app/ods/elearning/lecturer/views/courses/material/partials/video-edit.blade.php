
<!-- kalo dia jenisnya Video-->
<div class="form-group">
    <label class="control-label col-md-2">URL</label>
    <div class="col-md-10">
        <input name="content[video_url]" class="form-control" type="url" value="{{$material->instance->video_path}}">
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-2">Keterangan Tambahan</label>
    <div class="col-md-10">
        <textarea name="description[video]" class="textarea form-control" rows="1" style="resize:vertical;">{{$material->instance->description}}</textarea>
    </div>
</div>
