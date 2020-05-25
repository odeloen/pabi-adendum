@extends('Ods\Core::template.master')


@section('need_sidebar')
<div hidden="hidden">{{$need_sidebar="1"}}</div>
@endsection


@section('content')
<div class="col-sm-3">
    
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
<div class="col-sm-9">
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
</div>



@endsection

@section('sidebar-right')
    <div class="sidebar sidebar-opposite sidebar-default sidebar-separate">
        <div class="sidebar-content" >
        
            <a href="">
                <button type="button" class="btn bg-warning-300 btn-float btn-float-lg" style="width:100%; margin-bottom: 10px;">
                    <i class=" icon-checkmark"></i> <span>Selesai</span>
                </button>
            </a>
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title"><i class="icon-watch position-left"></i> Durasi</h6>
                </div>

                <div class="panel-body">

                    <ul class="timer mb-10">
                        <li>
                            09 <span>jam</span>
                        </li>
                        <li class="dots">:</li>
                        <li>
                            54 <span>menit</span>
                        </li>
                        <li class="dots">:</li>
                        <li>
                            29 <span>waktu</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="panel panel-flat border-top-primary">
                
                <div class="panel-body text-center">
                    <h6><span class="text-semibold">Batas Nilai Bawah Kelulusan</h6>
                    <h2><span class="text-semibold">80</h2>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('addjs')

@endsection