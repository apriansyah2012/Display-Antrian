<?php
 


 header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
 header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT"); 
 header("Cache-Control: no-store, no-cache, must-revalidate"); 
 header("Cache-Control: post-check=0, pre-check=0", false);
 header("Pragma: no-cache"); // HTTP/1.0
 date_default_timezone_set("Asia/Bangkok");
 $tanggal= mktime(date("m"),date("d"),date("Y"));
 $jam=date("H:i");
  include"koneksi.php";
?>

<!doctype html>
<html lang="en">
<head>

    <title>Layar Informasi</title>
    <link href="style/bootstrap.min.css" rel="stylesheet">
  <script src="style/angular.min.js"></script>
    <!-- Meta START -->
    <link rel="icon" href="asset/img/rs.png" type="image/x-icon">

    <meta charset="utf-8" />
	<meta http-equiv="refresh" content="35" /> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <link type="text/css" rel="stylesheet" href="asset/css/materialize.min.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="asset/css/jquery-ui.css"  media="screen,projection"/>
    <link rel="stylesheet" href="asset/css/marquee2.css" />
    <link rel="stylesheet" href="asset/css/example.css" />
    <link rel="stylesheet" href="asset/css/ok.css" />
    <link rel="stylesheet" href="asset/css/slide.css" />
	<script src='js/responsivevoice.js'></script>
	
    <style type="text/css">
        .bg::before {
            content: '';
            background-image: url('asset/img/background.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: scroll;
            position: fixed;
            z-index: -1;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            opacity: 0.10;
            filter:alpha(opacity=10);
        }
    </style>
    <style>
#customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
</style>
<style type="text/css">
    table {
        font-family: verdana, arial, sans-serif;
        font-size: 15px;
        color: #333333;
        border-width: 1px;
        border-color: #3A3A3A;
        border-collapse: collapse;
    }
    table th {
        border-width: 1px;
        padding: 8px;
        border-style: solid;
        border-color: #FFA6A6;
        background-color: #D56A6A;
        color: #ffffff;
    }
    table tr:hover td {
        cursor: pointer;
    }
    table tr:nth-child(even) td{
        background-color: #F7CFCF;
    }
    table td {
        border-width: 1px;
        padding: 8px;
        border-style: solid;
        border-color: #FFA6A6;
        background-color: #ffffff;
    }
	

#blink {
text-align:center;
background: smoth Green;
color:#F00;
margin: 20px auto;
padding:5px;
border: 1px solid green;
width: 400px;
box-shadow: 5px 10px 5px #00c;
border-radius :15px 0;
}

#blink span {
font-size:2em;
font-weight:bold;
display:block;
font-family: arial;
}


</style>

    <!-- Global style END -->

</head>

<!-- Body START -->
<body class="bg">

<!-- Header START -->
<header>

<nav class="pink lighten-1">
    <div class="nav-wrapper">
        <ul class="center hide-on-med-and-down" id="nv">
            <li>
                <a href="./" class="ams hide-on-med-and-down"><img src="asset/img/logors.png" alt="" width="90"> <b>ANTRIAN POLIKLINIK</b> </a>
            </li>
            <li class="right" style="margin-right: 50px;">
                <i class="material-icons">perm_contact_calendar</i>
                <a href="" class="white-text">
                    <?php
                      //menentukan hari
                      $a_hari = array(1=>"Senin","Selasa","Rabu","Kamis","Jumat", "Sabtu","Minggu");
                      $hari = $a_hari[date("N")];

                      //menentukan tanggal
                      $tanggal = date ("j");

                      //menentukan bulan
                      $a_bulan = array(1=>"Januari","Februari","Maret", "April", "Mei", "Juni","Juli","Agustus","September","Oktober", "November","Desember");
                      $bulan = $a_bulan[date("n")];

                      //menentukan tahun
                      $tahun = date("Y"); 

                      //dan untuk menampilkan nya dengan format contoh Jumat, 22 Februari 2013
                      echo $hari . ", " . $tanggal ." ". $bulan ." ". $tahun;

                    ?>
                </a>
                <i class="material-icons md-12">query_builder</i>  
                <a href="" class="white-text" id="jam"></a>
          </li>
        </ul>
    </div>
</nav>




</header>
<!-- Header END -->

