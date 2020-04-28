<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta content="width=device-width, initial-scale=1" name="Login">
   <meta name="author" content="PABI"/>   
   <meta name="description" content="PABI Membership"/>
   <meta name="keywords" content="PABI, PABI-Membership, IDI, Dokter, Dokter Bedah, Medical, Health, Healthcare, Doctor, Clinic, Care, Hospital">  

   <title>PABI Membership</title>
   <link rel="icon" href="{{ asset('assets_login/images/favicon.ico') }}" type="image/x-icon">
   <link href="{{ asset('assets_login/main.css') }}" rel="stylesheet" type="text/css">
   <script type="text/javascript" src="{{ asset('assets_login/jquery.js') }}"></script>
   <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
   <style type="text/css">   
      @media only screen and (min-width: 500px) {
         .materialContainer {
            zoom: 50% ;
         }
         body { 
            background-image: url({{ asset('assets_login/images/bg_dekstop.jpg') }});  
         }
      }
      @media only screen and (max-width: 499px) {
         .materialContainer {
            zoom: 65% ;
         } 
         body { 
            background-image: url({{ asset('assets_login/images/bg_mobile.jpg') }}); 
         }
      }
   </style>
</head>
<body>
<div class="materialContainer">
   @include('sweet::alert')
   <div class="box">
      <div class="title">LOGIN</div>
      @if(!empty($errors->first()))
      <div class="alert alert-danger">
         * <span>{{ $errors->first() }}</span>
      </div>
      @endif
      <form action="{{ url('login_send') }}" method="post">
         @csrf
         <div class="input">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required="">
            <span class="spin"></span>
         </div>

         <div class="input">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required="">
            <span class="spin"></span>
         </div>

         <div class="button login">
            <button><span>GO</span> <i class="fa fa-check"></i></button>
         </div>
         <div class="btn_gmail">
            <button onclick="window.location.href='{{ url('auth/google') }}'" type="button" class="loginBtn loginBtn--google">
              Login with Google
            </button>  
         </div>
      </form> 
      
      <a href="{{ url('begin-forgot-password') }}" class="pass-forgot">Forgot your password?</a>

   </div>

   <div class="overbox" style="padding-top: 10px;">
      <div class="material-button alt-2"><span class="shape"></span></div> 
      <div class="title">REGISTER</div>
      <form action="{{ url('register_send') }}" method="post" onsubmit="if ($('#regpassword').val() == $('#regpassword_confirmation').val()) { return true; } else { alert('Password tidak sama'); return false; }">
         @csrf
         <div class="input">
            <label for="regusername">Username</label>
            <input type="text" name="username" id="regusername" required="" minlength="8">
            <span class="spin"></span>
         </div>

         <div class="input">
            <label for="email">E-Mail</label>
            <input type="email" name="email" id="email" required="">
            <span class="spin"></span>
         </div>

         <div class="input">
            <label for="regpassword">Password</label>
            <input type="password" name="password" id="regpassword" required="" minlength="6">
            <span class="spin"></span>
         </div>

         <div class="input">
            <label for="regpassword_confirmation">Repeat Password</label>
            <input type="password" name="password_confirmation" id="regpassword_confirmation" required="" minlength="6">
            <span class="spin"></span>
         </div>

         <div class="button">
            <button><span>NEXT</span></button>
         </div>
      </form>    
   </div>

</div>
<script type="text/javascript">
   $(function() {

   $(".input input").focus(function() {

      $(this).parent(".input").each(function() {
         $("label", this).css({
            "line-height": "18px",
            "font-size": "18px",
            "font-weight": "100",
            "top": "0px"
         })
         $(".spin", this).css({
            "width": "100%"
         })
      });
   }).blur(function() {
      $(".spin").css({
         "width": "0px"
      })
      if ($(this).val() == "") {
         $(this).parent(".input").each(function() {
            $("label", this).css({
               "line-height": "60px",
               "font-size": "24px",
               "font-weight": "300",
               "top": "10px"
            })
         });

      }
   });

   $(".button").click(function(e) {
      var pX = e.pageX,
         pY = e.pageY,
         oX = parseInt($(this).offset().left),
         oY = parseInt($(this).offset().top);

      $(this).append('<span class="click-efect x-' + oX + ' y-' + oY + '" style="margin-left:' + (pX - oX) + 'px;margin-top:' + (pY - oY) + 'px;"></span>')
      $('.x-' + oX + '.y-' + oY + '').animate({
         "width": "500px",
         "height": "500px",
         "top": "-250px",
         "left": "-250px",

      }, 600);
      $("button", this).addClass('active');
   })

   $(".alt-2").click(function() {
      if (!$(this).hasClass('material-button')) {
         $(".shape").css({
            "width": "100%",
            "height": "100%",
            "transform": "rotate(0deg)"
         })

         setTimeout(function() {
            $(".overbox").css({
               "overflow": "initial"
            })
         }, 600)

         $(this).animate({
            "width": "140px",
            "height": "140px"
         }, 500, function() {
            $(".box").removeClass("back");

            $(this).removeClass('active')
         });

         $(".overbox .title").fadeOut(300);
         $(".overbox .input").fadeOut(300);
         $(".overbox .button").fadeOut(300);

         $(".alt-2").addClass('material-buton');
      }

   })

   $(".material-button").click(function() {

      if ($(this).hasClass('material-button')) {
         setTimeout(function() {
            $(".overbox").css({
               "overflow": "hidden"
            })
            $(".box").addClass("back");
         }, 200)
         $(this).addClass('active').animate({
            "width": "700px",
            "height": "700px"
         });

         setTimeout(function() {
            $(".shape").css({
               "width": "50%",
               "height": "40%",
               "transform": "rotate(45deg)"
            })

            $(".overbox .title").fadeIn(300);
            $(".overbox .input").fadeIn(300);
            $(".overbox .button").fadeIn(300);
         }, 700)

         $(this).removeClass('material-button');

      }

      if ($(".alt-2").hasClass('material-buton')) {
         $(".alt-2").removeClass('material-buton');
         $(".alt-2").addClass('material-button');
      }

   });

});
</script>
<?php
if (isset($_SERVER['HTTP_COOKIE'])) {
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    foreach($cookies as $cookie) {
        $parts = explode('=', $cookie);
        $name = trim($parts[0]);
        setcookie($name, '', time()-1000);
        setcookie($name, '', time()-1000, '/');
    }
}
if(isset($_SESSION)){
   session_destroy();
}
?>
</body>
</html>