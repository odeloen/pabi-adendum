
<div class="content-group">
    <textarea name="post_content" id="editor-full" rows="4" cols="4">
        {{$data->material->content['post_content']}}
    </textarea>
</div>

<script src="{{asset('template/global_assets/js/plugins/editors/ckeditor/ckeditor.js')}}"></script>
<script>
    //code for via post
    // Setup
    CKEDITOR.replace('editor-full', {
        height: 400,
        extraPlugins: 'forms'
    });
    //end code
</script>
