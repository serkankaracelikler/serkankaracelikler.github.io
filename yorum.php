<?php 
header ("Access-Control-Allow-Origin: *");
header ("Access-Control-Expose-Headers: Content-Length, X-JSON");
header ("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
header ("Access-Control-Allow-Headers: *");


$burc = $_GET["burc"];

if($_GET){

    
    
$veri1 = file_get_contents("https://www.elle.com.tr/astroloji/".$burc."");
$veri2 = file_get_contents("https://www.sabah.com.tr/astroloji/".$burc."-burcu-gunluk-yorum");
$veri3 = file_get_contents("https://www.mynet.com/kadin/burclar-astroloji/".$burc."-burcu-gunluk-yorumu.html");

preg_match('@<div class="body-el-text standard-body-el-text">(.*?)</div>@si',$veri1,$baslik);
preg_match('@<div class="yorumMain">(.*?)</div>@si',$veri2,$baslik2);
preg_match('@<div class="detail-content-inner">(.*?)</div>@si',$veri3,$baslik3);


$baslik[1] = strip_tags($baslik[1]);
$baslik2[1] = strip_tags($baslik2[1]);
$baslik3[1] = strip_tags($baslik3[1]);


$json = array(); 

$json['burclar'][] = array( 
    'burc'=> $baslik[1],
    'burc2'=> $baslik2[1],
    'burc3'=> $baslik3[1]
); 


echo (json_encode($json,JSON_UNESCAPED_UNICODE));
    
}




?>