@extends('Ods\Core::template.master')


@section('two_sidebar')
<div hidden="hidden">{{$two_sidebar="1"}}</div>
@endsection


@section('content')
<div class="alert alpha-indigo border-indigo alert-styled-left">
    Ujian Kelas <b>Nama Kelas</b>
</div>
<div class="panel panel-flat border-left-xlg border-left-indigo">
    <div class="panel-heading">
        <span class="label label-default" style="font-size: 22pt;margin-bottom:5px;">78</span>
        <br>
        <h4 class="panel-title"><span class="text-semibold">Pertanyaan:</h4>
    </div>
    
    
    <div class="panel-body" style="font-size:12pt;">
        Pertanyaan
    </div>
</div>

<div class="panel panel-white">
    <div class="panel-heading">
        <div class="panel-title text-semibold">
            <h5>Jawaban Benar Pertanyaan Terkait</h5>
        </div>
    </div>

    <div class="panel-body text-center" >
        <div class="btn-toolbar">
            <div class="btn-group">
                <button type="button" class="btn btn-success" style="width:18%; margin-bottom:5px;">A</button>
                <button type="button" class="btn btn-default" style="width:18%; margin-bottom:5px;">B</button>
                <button type="button" class="btn btn-default" style="width:18%; margin-bottom:5px;">C</button>
                <button type="button" class="btn btn-default" style="width:18%; margin-bottom:5px;">D</button>
                <button type="button" class="btn btn-default" style="width:18%; margin-bottom:5px;">E</button>
            </div>
        </div>
    </div>
</div>
<div class="panel panel-flat border-left-lg border-left-info">
    <div class="panel-body">
        <span class="label label-warning" style="font-size: 10pt;margin-bottom:5px;">Jawaban A</span>
        <br>
        Jawaban
    </div>
</div>
<div class="panel panel-flat border-left-lg border-left-info">
    <div class="panel-body">
        <span class="label label-warning" style="font-size: 10pt;margin-bottom:5px;">Jawaban B</span>
        <br>
        Jawaban
    </div>
</div>
<div class="panel panel-flat border-left-lg border-left-info">
    <div class="panel-body">
        <span class="label label-warning" style="font-size: 10pt;margin-bottom:5px;">Jawaban C</span>
        <br>
        Jawaban
    </div>
</div>
<div class="panel panel-flat border-left-lg border-left-info">
    <div class="panel-body">
        <span class="label label-warning" style="font-size: 10pt;margin-bottom:5px;">Jawaban D</span>
        <br>
        Jawaban
    </div>
</div>
<div class="panel panel-flat border-left-lg border-left-info">
    <div class="panel-body">
        <span class="label label-warning" style="font-size: 10pt;margin-bottom:5px;">Jawaban E</span>
        <br>
        Jawaban
    </div>
</div>
<div id="modal_setting" class="modal fade" tabindex="-1" style="overflow-y: auto;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-teal-700">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Pengaturan Kuis</h5>
            </div>

            <form action="" method="POST"  enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Durasi:</label>
                        <div class="input-group">
                            <input type="text" class="form-control">
                            <span class="input-group-addon">menit</span>
                        </div>    
                    </div>
                    
                    <div class="form-group">
                        <label>Nilai Batas Bawah Kelulusan:</label>
                        <input type="text" class="form-control" name="verdict" id="inputNumber">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('sidebar-right')
    <div class="sidebar sidebar-opposite sidebar-default sidebar-separate">
        <div class="sidebar-content" >
        
            <a href="">
                <button type="button" class="btn bg-grey-300 btn-float btn-float-lg" style="width:100%; margin-bottom: 10px;">
                    <i class="icon-circle-left2"></i> <span>Kembali ke Kelas</span>
                </button>
            </a>
            <div class="panel panel-flat border-top-primary">
    
                <div class="panel-body text-center">
                    <h6><span class="text-semibold">Waktu Pengerjaan</h6>
                    <h2><span class="text-semibold">120 menit</h2>
                </div>
            </div>
            <div class="panel panel-flat border-top-primary">
                
                <div class="panel-body text-center">
                    <h6><span class="text-semibold">Batas Nilai Bawah Kelulusan</h6>
                    <h2><span class="text-semibold">80</h2>
                </div>
            </div>
            <div class="panel panel-white">
                <div class="panel-heading">
                    <div class="panel-title text-semibold">
                        Soal
                    </div>
                </div>

                <div class="panel-body text-center">
                    <div class="btn-toolbar">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default" style="width:32%; margin-bottom:5px;">999</button>
                            <button type="button" class="btn btn-default" style="width:32%; margin-bottom:5px;">1</button>
                            <button type="button" class="btn btn-default" style="width:32%; margin-bottom:5px;">1</button>
                            <button type="button" class="btn btn-default" style="width:32%; margin-bottom:5px;">1</button>
                            <button type="button" class="btn btn-default" style="width:32%; margin-bottom:5px;">1</button>
                            <button type="button" class="btn btn-default" style="width:32%; margin-bottom:5px;">1</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('addjs')

@endsection