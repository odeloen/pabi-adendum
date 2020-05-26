
<!-- kalo dia jenisnya Video-->
<div class="form-group">
    <label class="control-label col-md-2">URL</label>
    <div class="col-md-10">
        <input name="video_content" class="form-control" type="url" value="{{$data->material->content['video_path']}}">
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-2">Keterangan Tambahan</label>
    <div class="col-md-10">
        <textarea name="video_description" class="textarea form-control" rows="1" style="resize:vertical;">{{$data->material->description}}</textarea>
    </div>
</div>