<!-- Main START -->
<main>

    
    <!-- container END -->
     <div class="container-fluid">
      <div class="col s12 row">
            <div class="col s4">
                <h5 class="center">10 Antrian Baru</h5>
                
                  
                      <?php
			$no = 1;
			
            $data = mysqli_query ($koneksi, "select a.no_reg,a.kd_dokter, b.nm_dokter,c.nm_poli from reg_periksa a inner join dokter b inner join poliklinik c 
			inner join jadwal d  where a.kd_dokter=b.kd_dokter and a.kd_poli=c.kd_poli and a.kd_poli='$kode_poli' 
				and d.hari_kerja='SENIN' and a.kd_dokter=d.kd_dokter  and a.stts='belum' and a.tgl_registrasi ='$date' order by a.kd_poli ASC LIMIT 1");
            $cek = mysqli_num_rows($data);
            
            if($cek==0){ ?>
              <tr>
                <td colspan="3">--</td>
              </tr>
            <?php }else{ 
              while ($row = mysqli_fetch_array ($data))
              {
				 
                ?>
				<tr bgcolor='#EE6868' >
                
                <td>
				
				<div id="blink">
				
				NO. Antrian
				
				  <span>
					<div id="suara">
					<?php echo $row['0']; ?>
					</div
				  </span>
				</div>
                 
                </td>
				
                <td>
				<div id="blink">DOKTER
				
				  <span>
					<?php echo $row['2']; ?>
				  </span>
				</div>
                  
                </td>
				
				<td>
				<div id="blink">POLIKLINIK
				
				  <span>
					<?php echo $row['3']; ?>
				  </span>
				</div>
                  
                </td>
                
				
                
              </tr>
             
					 
				<?php
				
                }
			  
              }
              ?>
              
                 
            
                 
                   
            

</main>

<!-- Main END -->

<!-- Include Footer START -->

<!-- Footer START -->
<marquee class="marquee" scrollamount="4">
                  Hubungi Kami di | Customer Care - (021) 000 - 0000 | IGD - (021) 000 - 0001 | Instagram / Facebook  | "Aplikasi ini 100 % Gratis tidak dipungut Biaya dalam Penggunaanya"
            </marquee>
<footer class="page-footer">
	<div class="footer-copyright pink lighten-1">
      &nbsp Copyright © YASKI - SIMKESKhanza  
	  </div>
	 
			  
</footer>
<!-- Footer END -->

<!-- Javascript START -->
<!-- Footer END -->

<!-- Javascript START -->
<script type="text/javascript" src="asset/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="asset/js/materialize.min.js"></script>
<script type="text/javascript" src="asset/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="asset/js/bootstrap.min.js"></script>
<script data-pace-options='{ "ajax": false }' src='asset/js/pace.min.js'></script>
<script type="text/javascript" src="asset/js/marquee.js"></script>
<script type="text/javascript">
   window.onload = function() { jam(); }

   function jam() {
    var e = document.getElementById('jam'),
    d = new Date(), h, m, s;
    h = d.getHours();
    m = set(d.getMinutes());
    s = set(d.getSeconds());

    e.innerHTML = h +':'+ m +':'+ s;

    setTimeout('jam()', 100);
   }

   function set(e) {
    e = e < 10 ? '0'+ e : e;
    return e;
  }
  

$(document).ready(function(){
blinkFont();
});

function blinkFont()
{
document.getElementById("blink").style.color="red"
document.getElementById("blink").style.background="white"
setTimeout("setblinkFont()",500)
}

function setblinkFont()
{
document.getElementById("blink").style.color="white"
document.getElementById("blink").style.background="green"
setTimeout("blinkFont()",500)
}

const Word = document.querySelector("#suara");
toggleSpeak.addEventListener("autoplay", () => textToSpeech());

const textToSpeech = () => {
	if ('speechSynthesis' in window) {

		const synthesis = window.speechSynthesis;
	
		const suara = synthesis.getVoices().filter(item => {
				return item.lang === "id"
        })[0];
		const utter = new SpeechSynthesisUtterance(Word.value);
		utter.rate = 0.7;
		utter.volume = 1;
		utter.pitch = 1;
		utter.voice = suara
		utter.onend = () => console.log("Selesai berbicara! ");
		synthesis.speak(utter);
	}else{
		alert("browser ini tidak mendukung Text-To-Speech");
 	}
}
}
</script>

</body>
<!-- Body END -->


</html>
