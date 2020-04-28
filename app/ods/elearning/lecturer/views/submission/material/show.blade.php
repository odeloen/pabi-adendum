
@extends('Ods\Core::template.master')

@section('addcss')
<style>
    .content-group{
        margin-top: 20px;
    }
</style>

@endsection

@section('content')
@if (!empty($course))
<div class="panel panel-flat border-top-xlg border-top-indigo">
    <div class="panel-heading" style="margin-bottom:-10px">
        <h5 class="panel-title"><span class="text-semibold">{{$material->instance->name}}</h5>
        oleh <span class="text-primary">{{$lecturer->fullname}}</span>
        <br>
        diperbarui <span style="color: #3F51B5">{{$material->instance->updated_at_string}}</span>
        <br>
        dari Kelas {{$course->instance->name}}, Topik {{$topic->instance->name}}
        <br>
        <span style="font-style:italic">Materi ini bersifat
            @if ($material->instance->isPublic())
                umum
            @else
                tidak umum
            @endif
        </span>
    </div>
    <hr>

    @include('Ods\Elearning\Core::materials.partials.'.$material->type->view)
</div>
<div id="modal_comment" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Alasan Penolakan</h5>
            </div>

            <form action="#">
                <div class="modal-body">
                    <form action="#" class="form-horizontal">
                        <div class="form-group" style="margin-left:1%; margin-right:1%">
                            <textarea class="form-control" rows="1" id="test" placeholder="Alasan pengajuan ditolak" style="resize:vertical;"></textarea>
                        </div>
                    </form>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn bg-pink">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection

@section('addjs')
<script src="{{asset('template/global_assets/js/plugins/forms/inputs/autosize.min.js')}}"></script>
<script>
    //code for autoresize textarea
    var ta = document.querySelector('textarea');

    autosize(ta);

    // Dispatch a 'autosize:update' event to trigger a resize:
    var evt = document.createEvent('Event');
    evt.initEvent('autosize:update', true, false);
    ta.dispatchEvent(evt);
    //end code
</script>
@endsection
