<div class="row">
    @include('public_admin.include.function')
    @php
    $i=1; 
    @endphp 
    @if (!empty($data_praktek))
    @foreach ($data_praktek as $dapr)
    <?php 
    $member_praktek_id = $dapr['id'];
    $member_id = $dapr['member_id'];  
    ?>
    <div class="col-md-6">
        <div class="panel panel-body">
            <div class="media">
                <div class="media-left"> 
                    {{ $i++ }}.
                </div>

                <div class="media-body">
                    <h6 class="media-heading">{{ $dapr['no_sip'] }}</h6>
                    <span class="text-muted">
                        Tempat Praktek :{{ $dapr['nama_tempat'] }} 
                    </span>
                    <p>
                        Tanggal SIP : {!! tgl_indo($dapr['tgl_sip']) !!} 
                    </p>
                </div>

                @if(empty($view) && $view != 'view')
                <div class="media-right media-middle">
                    <ul class="icons-list">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="icon-menu7"></i></a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                    <button type="button" class="btn btn-danger btn-xs btn-block" onclick="delete_myprofile_member_praktek('{{csrf_token()}}','{{ $member_praktek_id }}','{{ $member_id }}')"><i class="fas fa-trash-alt pull-right"></i> Hapus
                                    </button>
                                </li> 
                            </ul>
                        </li>
                    </ul>
                </div>
                @endif
            </div>
        </div>
    </div> 
    @endforeach
    @else 
    <div class="col-sm-12">
        <div class="panel panel-flat border-left-danger row">  
            <div class="panel-body col-sm-10"> 
                <b>
                    Tidak Ada Data
                </b> 
            </div>
            <div class="panel-body col-sm-2" style="background-color: #ffcccc; height: 100%"> 
                <b>-</b> 
            </div>
        </div>
    </div> 
    @endif 
</div> 