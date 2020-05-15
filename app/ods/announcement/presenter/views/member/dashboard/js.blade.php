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
