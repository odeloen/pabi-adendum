function alertKu2(tipe, judul, isi){ 
	var warnabtn = "#FF5722";
	if(tipe == 'success'){ warnabtn = "#4CAF50"; }
    swal({
    	html: true,
        title: judul,
        text: isi,
        confirmButtonColor: warnabtn,
        type: tipe
    });  
}

function alertKu(tipe, isi){ 
	var warnabtn = "#FF5722";
	if(tipe == 'success'){ warnabtn = "#4CAF50"; }
    swal({
    	html: true,
        title: isi,
        text: "",
        confirmButtonColor: warnabtn,
        type: tipe
    });  
}

function _(el){
    return document.getElementById(el);
}
function tgl(id){
	$(id).toggle();
}
function openModal(id){
	$(id).modal('show');
} 
function openModalIndex(id){
	// alert(id);
	$(id).modal('show');
}
function closeModal(id){
	// alert(id);
	$(id).modal('hide');
}
function closeBgModal(){
	$(document.body).removeClass("modal-open");
	$(".modal-backdrop").remove();
}