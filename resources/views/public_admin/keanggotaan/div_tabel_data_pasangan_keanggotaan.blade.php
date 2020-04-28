<div class="row">
    @include('public_admin.include.function')
    @php
    $i=1; 
    @endphp 
    @if (!empty($data_pasangan))
    @foreach ($data_pasangan as $dps)
    <?php  
    $member_pasangan_id = $dps['id'];
    $member_id = $dps['member_id']; 
    $gender="Laki-laki";
    if($dps['gender'] == 'P'){
        $gender = "Perempuan";
    }
    ?>
    <div class="col-lg-6 col-md-12">
        <div class="panel panel-body">
            <div class="media">
                <div class="media-left"> 
                    {{ $i++ }}.
                </div>

                <div class="media-body">
                    <h6 class="media-heading">{{ $dps['nama_pasangan'] }}</h6>
                    <span class="text-muted">
                        {{ $dps['pekerjaan_pasangan'] }}
                    </span>
                    <p>
                        {{ $gender }}<br>
                        Lahir di {{ $dps['nama_kota_tempat_lahir'] }}, {!! tgl_indo($dps['tgl_lahir_pasangan']) !!}
                        <br>
                        Alamat {{ $dps['alamat_rumah_pasangan'] }} {{ $dps['nama_kota_pasangan'] }}
                    </p>
                </div>

                @if(empty($view) && $view != 'view')
                <div class="media-right media-middle">
                    <ul class="icons-list">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="icon-menu7"></i></a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                    <button type="button" class="btn btn-danger btn-xs btn-block" onclick="delete_myprofile_member_pasangan('{{csrf_token()}}','{{ $member_pasangan_id }}','{{ $member_id }}')"><i class="fas fa-trash-alt pull-right"></i> Hapus
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