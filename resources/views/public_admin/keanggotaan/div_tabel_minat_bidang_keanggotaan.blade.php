<div class="row">
    @php
    $i=1; 
    @endphp 
    @if (!empty($data_minat_bidang))
    @foreach ($data_minat_bidang as $dmb)
    <?php 
    $member_minat_bidang_id = $dmb['id'];
    $member_id = $dmb['member_id']; 
    ?>
    <div class="col-md-4">
        <div class="panel panel-body">
            <div class="media">
                <div class="media-left"> 
                    {{ $i++ }}.
                </div>

                <div class="media-body">
                    <h6 class="media-heading">{{ $dmb['jenis_minat'] }}</h6>
                    <span class="text-muted"></span>
                    <p>
                        {{ $dmb['nama'] }}
                    </p>
                </div>

                @if(empty($view) && $view != 'view')
                <div class="media-right media-middle">
                    <ul class="icons-list">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="icon-menu7"></i></a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                    <button type="button" class="btn btn-danger btn-xs btn-block" onclick="delete_myprofile_member_minat_bidang('{{csrf_token()}}','{{ $member_minat_bidang_id }}','{{ $member_id }}')"><i class="fas fa-trash-alt pull-right"></i> Hapus
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