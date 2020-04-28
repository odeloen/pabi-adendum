<style type="text/css">
* {
	box-sizing: border-box;
}

.wrapper_kartu_anggota {
	display: flex;
	justify-content: center;
	align-items: center;
	font-family: Montserrat; 
	width: 100%;  
}

.outer_kartu_anggota {
	position: relative;
	background: #fff;
	height: 320px;
	width: 550px;
	overflow: hidden;
	display: flex;
	align-items: center;
	border: 2px solid black;
	border-radius: 25px;
}

.img_kartu_anggota {
	position: absolute;
	top: 0px; 
	z-index: 0;
	animation-delay: 0.5s;
	width: 100%
}

.content_kartu_anggota {
	animation-delay: 0.3s;
	position: absolute;
	left: 20px;
	z-index: 3;
	color: white;
	font-weight: bold;
	max-width: 250px;
	
}

.wrapper_kartu_anggota h1 {
	color: #111;
}

.wrapper_kartu_anggota p {
	width: 280px;
	font-size: 13px;
	line-height: 1.4;
	color: #aaa;
	margin: 20px 0;
	
}

.wrapper_kartu_anggota .bg {
	display: inline-block;
	color: #fff;
	background: cornflowerblue;
	padding: 5px 10px;
	border-radius: 50px;
	font-size: .7em;
}
.wrapper_kartu_anggota .button {
	width: fit-content;
	height: fit-content;
	margin-top: 10px;
	
	
	
}

.wrapper_kartu_anggota .button a {
	display: inline-block;
	overflow: hidden;
	position: relative;
	font-size: 11px;
	color: #111;
	text-decoration: none;
	padding: 10px 15px;
	border: 1px solid #aaa;
	font-weight: bold;
	
	
}

.wrapper_kartu_anggota .button a:after{
	content: "";
	position: absolute;
	top: 0;
	right: -10px;
	width: 0%;
	background: #111;
	height: 100%;
	z-index: -1;
	transition: width 0.3s ease-in-out;
	transform: skew(-25deg);
	transform-origin: right;
}

.wrapper_kartu_anggota .button a:hover:after {
	width: 150%;
	left: -10px;
	transform-origin: left;
	
}

.wrapper_kartu_anggota .button a:hover {
	color: #fff;
	transition: all 0.5s ease;
}


.wrapper_kartu_anggota .button a:nth-of-type(1) {
	border-radius: 50px 0 0 50px;
	border-right: none;
}

.wrapper_kartu_anggota .button a:nth-of-type(2) {
	border-radius: 0px 50px 50px 0;
}

.wrapper_kartu_anggota .cart-icon {
	padding-right: 8px;
	
}

.wrapper_kartu_anggota .footer {
	position: absolute;
	bottom: 0;
	right: 0;
}
</style>
<div class="wrapper_kartu_anggota" >
	<div class="outer_kartu_anggota" style="margin: 0px !important">
		<div class="content_kartu_anggota animated fadeInLeft" style="margin: 0px !important"> <br><br>
			<br><br>
			<span>
				{{ $data_member['firstname'] }} {{ $data_member['lastname']  }} {{ $data_member['gelar']  }}	
			</span>	 
			<p style="margin: 0px !important">
				Member no :
				<br><span>{{ $data_member['card_no'] }}</span>
				<br>
				Valid until :
				<br><span>{!! tgl_indo($data_member['valid_until_card_no']) !!}</span>
			</p>
		</div>
		<img src="{{ asset('kartu_anggota/ka.jpg')}}" class="img_kartu_anggota animated fadeInRight">
	</div> 
</div>