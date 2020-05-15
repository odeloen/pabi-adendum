@extends('Ods\Core::template.master')

@section('addcss')
<style>]

.blog-horizontal:hover{
  margin-top: -7px;
 -moz-box-shadow:    0 0 20px #b4abab;
 -webkit-box-shadow: 0 0 20px #b4abab;
 box-shadow:         0 0 20px #b4abab;
}

/* Modal Content (image) */
.modal-content {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}

@-webkit-keyframes zoom {
  from {-webkit-transform:scale(0)} 
  to {-webkit-transform:scale(1)}
}

@keyframes zoom {
  from {transform:scale(0)} 
  to {transform:scale(1)}
}

/* The Close Button */
.close_image {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close_image:hover,
.close_image:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }
}


</style>
@endsection
@section('content')
<div class="panel panel-primary">
    <div class="panel-heading " style="background: #00838F;">
        <h6 class="panel-title">Announcement</h6>
    </div>
    <div class="panel-body">
        <div class="col-lg-6">
            <a data-target="#modal_detail" data-toggle="modal" href="#modal_detail" style="text-decoration:none;color:inherit;">
                <div class="panel panel-flat blog-horizontal blog-horizontal-2" style="cursor:pointer;">

                    <div class="panel-body">
                        <div class="col-lg-12">
                            <div class="thumb">
                                <img src="{{asset('landscape.jpg')}}" style="height:200px; width:auto;" alt="">
                            </div>

                            <div class="blog-preview">
                                <div class="content-group-sm media blog-title stack-media-on-mobile text-left">
                                    <div class="media-body">
                                        <h5 class="text-semibold no-margin">ohhh</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-6">
            <a data-target="#modal_detail" data-toggle="modal" href="#modal_detail" style="text-decoration:none;color:inherit;">
                <div class="panel panel-flat blog-horizontal blog-horizontal-2" style="cursor:pointer;">

                    <div class="panel-body">
                        <div class="col-lg-12">
                            <div class="thumb">
                                <img src="{{asset('portrait.jpg')}}" style="height:200px; width:auto;" alt="">
                            </div>

                            <div class="blog-preview">
                                <div class="content-group-sm media blog-title stack-media-on-mobile text-left">
                                    <div class="media-body">
                                        <h5 class="text-semibold no-margin">ohhh</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        
    </div>
</div>
<div id="modal_detail" class="modal fade" tabindex="-1" style="overflow-y: auto;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Detail Announcement</h5>
            </div>

            <div class="modal-body">
                <h6 class="text-semibold">Judul</h6>
                <img class="myImg" src="{{asset('portrait.jpg')}}" alt="Snow" style="width:100%;max-width:250px;display: block;margin-left: auto; margin-right: auto; margin-bottom:10px">
				<p>Konten</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<div id="modal_image" class="modal" style="overflow-y: auto; background-color: rgb(0,0,0);background-color: rgba(0,0,0,0.9);">
    <span class="close_image">&times;</span>
    <img class="modal-content" id="img01">
</div>
@endsection

@section('addjs')
<script type="text/javascript">
//code for image zoom
var modal = document.getElementById("modal_image");
    var img = document.getElementsByClassName("myImg");
    var modalImg = document.getElementById("img01");
    for(var i=0;i<img.length;i++){
        img[i].onclick = function(){
            modal.style.display = "block";
            modalImg.src = this.src;
        }
    }
    
    //close using x button
    var span = document.getElementsByClassName("close_image")[0];
    span.onclick = function() { 
        modal.style.display = "none";
    }

    //close when click outside picture
    $("#modal_image").click(function(ev){
        if(ev.target != this) return;
        modal.style.display = "none";
    });

    //close when esc key down
    $(document).keydown(function(event) { 
        if (event.keyCode == 27) { 
            modal.style.display = "none";
        }
    });
    //end code
</script>
@endsection