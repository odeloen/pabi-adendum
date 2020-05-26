@extends('Ods\Core::template.master')


@section('two_sidebar')
<div hidden="hidden">{{$two_sidebar="1"}}</div>
@endsection


@section('content')
<div class="alert alpha-indigo border-indigo alert-styled-left">
    Ujian Kelas <b>Nama Kelas</b>
</div>
<div class="text-right mt-5 mb-10">
    <button class="btn bg-grey-300">Hapus Pertanyaan dan Jawaban</button>
</div>
<div class="panel panel-flat border-left-xlg border-left-indigo mt-8">
    <div class="panel-heading">
        <span class="label label-default" style="font-size: 22pt;margin-bottom:5px;">78</span>
        
        <br>
        <h4 class="panel-title"><span class="text-semibold">Pertanyaan:</h4>
    </div>
    
    
    <div class="panel-body">
        <textarea name="content[editor]" id="editor-full" rows="4" cols="4">
        </textarea>
    </div>
</div>

<div class="panel panel-white">
    <div class="panel-heading">
        <div class="panel-title text-semibold">
            <h5>Jawaban Benar Pertanyaan Terkait</h5>
        </div>
    </div>

    <div class="panel-body text-center" >
        <div class="col-lg-12">
            <label class="radio-inline" style="font-size: 12pt;">
                <div class="choice"><input type="radio" class="control-custom" ></div>
                A
            </label>
            <label class="radio-inline"style="font-size: 12pt;">
                <div class="choice"><input type="radio" class="control-custom" ></div>
                B
            </label>
            <label class="radio-inline"style="font-size: 12pt;">
                <div class="choice"><input type="radio" class="control-custom" ></div>
                C
            </label>
            <label class="radio-inline"style="font-size: 12pt;">
                <div class="choice"><input type="radio" class="control-custom" ></div>
                D
            </label>
            <label class="radio-inline"style="font-size: 12pt;">
                <div class="choice"><input type="radio" class="control-custom" ></div>
                E
            </label>
        </div>
    </div>
</div>
<div class="panel panel-flat border-left-lg border-left-info">
    <div class="panel-body">
        <span class="label label-warning" style="font-size: 10pt;margin-bottom:5px;">Jawaban A</span>
        <textarea name="content[editor]" class="editor-answer" rows="2" cols="4">
        </textarea>
    </div>
</div>
<div class="panel panel-flat border-left-lg border-left-info">
    <div class="panel-body">
        <span class="label label-warning" style="font-size: 10pt;margin-bottom:5px;">Jawaban B</span>
        <textarea name="content[editor]" class="editor-answer" rows="2" cols="4">
        </textarea>
    </div>
</div>
<div class="panel panel-flat border-left-lg border-left-info">
    <div class="panel-body">
        <span class="label label-warning" style="font-size: 10pt;margin-bottom:5px;">Jawaban C</span>
        <textarea name="content[editor]" class="editor-answer" rows="2" cols="4">
        </textarea>
    </div>
</div>
<div class="panel panel-flat border-left-lg border-left-info">
    <div class="panel-body">
        <span class="label label-warning" style="font-size: 10pt;margin-bottom:5px;">Jawaban D</span>
        <textarea name="content[editor]" class="editor-answer" rows="2" cols="4">
        </textarea>
    </div>
</div>
<div class="panel panel-flat border-left-lg border-left-info">
    <div class="panel-body">
        <span class="label label-warning" style="font-size: 10pt;margin-bottom:5px;">Jawaban E</span>
        <textarea name="content[editor]" class="editor-answer" rows="2" cols="4">
        </textarea>
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
            <button type="button" class="btn bg-teal-700 btn-float btn-float-lg" style="width:100%; margin-bottom: 10px;" data-toggle="modal" data-target="#modal_setting">
                <i class="icon-cog"></i> <span>Pengaturan Kuis</span>
            </button>
            <a href="">
                <button type="button" class="btn bg-indigo-800 btn-float btn-float-lg" style="width:100%; margin-bottom: 10px;">
                    <i class="icon-floppy-disk"></i> <span>Simpan Soal dan Jawaban</span>
                </button>
            </a>
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

                <div class="panel-footer no-padding">
                    <a href="#" class="btn btn-default btn-block no-border">Tambah Soal</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('addjs')
<script src="{{asset('template/global_assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
<script src="{{asset('template/global_assets/js/plugins/editors/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('template/global_assets/js/plugins/forms/inputs/touchspin.min.js')}}"></script>
<script>

$(".control-custom").uniform({
    wrapperClass: 'border-indigo-600'
});

CKEDITOR.replaceAll('editor-answer', {
    height: 50,
    extraPlugins: 'forms'
});
CKEDITOR.replace('editor-full', {
    height: 200,
    extraPlugins: 'forms'
});
    $("input[name='verdict']").TouchSpin({
        min: 0,
        max: 100,
        step: 0.1,
        decimals: 2,
        initval: 60,
        boosted:5,
        maxboostedstep:10,
    });
</script>
@endsection