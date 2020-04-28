<div class="row">
    @include('public_admin.include.function')
    @php
    $i=1; 
    @endphp 
    @if (!empty($data_anak))
    @foreach ($data_anak as $dak)
    <?php 
    $member_anak_id = $dak['id'];
    $member_id = $dak['member_id']; 
    $gender="Laki-laki";
    if($dak['gender'] == 'P'){
        $gender = "Perempuan";
    }
    ?>
    <div class="col-md-6">
        <div class="panel panel-body">
            <div class="media">
                <div class="media-left"> 
                    {{ $i++ }}.
                </div>

                <div class="media-body">
                    <h6 class="media-heading">{{ $dak['nama_anak'] }}</h6>
                    <span class="text-muted">
                        {{ $gender }} 
                    </span>
                    <p>
                        Lahir di {{ $dak['nama_kota_tempat_lahir'] }}, {!! tgl_indo($dak['tgl_lahir_anak']) !!} 
                    </p>
                </div>

                @if(empty($view) && $view != 'view')
                <div class="media-right media-middle">
                    <ul class="icons-list">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="icon-menu7"></i></a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                    <button type="button" class="btn btn-danger btn-xs btn-block" onclick="delete_myprofile_member_anak('{{csrf_token()}}','{{ $member_anak_id }}','{{ $member_id }}')"><i class="fas fa-trash-alt pull-right"></i> Hapus
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