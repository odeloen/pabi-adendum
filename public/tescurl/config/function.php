<?php  
$ada_pengumuman = 0;
$isi_pengumuman = "Tes Pengumuman";

$under_maintance = 0;
if($under_maintance == 1){ 
    unset($_SESSION["id"]); 
    unset($_SESSION["username"]);  
    unset($_SESSION["unit_id"]); 
    unset($_SESSION["unit_id_self"]); 
    unset($_SESSION["login"]); 
    unset($_SESSION["hak_akses"]); 
    unset($_SESSION["idPemda"]); 
    unset($_SESSION["namaPemda"]); 
    unset($_SESSION["kodehak_akses"]); 
    session_unset(); 
    session_destroy();

    header('Location: ./');
    exit();
}

$tahun="2019";
$key = date("dmY")."progstylysbyhamdiramadhan"; // the key will be truncated if it's too long


$arrwhy=array();
		
$arrbul=array("","Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agu","Sep","Okt","Nov","Des");
$arrbulan=array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");

    
function tanggal_indo($tanggal)
{
    $bulan = array (1 =>   'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            );
    $split = explode('-', $tanggal);
    return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
}

 function encrypt($string, $key='%key&') {
    $result = '';
    for($i=0; $i<strlen($string); $i++) {
        $char = substr($string, $i, 1);
        $keychar = substr($key, ($i % strlen($key))-1, 1);
        $ordChar = ord($char);
        $ordKeychar = ord($keychar);
        $sum = $ordChar + $ordKeychar;
        $char = chr($sum);
        $result.=$char;
    }
    $temp= base64_encode($result);
    $temp=str_replace("+","$$@$$",$temp);
    return $temp;
}

function decrypt($string, $key='%key&') {
    $result = '';
    $string=str_replace("$$@$$","+",$string);
    $string = base64_decode($string);
    for($i=0; $i<strlen($string); $i++) {
        $char = substr($string, $i, 1);
        $keychar = substr($key, ($i % strlen($key))-1, 1);
        $ordChar = ord($char);
        $ordKeychar = ord($keychar);
        $sum = $ordChar - $ordKeychar;
        $char = chr($sum);
        $result.=$char;
    }
    return $result;
}
    
function cektoken($ctoken)
{
	$key = date("dmY")."progstylysbyhamdiramadhan";
	$v=decrypt($ctoken,$key);
	//echo $ctoken."-".$v;
	if($v!=$_SESSION['username']."|".$_SESSION['level'])
	{
		echo "xxxxxxxxxxx";exit;
	}
}


function ws($f) {
    $options = array(
        CURLOPT_POST => false,
        CURLOPT_HTTPAUTH=>CURLAUTH_BASIC,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_RETURNTRANSFER => true,   // return web page
        CURLOPT_HEADER         => false,  // don't return headers
        CURLOPT_FOLLOWLOCATION => false,   // follow redirects
        CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
        CURLOPT_ENCODING       => "UTF-8",     // handle compressed
        CURLOPT_CONNECTTIMEOUT => 120,    // time-out on connect
        CURLOPT_TIMEOUT        => 120,    // time-out on response
    ); 
    $f=str_replace(" ", "%20", $f);
    $uri=$_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI'])."/webservice/". $f; 
    // $uri="http://localhost/pemda_bantaeng/eharga/webservice/". $f;  
    $ch = curl_init( $uri);
    curl_setopt_array($ch, $options);

    $content  = curl_exec($ch);

    if(curl_errno($ch)){
        $content= 'Curl error: ' . curl_error($ch);
    }
    curl_close($ch);
    
    return $content;   
}
function wself($f) {
    $options = array(
        CURLOPT_POST => false,
        CURLOPT_HTTPAUTH=>CURLAUTH_BASIC,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_RETURNTRANSFER => true,   // return web page
        CURLOPT_HEADER         => false,  // don't return headers
        CURLOPT_FOLLOWLOCATION => false,   // follow redirects
        CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
        CURLOPT_ENCODING       => "UTF-8",     // handle compressed
        CURLOPT_CONNECTTIMEOUT => 120,    // time-out on connect
        CURLOPT_TIMEOUT        => 120,    // time-out on response
    ); 
    $f=str_replace(" ", "%20", $f);
    $uri=$_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']). $f;
    $uri=$_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI'])."/webservice/". $f;  
    // $uri="http://localhost/pemda_bantaeng/eharga/webservice/". $f;  
    $ch = curl_init( $uri);
    curl_setopt_array($ch, $options);
    // echo $uri;exit();
    $content  = curl_exec($ch);

    if(curl_errno($ch)){
        $content= 'Curl error: ' . curl_error($ch);
    }
    curl_close($ch);
    // echo $content;exit();
    
    return $content;   
}

     

$bulan = array (1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
$daftarHari = array ( 1 =>    'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu',
            'Minggu'
        );
      
 
function hari_indo($day){
    $hari = $day;
 
    switch($hari){
        case 'Sun':
            $hari_ini = "Minggu";
        break;
 
        case 'Mon':         
            $hari_ini = "Senin";
        break;
 
        case 'Tue':
            $hari_ini = "Selasa";
        break;
 
        case 'Wed':
            $hari_ini = "Rabu";
        break;
 
        case 'Thu':
            $hari_ini = "Kamis";
        break;
 
        case 'Fri':
            $hari_ini = "Jumat";
        break;
 
        case 'Sat':
            $hari_ini = "Sabtu";
        break;
        
        default:
            $hari_ini = "Tidak di ketahui";     
        break;
    }
 
    return $hari_ini ;
 
}  