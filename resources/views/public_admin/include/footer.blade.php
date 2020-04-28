<div class="navbar navbar-default navbar-fixed-bottom footer">
	<ul class="nav navbar-nav visible-xs-block">
		<li><a class="text-center collapsed" data-toggle="collapse" data-target="#footer"><i class="icon-circle-up2"></i></a></li>
	</ul>

	<div class="navbar-collapse collapse" id="footer">
		<div class="navbar-text" style="text-align: center;">
			&copy; 2019. <a href="#" class="navbar-link">PABI - Membership</a> by <a href="https://kodig.id/" class="navbar-link" target="_blank">Rumah Sinergi Karya</a>
		</div>

		<div class="navbar-right">
			<ul class="nav navbar-nav">
				<!-- <li><a href="#">About</a></li>
				<li><a href="#">Terms</a></li>
				<li><a href="#">Contact</a></li> -->
			</ul>
		</div>
	</div>
</div>

<!-- /footer --> 
<script type="text/javascript"> 
    if($('.select22').length){
        $('.select22').select2();
    }
    // START SCRIPT TABEL
    $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,
            width: '100px' 
        }], 
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        language: {
            search: '<span>Filter:</span> _INPUT_',
            // searchPlaceholder: 'Type to filter...',
            lengthMenu: '<span>Menampilkan :</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
        },
        drawCallback: function () {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
        },
        preDrawCallback: function() {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
        }
    }); 
    $('.datatable-basic').DataTable();
    // END SCRIPT TABEL 
</script>
<!-- /footer --> 