@extends('Ods\Core::template.master')

@section('addcss')
<style>
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
<div class="col-sm-12">
    <div class="panel panel-flat border-top-xlg border-top-indigo">
        <div class="panel-heading" style="margin-bottom:-10px">
            <h5 class="panel-title"><span class="text-semibold">{{$announcement->title}}</h5>
            dibuat pada tanggal <span style="color: #3F51B5">{{$announcement->createdAtString}}</span>
        </div>
        <hr>

        
        <div class="panel-body">
            <img src="{{env('APP_URL')}}/sl/images/{{$announcement->imagePath}}" class="img-responsive content-group" style="display: block;margin-left: auto;margin-right: auto;max-height:300px;max-width:300px;">
            <br>
            {{$announcement->description}}
        </div>
        
    </div>
</div>

<div id="modal_image" class="modal" style="overflow-y: auto; background-color: rgb(0,0,0);background-color: rgba(0,0,0,0.9);">
    <span class="close_image">&times;</span>
    <img class="modal-content" id="img01">
</div>-->
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