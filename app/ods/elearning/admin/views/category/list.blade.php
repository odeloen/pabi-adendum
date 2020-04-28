
@extends('Ods\Core::template.master')
@section('addcss')
<style>
.dz-details{
    height:100px;
}
</style>
@endsection
@section('content')
@if (!empty($categories))
<div class="row">
    <div class="col-sm-9">
        <div class="panel panel-primary">
            <div class="panel-heading panel-indigo">
                <h6 class="panel-title">Daftar Kategori</h6>
            </div>

            <div class="panel-body">
                <table class="table datatable-basic table-hover table-bordered">
                    <thead>
                        <tr>
                            <th><center>Kategori</center></th>
                            <th class="text-center" style="width:200px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{$category->name}}</td>
                                <form action="{{route('admin.category.delete')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="category_id" value="{{$category->id}}">
                                <td class="text-center" >
                                    <button onclick="onClickUpdate({{$category->id}})" type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_update"><span>Ubah</span></button>
                                    <button type="submit" class="btn btn-default"><span>Hapus</span></button>
                                </td>
                                </form>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="panel panel-primary">
            <div class="panel-heading panel-indigo">
                <h6 class="panel-title">Tambah Data Kategori</h6>
            </div>
            <div class="panel-body">
                <form action="{{route('admin.category.create')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Kategori</label>
                        <input name="name" type="text" class="form-control">
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary legitRipple">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="modal_update" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <form action="{{route('admin.category.update')}}" method="post">
            @csrf
            <input id="update_category_id" type="hidden" name="category_id">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Ubah Kategori</h4>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label style="color:#4C568A">Kategori</label>
                        <input id="update_category_name" name="name" type="text" class="form-control" >
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endif
@endsection
@section('addjs')
<script src="{{asset('template/global_assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
<script type="text/javascript">
    // START SCRIPT TABEL
    $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{
            orderable: true,
        }],
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        language: {
            search: '<span>Cari:</span>',
            lengthMenu: '<span>Menampilkan :</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' },
            emptyTable: '<span>Tidak ada data untuk ditampilkan</span>',
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
            zeroRecords:"Tidak ditemukan data yang sesuai",
        },
        drawCallback: function () {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
        },
        preDrawCallback: function() {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
        }
    });
    $('.datatable-basic').DataTable({

    });
    // END SCRIPT TABEL
</script>
@if (!empty($categories))
<script>
    let categories = {!!$categories!!}
    function getCategory(categoryID){
        var category = null
        for (i=0;i<categories.length;i++){
            if (categories[i].id == categoryID){
                category = categories[i]
                break
            }
        }
        console.log(category)

        return category
    }

    function onClickUpdate(categoryID){
        var category = getCategory(categoryID)

        if (category == null) return
        setUpdateModal(category)
    }

    function setUpdateModal(category){
        $('#update_category_id').val(category.id)
        $('#update_category_name').val(category.name)
    }
</script>
@endif
@endsection
