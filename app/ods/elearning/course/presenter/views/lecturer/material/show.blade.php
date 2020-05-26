
@extends('Ods\Core::template.master')
<?php
/**
 * @var \App\Ods\Elearning\Course\Presenter\Models\MaterialDetailViewModel $data
 */
?>
@section('addcss')
<style>
    .content-group{
        margin-top: 20px;
    }
</style>

@endsection

@section('content')
@if ($data->material->isModified())
    <a href="#" target="_blank">
        <div class="alert alert-danger alert-styled-left alert-bordered" style="cursor:pointer">
            Materi ini belum diverifikasi admin.<span class="text-semibold"> Silahkan membuat pengajuan</span>
        </div>
    </a>
@endif
@if (!$data->course->isLocked() && $data->course->isModified())
    <div class="alert alert-warning alert-styled-left">
        Kelas ini sedang dalam proses verifikasi admin
    </div>
@endif
<div class="col-lg-12">
    <div class="panel panel-flat border-top-xlg border-top-indigo">
        <div class="panel-heading" style="margin-bottom:-10px">
            <h5 class="panel-title"><span class="text-semibold">{{$data->material->name}}</h5>
            oleh <span class="text-primary">{{$data->course->lecturer}}</span>
            <br>
            diperbarui <span style="color: #3F51B5">{{$data->material->updated_at_string}}</span>
            <br>
            dari Kelas {{$data->course->name}}, Topik {{$data->topic->name}}
            <br>
            <span style="font-style:italic">Materi ini bersifat
                @if ($data->material->isPublic())
                    umum
                @else
                    tidak umum
                @endif
            </span>
            <div class="heading-elements">
                <a href="{{route('elearning.lecturer.material.edit', [$data->course->id, $data->topic->id, $data->material->id])}}">
                    <button class="btn bg-primary">Edit Materi</button>
                </a>
            </div>
        </div>
        <hr>
        @include('Ods\Elearning\Common::material.partials.'.$data->material->getView())
    </div>
</div>
<div id="modal_comment" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Alasan Penolakan</h5>
            </div>

            <form action="#">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <blockquote style="border-left:10px solid #777777; background:#eeeeee;">
                                    <p>Bukti terlampir tidak valid</p>
                                </blockquote>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

