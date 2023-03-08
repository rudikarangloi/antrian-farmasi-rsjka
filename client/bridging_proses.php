<?

error_reporting(0);

// include("signature.php");
// RS JIWA KALAWA ATEI- 1401B004
// Cons Id : 22112
// Secret Key : 5cN0BB19D1
// User key : afef84b7c3002296535d519a47b584a4
//production
//Kode PPK - Nama PPK: RSJ Kalawa Atei (1401B004)
//Consid - Secretkey : 22112 - 5cN0BB19D1
//user_key: 07cd7877229a200041247e04af989307

require_once 'vendor/autoload.php';
date_default_timezone_set('UTC');
$tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));

    $cons_id = "22112";
    $data= $cons_id."&".$tStamp;
    $ppk = "1401B004";
    $secretKey = "5cN0BB19D1";
    $userkey = "07cd7877229a200041247e04af989307";

//consid + conspwd + timestamp request (concatenate string)
$key = $cons_id.''.$secretKey.''.$tStamp;
//echo $key;
//$ip = "https://new-api.bpjs-kesehatan.go.id:8080/new-vclaim-rest";
//$ip = "https://dvlp.bpjs-kesehatan.go.id/vclaim-rest-1.1";
//$ip = "https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest-dev";
$ip = "https://apijkn.bpjs-kesehatan.go.id/vclaim-rest";
# echo $tStamp;

           // Computes the signature by hashing the salt with the secret key as the key

   $signature = hash_hmac('sha256', $data, $secretKey, true);

 

   // base64 encode…

   $encodedSignature = base64_encode($signature);
#error_reporting("E_ALL");
//include('include/connect.php');
#include('lib/function.php');

date_default_timezone_set("Asia/Bangkok");


if ($_POST) {
  extract($_POST);
if($reqdata=="sep"){
  $tgl=date("Y-m-d H:i:s");
  $tglbr=date("Y-m-d");

                                 $poli = "JIW";
// $scml='

//                   {
//            "request": {
//               "t_sep": {
//                  "noKartu": "'.$nopeserta.'",
//                  "tglSep": "'.$tglreg.'",
//                  "ppkPelayanan": "'.$ppk.'",
//                  "jnsPelayanan": "2",
//                  "klsRawat": "'.$kelas.'",
//                  "noMR": "'.$nomr.'",
//                  "rujukan": {
//                     "asalRujukan": "1",
//                     "tglRujukan": "'.$tglrujuk.'",
//                     "noRujukan": "'.$norujukan.'",
//                     "ppkRujukan": "'.$noppk.'"
//                  },
//                  "catatan": "'.$catatan.'",
//                  "diagAwal": "'.$diagnosa.'",
//                  "poli": {
//                     "tujuan": "'.$poli.'",
//                     "eksekutif": "0"
//                  },
//                  "cob": {
//                     "cob": "0"
//                  },
//                  "katarak": {
//                     "katarak": "0"
//                  },
//                  "jaminan": {
//                     "lakaLantas": "'.$lakalantas.'",
//                     "penjamin": {
//                         "penjamin": "1",
//                         "tglKejadian": "'.$tglrujuk.'",
//                         "keterangan": "kll",
//                         "suplesi": {
//                             "suplesi": "0",
//                             "noSepSuplesi": "0",
//                             "lokasiLaka": {
//                                 "kdPropinsi": "0",
//                                 "kdKabupaten": "0",
//                                 "kdKecamatan": "0"
//                                 }
//                         }
//                     }
//                  },
//                  "skdp": {
//                     "noSurat": "'.$notu.'",
//                     "kodeDPJP": "'.$dpjp.'"
//                  },
//                  "noTelp": "'.$notelp.'",
//                  "user": "Coba Ws"
//               }
//            }
//         }                    
//   ';   
if($pasca =='1'){
$fktp = "2";
$noppk = $ppk;
}
 $scml='{
           "request":{
              "t_sep":{
                 "noKartu":"'.$nopeserta.'",
                 "tglSep":"'.$tglreg.'",
                 "ppkPelayanan":"'.$ppk.'",
                 "jnsPelayanan":"2",
                 "klsRawat":{
                    "klsRawatHak":"'.$kelas.'",
                    "klsRawatNaik":"",
                    "pembiayaan":"",
                    "penanggungJawab":""
                 },
                 "noMR":"'.$nomr.'",
                 "rujukan":{
                    "asalRujukan":"'.$fktp.'",
                    "tglRujukan":"'.$tglrujuk.'",
                    "noRujukan":"'.$norujukan.'",
                    "ppkRujukan":"'.$noppk.'"
                 },
                 "catatan":"'.$catatan.'",
                 "diagAwal":"'.$diagnosa.'",
                 "poli":{
                    "tujuan":"'.$poli.'",
                    "eksekutif":"0"
                 },
                 "cob":{
                    "cob":"0"
                 },
                 "katarak":{
                    "katarak":"0"
                 },
                 "jaminan":{
                    "lakaLantas":"0",
                    "penjamin":{
                       "tglKejadian":"",
                       "keterangan":"",
                       "suplesi":{
                          "suplesi":"0",
                          "noSepSuplesi":"",
                          "lokasiLaka":{
                             "kdPropinsi":"",
                             "kdKabupaten":"",
                             "kdKecamatan":""
                          }
                       }
                    }
                 },
                 "tujuanKunj":"'.$tujuankunj.'",
                 "flagProcedure":"'.$prosedur.'",
                 "kdPenunjang":"'.$penunjang.'",
                 "assesmentPel":"'.$assesmen.'",
                 "skdp":{
                    "noSurat":"'.$notu.'",
                    "kodeDPJP":"'.$dpjp.'"
                 },
                 "dpjpLayan":"'.$dpjppel.'",
                 "noTelp":"'.$notelp.'",
                 "user":"Coba Ws"
              }
           }
        }
';

//echo $scml;
  $url = $ip."/SEP/2.0/insert";
 
$process = curl_init($url); 
curl_setopt($process, CURLOPT_HTTPHEADER,
        array("Content-Type: Application/x-www-form-urlencoded\r\n" . "X-cons-id: $cons_id\r\n" . "X-Timestamp: $tStamp\r\n" . "X-Signature: $encodedSignature\r\n". "user_key: $userkey"));
curl_setopt($process, CURLOPT_HEADER, false); 
curl_setopt($process, CURLOPT_TIMEOUT, 30); 
curl_setopt($process, CURLOPT_POST, true); 
curl_setopt($process, CURLOPT_POSTFIELDS, $scml); 
curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE); 
$return = curl_exec($process); 
curl_close($process);
$response = json_decode($return, true);
$no_sep=$response[response][sep]['noSep'];
$sep=$response[metaData]['code'];
$sepi=$response[metaData]['message'];
//echo $response;
if ($sep==200){
//echo $no_sep;
// function decrypt
  //  function stringDecrypt($key, $string){
        
        $string = $response['response'];
        $encrypt_method = 'AES-256-CBC';

        // hash
        $key_hash = hex2bin(hash('sha256', $key));
  
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hex2bin(hash('sha256', $key)), 0, 16);

        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key_hash, OPENSSL_RAW_DATA, $iv);

        $lihat = \LZCompressor\LZString::decompressFromEncodedURIComponent($output);
        //echo $lihat;
        echo $lihat;
  //  }
//echo $scml;
}

else{
echo $sepi;
}
#echo $scml;
#;
//echo $diagnosa;



}

if($reqdata=="kontrol"){
  $tgl=date("Y-m-d H:i:s");
  $tglbr=date("Y-m-d");
   $scml='{
            "request": {
                "noSEP":"'.$nosep.'",
                "kodeDokter":"'.$refdokter.'",
                "poliKontrol":"JIW",
                "tglRencanaKontrol":"'.$tgl_ren_kontrol.'",
                "user":"wssimrs"
            }
        }  
  ';   
   // $scml.="</t_sep>";
   //$scml.="</data>";
   //$scml.="</request>";
   $url = $ip."/RencanaKontrol/insert";
   // $url = "https://new-api.bpjs-kesehatan.go.id:8080/new-vclaim-rest/SEP/1.1/insert";
   //$url= "http://172.16.2.16:80/WSLokalRest/SEP/insert";
   #$url="http://api.asterix.co.id/SepWebRest/sep/create/";
   //$url="http://dvlp.bpjs-kesehatan.go.id:8081/devwslokalrest/SEP/insert";

   #$nilai1="3201152704890003";
   #$url= "".$ip."/$nilai1";
   $process = curl_init($url); 
   curl_setopt($process, CURLOPT_HTTPHEADER,
         array("Content-Type: application/x-www-form-urlencoded\r\n" . "X-cons-id: $cons_id\r\n" . "X-Timestamp: $tStamp\r\n" . "X-Signature: $encodedSignature\r\n". "user_key: $userkey"));
   curl_setopt($process, CURLOPT_HEADER, false); 
   curl_setopt($process, CURLOPT_TIMEOUT, 30); 
   curl_setopt($process, CURLOPT_POST, true); 
   curl_setopt($process, CURLOPT_POSTFIELDS, $scml); 
   curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE); 
   $return = curl_exec($process); 
   curl_close($process);
   $response = json_decode($return, true);
   $no_surat_kontrol=$response[response]['noSuratKontrol'];
   $sep=$response[metaData]['code'];
   $sepi=$response[metaData]['message'];
   //echo $response;
   if ($sep==200){
         //echo $no_surat_kontrol;
         // function decrypt
         //  function stringDecrypt($key, $string){
         
         $string = $response['response'];
         $encrypt_method = 'AES-256-CBC';

         // hash
         $key_hash = hex2bin(hash('sha256', $key));
   
         // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
         $iv = substr(hex2bin(hash('sha256', $key)), 0, 16);

         $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key_hash, OPENSSL_RAW_DATA, $iv);

         $lihat = \LZCompressor\LZString::decompressFromEncodedURIComponent($output);
         echo $lihat;
   //  }
   //echo $scml;
   }

   else{
      echo $sepi;
   }
   #echo $scml;
   #;
   //echo $diagnosa;



}

if($reqdata=="insertAntrian"){

   /*

   RS JIWA KALAWA ATEI- 1401B004
   Cons Id : 22112
   Secret Key : 5cN0BB19D1
   User key : 556b3a1346f1c3ac4eeb197c85ea3f34

   $url = "https://apijkn-dev.bpjs-kesehatan.go.id/antreanrs_dev";        
      
   */
   date_default_timezone_set('UTC');
   $cons_id = "22112";
   $secretKey = "5cN0BB19D1";
   $tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
   $data= $cons_id."&".$tStamp;
   $signature = hash_hmac('sha256', $data, $secretKey, true);
   $encodedSignature = base64_encode($signature);
   $userkey = "556b3a1346f1c3ac4eeb197c85ea3f34";
   $ip = "https://apijkn-dev.bpjs-kesehatan.go.id/antreanrs_dev";

   $tgl=date("Y-m-d H:i:s");
   $tglbr=date("Y-m-d");


   /*
      jeniskunjungan: {1 (Rujukan FKTP), 2 (Rujukan Internal), 3 (Kontrol), 4 (Rujukan Antar RS)},
      nomorreferensi: "{norujukan/kontrol pasien JKN,diisi kosong jika NON JKN}",

   */
   
   $jenispasien = "JKN";
   $jeniskunjungan = "1";
   if(empty($nomorkartu)){
      $jenispasien = "NON JKN";
      $jeniskunjungan = "2";
      $nomorreferensi = "";
   }
   $scml = '{
      "kodebooking": "'.$kodebooking.'",
      "jenispasien": "'.$jenispasien.'",
      "nomorkartu": "'.$nomorkartu.'",
      "nik": "'.$nik.'",
      "nohp": "'.$nohp.'",
      "kodepoli": "'.$kodepoli.'",
      "namapoli": "'.$namapoli.'",
      "pasienbaru": 0,
      "norm": "'.$norm.'",
      "tanggalperiksa": "'.$tanggalperiksa.'",
      "kodedokter": '.$kodedokter.',
      "namadokter": "'.$namadokter.'",
      "jampraktek": "'.$jampraktek.'",
      "jeniskunjungan": '.$jeniskunjungan.',
      "nomorreferensi": "'.$nomorreferensi.'",
      "nomorantrean": "'.$nomorantrean.'",
      "angkaantrean": '.$angkaantrean.',
      "estimasidilayani": '.$estimasidilayani.',
      "sisakuotajkn": '.$sisakuotajkn.',
      "kuotajkn": '.$kuotajkn.',
      "sisakuotanonjkn": '.$sisakuotanonjkn.',
      "kuotanonjkn": '.$kuotanonjkn.',
      "keterangan": "'.$keterangan.'"
   }';

   $scml2 = '{
      "kodebooking": "16032021A001",
      "jenispasien": "JKN",
      "nomorkartu": "0001308270036",
      "nik": "3212345678987654",
      "nohp": "085635228888",
      "kodepoli": "ANA",
      "namapoli": "Anak",
      "pasienbaru": 0,
      "norm": "123345",
      "tanggalperiksa": "2022-01-02",
      "kodedokter": 305407,
      "namadokter": "Dr. Hendra",
      "jampraktek": "08:00-16:00",
      "jeniskunjungan": 1,
      "nomorreferensi": "0001R0040116A000001",
      "nomorantrean": "A-12",
      "angkaantrean": 12,
      "estimasidilayani": 1615869169000,
      "sisakuotajkn": 5,
      "kuotajkn": 30,
      "sisakuotanonjkn": 5,
      "kuotanonjkn": 30,
      "keterangan": "Peserta harap 30 menit lebih awal guna pencatatan administrasi."
   }';
    
    $url = $ip."/antrean/add";
    //$url = "https://apijkn-dev.bpjs-kesehatan.go.id/antreanrs_dev/antrean/add";
  
    $process = curl_init($url); 
    curl_setopt($process, CURLOPT_HTTPHEADER,
          array("Content-Type: application/x-www-form-urlencoded\r\n" . 
                  "X-cons-id: $cons_id\r\n" . 
                  "X-Timestamp: $tStamp\r\n" . 
                  "X-Signature: $encodedSignature\r\n". 
                  "user_key: $userkey"));
    curl_setopt($process, CURLOPT_HEADER, false); 
    curl_setopt($process, CURLOPT_TIMEOUT, 30); 
    curl_setopt($process, CURLOPT_POST, true); 
    curl_setopt($process, CURLOPT_POSTFIELDS, $scml); 
    curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE); 
    $return = curl_exec($process); 
    curl_close($process);
    $response = json_decode($return, true);

    //var_dump($response);
    
    $sep=$response['metadata']['code'];     //sebelumnya metaData -> error
    
    $sepi=$response['metadata']['message'];
    
    if ($sep==200){          
          echo $sepi;
    }else{
       //echo $sepi. ' --> ' . $scml;   
       //echo $sepi;   
       echo   $sepi. '  X-cons-id = '.$cons_id. ' X-Timestamp = '.$tStamp. ' X-Signature = '.$encodedSignature. ' user_key = '.$userkey;
    }
     
}



if($reqdata=="updateWaktuAntrian"){

   /*
   Kode PPK : 1401B004
   Nama PPK : RS JIWA KALAWA ATEI
   Consid : 22112
   Secretkey :  5cN0BB19D1
   user_key : 556b3a1346f1c3ac4eeb197c85ea3f34

   OLD :
   RS JIWA KALAWA ATEI- 1401B004
   Cons Id : 12287
   Secret Key : 2jC8FA8E07
   User key : 9c748bc6b5f57ef7ea272d60b690e682

   */

   date_default_timezone_set('UTC');
   $cons_id = "22112";
   $secretKey = "5cN0BB19D1";
   $tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
   $data= $cons_id."&".$tStamp;
   $signature = hash_hmac('sha256', $data, $secretKey, true);
   $encodedSignature = base64_encode($signature);
   $userkey = "556b3a1346f1c3ac4eeb197c85ea3f34";
   $ip = "https://apijkn-dev.bpjs-kesehatan.go.id/antreanrs_dev";

   $tgl=date("Y-m-d H:i:s");
   $tglbr=date("Y-m-d");

   $tStamp2=strtotime(date('Y-m-d H:i:s'))*1000;
  
   $scml = '{
               "kodebooking": "'.$kodeBooking.'",
               "taskid": '.$taskid.',
               "waktu": '.$tStamp2.',
               "jenisresep": ""
            }';
       
    $url = $ip."/antrean/updatewaktu";
  
    $process = curl_init($url); 
    curl_setopt($process, CURLOPT_HTTPHEADER,
          array("Content-Type: application/x-www-form-urlencoded\r\n" . 
                  "X-cons-id: $cons_id\r\n" . 
                  "X-Timestamp: $tStamp\r\n" . 
                  "X-Signature: $encodedSignature\r\n". 
                  "user_key: $userkey"));
    curl_setopt($process, CURLOPT_HEADER, false); 
    curl_setopt($process, CURLOPT_TIMEOUT, 30); 
    curl_setopt($process, CURLOPT_POST, true); 
    curl_setopt($process, CURLOPT_POSTFIELDS, $scml); 
    curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE); 
    $return = curl_exec($process); 
    curl_close($process);
    $response = json_decode($return, true);

    //var_dump($response);
    
    $sep=$response['metadata']['code'];     //sebelumnya metaData -> error
    
    $sepi=$response['metadata']['message'];
    
    if ($sep==200){          
      echo $sepi;
      //echo  ' X-Timestamp = '.$tStamp. '\n X-Signature = '.$encodedSignature;
      //echo $sep. ' | ' .$sepi. ' --> ' . $scml; 

    }else{
      //echo $sep. ' | ' .$sepi. ' ==> ' . $scml;   
      echo $sepi;   
      //echo  ' X-Timestamp = '.$tStamp. ' X-Signature = '.$encodedSignature;
      //echo   $sepi. '  X-cons-id = '.$cons_id. ' X-Timestamp = '.$tStamp. ' X-Signature = '.$encodedSignature. ' user_key = '.$userkey;
    }
     
}

if($reqdata=="farmasiAdd"){

   date_default_timezone_set('UTC');
   $cons_id = "22112";
   $secretKey = "5cN0BB19D1";
   $tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
   $data= $cons_id."&".$tStamp;
   $signature = hash_hmac('sha256', $data, $secretKey, true);
   $encodedSignature = base64_encode($signature);
   $userkey = "556b3a1346f1c3ac4eeb197c85ea3f34";
   $ip = "https://apijkn-dev.bpjs-kesehatan.go.id/antreanrs_dev";

   $scml = '{
               "kodebooking": "'.$kodeBooking.'",
               "jenisresep": "'.$jenisresep.'",
               "nomorantrean": '.$nomorantrean.',
               "keterangan": "-"
            }';

   $scml2 = '{
      "kodebooking": "16032021A001",
      "jenisresep": "racikan",
      "nomorantrean": 1,
      "keterangan": ""
   }';
       
    $url = $ip."/antrean/farmasi/add";
    
    $process = curl_init($url); 
    curl_setopt($process, CURLOPT_HTTPHEADER,
          array("Content-Type: application/x-www-form-urlencoded\r\n" . 
                  "X-cons-id: $cons_id\r\n" . 
                  "X-Timestamp: $tStamp\r\n" . 
                  "X-Signature: $encodedSignature\r\n". 
                  "user_key: $userkey"));
    curl_setopt($process, CURLOPT_HEADER, false); 
    curl_setopt($process, CURLOPT_TIMEOUT, 30); 
    curl_setopt($process, CURLOPT_POST, true); 
    curl_setopt($process, CURLOPT_POSTFIELDS, $scml); 
    curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE); 
    $return = curl_exec($process); 
    curl_close($process);
    $response = json_decode($return, true);

    //var_dump($response);
    
    $sep=$response['metadata']['code'];   
    
    $sepi=$response['metadata']['message'];
    
    if ($sep==200){          
      echo $sepi;
      //echo $sep. ' | ' .$sepi. ' --> ' . $scml; 

    }else{
      echo $sepi;
      //echo $sep. ' | ' .$sepi. '  ' . $scml;   
      //echo $scml; 
      //echo  ' X-Timestamp = '.$tStamp. ' X-Signature = '.$encodedSignature;
  
     // echo  '  X-cons-id = '.$cons_id. ' X-Timestamp = '.$tStamp. ' X-Signature = '.$encodedSignature. ' user_key = '.$userkey;
    }
     
}

if($reqdata=="listTask"){

   date_default_timezone_set('UTC');
   $cons_id = "22112";
   $secretKey = "5cN0BB19D1";
   $tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
   $data= $cons_id."&".$tStamp;
   $signature = hash_hmac('sha256', $data, $secretKey, true);
   $encodedSignature = base64_encode($signature);
   $userkey = "556b3a1346f1c3ac4eeb197c85ea3f34";
   $ip = "https://apijkn-dev.bpjs-kesehatan.go.id/antreanrs_dev";

   $tgl=date("Y-m-d H:i:s");
   $tglbr=date("Y-m-d");

   $tStamp2=strtotime(date('Y-m-d H:i:s'))*1000;
  
   $scml = '{
               "kodebooking": "'.$kodeBooking.'"
            }';
       
    $url = $ip."/antrean/getlisttask";
  
    $process = curl_init($url); 
    curl_setopt($process, CURLOPT_HTTPHEADER,
          array("Content-Type: application/x-www-form-urlencoded\r\n" . 
                  "X-cons-id: $cons_id\r\n" . 
                  "X-Timestamp: $tStamp\r\n" . 
                  "X-Signature: $encodedSignature\r\n". 
                  "user_key: $userkey"));
    curl_setopt($process, CURLOPT_HEADER, false); 
    curl_setopt($process, CURLOPT_TIMEOUT, 30); 
    curl_setopt($process, CURLOPT_POST, true); 
    curl_setopt($process, CURLOPT_POSTFIELDS, $scml); 
    curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE); 
    $return = curl_exec($process); 
    curl_close($process);
    $response = json_decode($return, true);

    //var_dump($response);
    
    $sep=$response['metadata']['code'];     //sebelumnya metaData -> error
    
    $sepi=$response['metadata']['message'];
    
    if ($sep==200){          
         
         $string = $response['response'];
         $encrypt_method = 'AES-256-CBC';
   
         // hash
         $key_hash = hex2bin(hash('sha256', $key));
         
         // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
         $iv = substr(hex2bin(hash('sha256', $key)), 0, 16);
   
         $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key_hash, OPENSSL_RAW_DATA, $iv);
   
         $lihat = \LZCompressor\LZString::decompressFromEncodedURIComponent($output);
         echo $lihat;   

    }else{
       //echo $sepi. ' --> ' . $scml;   
       //echo $sepi;   
       echo   '  X-cons-id = '.$cons_id. ' X-Timestamp = '.$tStamp. ' X-Signature = '.$encodedSignature. ' user_key = '.$userkey;
    }
     
}


 if($reqdata=="spri"){
      $tgl=date("Y-m-d H:i:s");
      $tglbr=date("Y-m-d");
      $scml='{
                     "request": {
                        "noKartu":"'.$nokartu.'",
                        "kodeDokter":"'.$refdokter.'",
                        "poliKontrol":"JIW",
                        "tglRencanaKontrol":"'.$tgl_ren_kontrol.'",
                        "user":"wssimrs"
                     }
               }  
         ';   
      // $scml.="</t_sep>";
      //$scml.="</data>";
      //$scml.="</request>";
      $url = $ip."/RencanaKontrol/InsertSPRI";
      // $url = "https://new-api.bpjs-kesehatan.go.id:8080/new-vclaim-rest/SEP/1.1/insert";
      //$url= "http://172.16.2.16:80/WSLokalRest/SEP/insert";
      #$url="http://api.asterix.co.id/SepWebRest/sep/create/";
      //$url="http://dvlp.bpjs-kesehatan.go.id:8081/devwslokalrest/SEP/insert";

      #$nilai1="3201152704890003";
      #$url= "".$ip."/$nilai1";
      $process = curl_init($url); 
      curl_setopt($process, CURLOPT_HTTPHEADER,
            array("Content-Type: application/x-www-form-urlencoded\r\n" . "X-cons-id: $cons_id\r\n" . "X-Timestamp: $tStamp\r\n" . "X-Signature: $encodedSignature\r\n". "user_key: $userkey"));
      curl_setopt($process, CURLOPT_HEADER, false); 
      curl_setopt($process, CURLOPT_TIMEOUT, 30); 
      curl_setopt($process, CURLOPT_POST, true); 
      curl_setopt($process, CURLOPT_POSTFIELDS, $scml); 
      curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE); 
      $return = curl_exec($process); 
      curl_close($process);
      $response = json_decode($return, true);
      $no_surat_kontrol=$response[response]['noSuratKontrol'];
      $sep=$response[metaData]['code'];
      $sepi=$response[metaData]['message'];
      //echo $response;
      if ($sep==200){
         //echo $no_surat_kontrol;
         // function decrypt
         //  function stringDecrypt($key, $string){
            
            $string = $response['response'];
            $encrypt_method = 'AES-256-CBC';

            // hash
            $key_hash = hex2bin(hash('sha256', $key));
      
            // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
            $iv = substr(hex2bin(hash('sha256', $key)), 0, 16);

            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key_hash, OPENSSL_RAW_DATA, $iv);

            $lihat = \LZCompressor\LZString::decompressFromEncodedURIComponent($output);
            //print_r($lihat);
            echo $lihat;
         //  }
         //echo $scml;
      }

      else{
         echo $sepi;
      }
      #echo $scml;
      #;
      //echo $diagnosa;



}

if($reqdata=="ref_poli"){

   date_default_timezone_set('UTC');
   $cons_id = "22112";
   $secretKey = "5cN0BB19D1";
   $tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
   $data= $cons_id."&".$tStamp;
   $key = $cons_id.''.$secretKey.''.$tStamp;
   $signature = hash_hmac('sha256', $data, $secretKey, true);
   $encodedSignature = base64_encode($signature);
   $userkey = "556b3a1346f1c3ac4eeb197c85ea3f34";
   $ip = "https://apijkn-dev.bpjs-kesehatan.go.id/antreanrs_dev";

   $tgl=date("Y-m-d H:i:s");
   $tglbr=date("Y-m-d");
     
   //$ip= $ip."/ref/poli";
   //$ip= $ip."/ref/poli";
   $Parameter1 = "2023-01-30";
   $Parameter2 = "rs";
   $ip= $ip."/dashboard/waktutunggu/tanggal/".$Parameter1."/waktu/".$Parameter2."";
   echo $ip;
   exit;
   

   
   $nilai1=$nopeserta;
   $url= "".$ip;

   $curl = curl_init($url);
   curl_setopt($curl, CURLOPT_HEADER, false);
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($curl, CURLOPT_HTTPHEADER,
         array("Accept: application/json\r\n" . "X-Cons-ID: $cons_id\r\n" . "X-Timestamp: $tStamp\r\n" . "X-Signature: $encodedSignature\r\n". "user_key: $userkey"));
   curl_setopt($curl, CURLOPT_GET, true);
   curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
   $json_response = curl_exec($curl);
   curl_close($curl);
   $response = json_decode($json_response, true);
   $rest=$response['metadata']['code']; 

   //var_dump($response);
   //exit;
   //$rest=$response[metadata]['message']; 
   //echo $rest;
   //echo $json_response;  
   //exit;                                                
   if($rest==1){
      //$nama=$response['response']['peserta']['nama'];
      //$status= $response['response']['peserta']['statusPeserta']['keterangan'];
      //echo $nama.' —- '.status.' '.$status;
      //echo $json_response;
                        
      $string = $response['response'];
      $encrypt_method = 'AES-256-CBC';

      // hash
      $key_hash = hex2bin(hash('sha256', $key));
      
      // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
      $iv = substr(hex2bin(hash('sha256', $key)), 0, 16);

      $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key_hash, OPENSSL_RAW_DATA, $iv);

      $lihat = \LZCompressor\LZString::decompressFromEncodedURIComponent($output);
      echo $lihat;

   }
   else if($rest==201){
      echo $response['metadata']['message'];
   
   }
   else{
      echo "Error men";
      echo $response;
   }
}

if($reqdata=="ref_poli2"){

   date_default_timezone_set('UTC');
   $cons_id = "22112";
   $secretKey = "5cN0BB19D1";
   $tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
   $data= $cons_id."&".$tStamp;
   $key = $cons_id.''.$secretKey.''.$tStamp;
   $signature = hash_hmac('sha256', $data, $secretKey, true);
   $encodedSignature = base64_encode($signature);
   $userkey = "556b3a1346f1c3ac4eeb197c85ea3f34";
   $ip = "https://apijkn-dev.bpjs-kesehatan.go.id/antreanrs_dev";

   $tgl=date("Y-m-d H:i:s");
   $tglbr=date("Y-m-d");
     
   //$ip= $ip."/ref/poli";
   $ip= $ip."/ref/poli";
   
   $nilai1=$nopeserta;
   $url= "".$ip;

   $curl = curl_init($url);
   curl_setopt($curl, CURLOPT_HEADER, false);
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($curl, CURLOPT_HTTPHEADER,
         array("Accept: application/json\r\n" . "X-Cons-ID: $cons_id\r\n" . "X-Timestamp: $tStamp\r\n" . "X-Signature: $encodedSignature\r\n". "user_key: $userkey"));
   curl_setopt($curl, CURLOPT_GET, true);
   curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
   $json_response = curl_exec($curl);
   curl_close($curl);
   $response = json_decode($json_response, true);
   $rest=$response['metadata']['code']; 

   //var_dump($response);
   //exit;
   //$rest=$response[metadata]['message']; 
   //echo $rest;
   //echo $json_response;  
   //exit;                                                
   if($rest==1){
      //$nama=$response['response']['peserta']['nama'];
      //$status= $response['response']['peserta']['statusPeserta']['keterangan'];
      //echo $nama.' —- '.status.' '.$status;
      //echo $json_response;
                        
      $string = $response['response'];
      $encrypt_method = 'AES-256-CBC';

      // hash
      $key_hash = hex2bin(hash('sha256', $key));
      
      // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
      $iv = substr(hex2bin(hash('sha256', $key)), 0, 16);

      $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key_hash, OPENSSL_RAW_DATA, $iv);

      $lihat = \LZCompressor\LZString::decompressFromEncodedURIComponent($output);
      echo $lihat;

   }
   else if($rest==201){
      echo $response['metadata']['message'];
   
   }
   else{
      echo "Error men";
      echo $response;
   }
}

if($reqdata=="pulang"){
      $tgl=date("Y-m-d H:i:s");
      $tglbr=date("Y-m-d");
      $scml='{
                     "request":{
                        "t_sep":{
                              "noSep": "'.$nosep.'",
                              "statusPulang":"1",
                              "noSuratMeninggal":"",
                              "tglMeninggal":"",
                              "tglPulang":"'.$tglpulang.'",
                              "noLPManual":"",
                              "user":"wssimrs"
                        }
                     }
                  }
                  
      ';   
      // $scml.="</t_sep>";
      //$scml.="</data>";
      //$scml.="</request>";
      $url = $ip."/SEP/2.0/updtglplg";
      // $url = "https://new-api.bpjs-kesehatan.go.id:8080/new-vclaim-rest/SEP/1.1/insert";
      //$url= "http://172.16.2.16:80/WSLokalRest/SEP/insert";
      #$url="http://api.asterix.co.id/SepWebRest/sep/create/";
      //$url="http://dvlp.bpjs-kesehatan.go.id:8081/devwslokalrest/SEP/insert";

      #$nilai1="3201152704890003";
      #$url= "".$ip."/$nilai1";
      $curl = curl_init($url);
      curl_setopt($curl, CURLOPT_HEADER, false);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
      curl_setopt($curl, CURLOPT_POSTFIELDS, $scml); 
      curl_setopt($curl, CURLOPT_HTTPHEADER,
            array("Accept: application/json\r\n" . "X-cons-id: $cons_id\r\n" . "X-Timestamp: $tStamp\r\n" . "X-Signature: $encodedSignature\r\n". "user_key: $userkey"));
      #curl_setopt($curl, CURLOPT_HTTPGET, true);
      #curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
      $json_response = curl_exec($curl);
      #$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
      curl_close($curl);
      $response = json_decode($json_response, true);
      $rest=$response['metaData']['code'];
      $sepi=$response['metaData']['message'];
      //print_r($response);
      //echo $rest;
      if ($rest==200){
      //echo $no_surat_kontrol;
      // function decrypt
      //  function stringDecrypt($key, $string){
            
            $string = $response['response'];
            $encrypt_method = 'AES-256-CBC';

            // hash
            $key_hash = hex2bin(hash('sha256', $key));
      
            // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
            $iv = substr(hex2bin(hash('sha256', $key)), 0, 16);

            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key_hash, OPENSSL_RAW_DATA, $iv);

            $lihat = \LZCompressor\LZString::decompressFromEncodedURIComponent($output);
            //print_r($lihat);
            echo $lihat;
            echo $sepi;
      //  }
      //echo $scml;
      }

      else{
      echo $sepi;
      }
      #echo $scml;
      #;
      //echo $diagnosa;



}

//sep igd

if($reqdata=="sep_igd"){
  $tgl=date("Y-m-d H:i:s");
  $tglbr=date("Y-m-d");

                                 $poli = "IGD";
   // $scml='

   //                   {
   //            "request": {
   //               "t_sep": {
   //                  "noKartu": "'.$nopeserta.'",
   //                  "tglSep": "'.$tglreg.'",
   //                  "ppkPelayanan": "'.$ppk.'",
   //                  "jnsPelayanan": "2",
   //                  "klsRawat": "'.$kelas.'",
   //                  "noMR": "'.$nomr.'",
   //                  "rujukan": {
   //                     "asalRujukan": "1",
   //                     "tglRujukan": "'.$tglrujuk.'",
   //                     "noRujukan": "'.$norujukan.'",
   //                     "ppkRujukan": "'.$noppk.'"
   //                  },
   //                  "catatan": "'.$catatan.'",
   //                  "diagAwal": "'.$diagnosa.'",
   //                  "poli": {
   //                     "tujuan": "'.$poli.'",
   //                     "eksekutif": "0"
   //                  },
   //                  "cob": {
   //                     "cob": "0"
   //                  },
   //                  "katarak": {
   //                     "katarak": "0"
   //                  },
   //                  "jaminan": {
   //                     "lakaLantas": "'.$lakalantas.'",
   //                     "penjamin": {
   //                         "penjamin": "1",
   //                         "tglKejadian": "'.$tglrujuk.'",
   //                         "keterangan": "kll",
   //                         "suplesi": {
   //                             "suplesi": "0",
   //                             "noSepSuplesi": "0",
   //                             "lokasiLaka": {
   //                                 "kdPropinsi": "0",
   //                                 "kdKabupaten": "0",
   //                                 "kdKecamatan": "0"
   //                                 }
   //                         }
   //                     }
   //                  },
   //                  "skdp": {
   //                     "noSurat": "'.$notu.'",
   //                     "kodeDPJP": "'.$dpjp.'"
   //                  },
   //                  "noTelp": "'.$notelp.'",
   //                  "user": "Coba Ws"
   //               }
   //            }
   //         }                    
   //   ';   
   $scml='{
           "request":{
              "t_sep":{
                 "noKartu":"'.$nopeserta.'",
                 "tglSep":"'.$tglreg.'",
                 "ppkPelayanan":"'.$ppk.'",
                 "jnsPelayanan":"2",
                 "klsRawat":{
                    "klsRawatHak":"'.$kelas.'",
                    "klsRawatNaik":"",
                    "pembiayaan":"",
                    "penanggungJawab":""
                 },
                 "noMR":"'.$nomr.'",
                 "rujukan":{
                    "asalRujukan":"'.$fktp.'",
                    "tglRujukan":"'.$tglrujuk.'",
                    "noRujukan":"'.$norujukan.'",
                    "ppkRujukan":"'.$noppk.'"
                 },
                 "catatan":"'.$catatan.'",
                 "diagAwal":"'.$diagnosa.'",
                 "poli":{
                    "tujuan":"'.$poli.'",
                    "eksekutif":"0"
                 },
                 "cob":{
                    "cob":"0"
                 },
                 "katarak":{
                    "katarak":"0"
                 },
                 "jaminan":{
                    "lakaLantas":"0",
                    "penjamin":{
                       "tglKejadian":"",
                       "keterangan":"",
                       "suplesi":{
                          "suplesi":"0",
                          "noSepSuplesi":"",
                          "lokasiLaka":{
                             "kdPropinsi":"",
                             "kdKabupaten":"",
                             "kdKecamatan":""
                          }
                       }
                    }
                 },
                  "tujuanKunj":"'.$tujuankunj.'",
                 "flagProcedure":"'.$prosedur.'",
                 "kdPenunjang":"'.$penunjang.'",
                 "assesmentPel":"'.$assesmen.'",
                 "skdp":{
                    "noSurat":"'.$notu.'",
                    "kodeDPJP":"'.$dpjp.'"
                 },
                 "dpjpLayan":"'.$dpjppel.'",
                 "noTelp":"'.$notelp.'",
                 "user":"Coba Ws"
              }
           }
        }
   ';

      // $scml.="</t_sep>";
      //$scml.="</data>";
      //$scml.="</request>";
      $url = $ip."/SEP/2.0/insert";
      // $url = "https://new-api.bpjs-kesehatan.go.id:8080/new-vclaim-rest/SEP/1.1/insert";
      //$url= "http://172.16.2.16:80/WSLokalRest/SEP/insert";
      #$url="http://api.asterix.co.id/SepWebRest/sep/create/";
      //$url="http://dvlp.bpjs-kesehatan.go.id:8081/devwslokalrest/SEP/insert";

      #$nilai1="3201152704890003";
      #$url= "".$ip."/$nilai1";
      $process = curl_init($url); 
      curl_setopt($process, CURLOPT_HTTPHEADER,
            array("Content-Type: application/x-www-form-urlencoded\r\n" . "X-cons-id: $cons_id\r\n" . "X-Timestamp: $tStamp\r\n" . "X-Signature: $encodedSignature\r\n". "user_key: $userkey"));
      curl_setopt($process, CURLOPT_HEADER, false); 
      curl_setopt($process, CURLOPT_TIMEOUT, 30); 
      curl_setopt($process, CURLOPT_POST, true); 
      curl_setopt($process, CURLOPT_POSTFIELDS, $scml); 
      curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE); 
      $return = curl_exec($process); 
      curl_close($process);
      $response = json_decode($return, true);
      $no_sep=$response[response][sep]['noSep'];
      $sep=$response[metaData]['code'];
      $sepi=$response[metaData]['message'];
      //echo $response;
      if ($sep==200){
         //echo $no_sep;
         // function decrypt
         //  function stringDecrypt($key, $string){
            
            $string = $response['response'];
            $encrypt_method = 'AES-256-CBC';

            // hash
            $key_hash = hex2bin(hash('sha256', $key));
      
            // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
            $iv = substr(hex2bin(hash('sha256', $key)), 0, 16);

            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key_hash, OPENSSL_RAW_DATA, $iv);

            $lihat = \LZCompressor\LZString::decompressFromEncodedURIComponent($output);
            echo $lihat;
         //  }
         //echo $scml;
      }

      else{
         echo $sepi;
      }
      #echo $scml;
      #;
      //echo $diagnosa;



}


//sep ranap
if($reqdata=="sep_ranap"){
  $tglbr=date("Y-m-d");
  $diags=str_replace(".","",$diagnosa);
  // $scml='{
  //          "request": {
  //             "t_sep": {
  //                "noKartu": "'.$nopeserta.'",
  //                "tglSep": "'.$tglreg.'",
  //                "ppkPelayanan": "1403R001",
  //                "jnsPelayanan": "1",
  //                "klsRawat": "'.$kelas.'",
  //                "noMR": "'.$nomr.'",
  //                "rujukan": {
  //                   "asalRujukan": "2",
  //                   "tglRujukan": "'.$tglrujuk.'",
  //                   "noRujukan": "'.$norujukan.'",
  //                   "ppkRujukan": "1403R001"
  //                },
  //                "catatan": "'.$catatan.'",
  //                "diagAwal": "'.$diagnosa.'",
  //                "poli": {
  //                   "tujuan": "'.$poli.'",
  //                   "eksekutif": "0"
  //                },
  //                "cob": {
  //                   "cob": "0"
  //                },
  //                "katarak": {
  //                   "katarak": "'.$katarak.'"
  //                },
  //                "jaminan": {
  //                   "lakaLantas": "'.$lakalantas.'",
  //                   "penjamin": {
  //                       "penjamin": "1",
  //                       "tglKejadian": "'.$tglrujuk.'",
  //                       "keterangan": "kll",
  //                       "suplesi": {
  //                           "suplesi": "0",
  //                           "noSepSuplesi": "0",
  //                           "lokasiLaka": {
  //                               "kdPropinsi": "0",
  //                               "kdKabupaten": "0",
  //                               "kdKecamatan": "0"
  //                               }
  //                       }
  //                   }
  //                },
  //                "skdp": {
  //                   "noSurat": "'.$spri.'",
  //                   "kodeDPJP": "'.$dpjp.'"
  //                },
  //                "noTelp": "053121010",
  //                "user": "Coba Ws"
  //             }
  //          }
  //       }                    
  // ';
  $scml='{
           "request":{
              "t_sep":{
                 "noKartu":"'.$nopeserta.'",
                 "tglSep":"'.$tglreg.'",
                 "ppkPelayanan":"'.$ppk.'",
                 "jnsPelayanan":"1",
                 "klsRawat":{
                    "klsRawatHak":"'.$kelas.'",
                    "klsRawatNaik":"",
                    "pembiayaan":"",
                    "penanggungJawab":""
                 },
                 "noMR":"'.$nomr.'",
                 "rujukan":{
                    "asalRujukan":"'.$fktp.'",
                    "tglRujukan":"'.$tglrujuk.'",
                    "noRujukan":"'.$norujukan.'",
                    "ppkRujukan":"'.$ppk.'"
                 },
                 "catatan":"'.$catatan.'",
                 "diagAwal":"'.$diagnosa.'",
                 "poli":{
                    "tujuan":"'.$poli.'",
                    "eksekutif":"0"
                 },
                 "cob":{
                    "cob":"0"
                 },
                 "katarak":{
                    "katarak":"0"
                 },
                 "jaminan":{
                    "lakaLantas":"0",
                    "penjamin":{
                       "tglKejadian":"",
                       "keterangan":"",
                       "suplesi":{
                          "suplesi":"0",
                          "noSepSuplesi":"",
                          "lokasiLaka":{
                             "kdPropinsi":"",
                             "kdKabupaten":"",
                             "kdKecamatan":""
                          }
                       }
                    }
                 },
                 "tujuanKunj":"'.$tujuankunj.'",
                 "flagProcedure":"'.$prosedur.'",
                 "kdPenunjang":"'.$penunjang.'",
                 "assesmentPel":"'.$assesmen.'",
                 "skdp":{
                    "noSurat":"'.$notu.'",
                    "kodeDPJP":"'.$dpjp.'"
                 },
                 "dpjpLayan":"'.$dpjppel.'",
                 "noTelp":"'.$notelp.'",
                 "user":"Coba Ws"
              }
           }
        }
   ';
               //var_dump($scml);
   //$url= "http://dvlp.bpjs-kesehatan.go.id:8081/devwslokalrest/SEP/insert";
   //$url= "http://192.168.1.124:9090/wslokalrest-2.1/SEP/insert";
   $url = $ip."/SEP/2.0/insert";
   //$url= "http://172.16.2.16:80/WSLokalRest/SEP/insert";
   #$url="http://api.asterix.co.id/SepWebRest/sep/create/";
   //$url="http://dvlp.bpjs-kesehatan.go.id:8081/devwslokalrest/SEP/insert";

   #$nilai1="3201152704890003";
   #$url= "".$ip."/$nilai1";
   $process = curl_init($url); 
   curl_setopt($process, CURLOPT_HTTPHEADER,
         array("Content-Type: application/x-www-form-urlencoded\r\n" . "X-cons-id: $cons_id\r\n" . "X-Timestamp: $tStamp\r\n" . "X-Signature: $encodedSignature\r\n". "user_key: $userkey"));
   curl_setopt($process, CURLOPT_HEADER, false); 
   curl_setopt($process, CURLOPT_TIMEOUT, 30); 
   curl_setopt($process, CURLOPT_POST, true); 
   curl_setopt($process, CURLOPT_POSTFIELDS, $scml); 
   curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE); 
   $return = curl_exec($process); 
   curl_close($process);
   $response = json_decode($return, true);
   $no_sep=$response[response][sep]['noSep'];
   $sep=$response[metaData]['code'];
   $sepi=$response[metaData]['message'];
   //echo $response;
   if ($sep==200){
   //echo $no_sep;
   // function decrypt
   //  function stringDecrypt($key, $string){
         
         $string = $response['response'];
         $encrypt_method = 'AES-256-CBC';

         // hash
         $key_hash = hex2bin(hash('sha256', $key));
   
         // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
         $iv = substr(hex2bin(hash('sha256', $key)), 0, 16);

         $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key_hash, OPENSSL_RAW_DATA, $iv);

         $lihat = \LZCompressor\LZString::decompressFromEncodedURIComponent($output);
         echo $lihat;
   //  }
   //echo $scml;
   }

   else{
   echo $sep;
   echo $sepi;
   }
   #echo $scml;
   #;
   //echo $diagnosa;



}

//rujukan picker
if($reqdata=="rujukan"){
      $tgl=date("Y-m-d H:i:s");
      $tglbr=date("Y-m-d");
         #$ip="http://api.asterix.co.id/SepWebRest/peserta";
      #$ip= "http://172.16.1.224:82/WSLokalRest/Peserta/peserta";
      if ($jenis!='nik'){
         $ip = $ip."/Peserta/nokartu";
         //$ip= "http://172.16.2.16:80/WSLokalRest/Peserta/peserta";
      //$ip="http://dvlp.bpjs-kesehatan.go.id:8081/devwslokalrest/Peserta/peserta";
      }
      else{
         $ip= $ip."/Peserta/nik";
      //$ip="http://dvlp.bpjs-kesehatan.go.id:8081/devwslokalrest/Peserta/peserta/nik";
      }
      $nilai1=$nopeserta;
      $url= "".$ip."/".$nilai1."/tglSEP/".$tglbr."";
      $curl = curl_init($url);
      curl_setopt($curl, CURLOPT_HEADER, false);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_HTTPHEADER,
            array("Accept: application/json\r\n" . "X-Cons-ID: $cons_id\r\n" . "X-Timestamp: $tStamp\r\n" . "X-Signature: $encodedSignature\r\n". "user_key: $userkey"));
      curl_setopt($curl, CURLOPT_GET, true);
      curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
      $json_response = curl_exec($curl);
      curl_close($curl);
      $response = json_decode($json_response, true);
      $rest=$response[metaData]['code']; 
      //$rest=$response[metadata]['message']; 
      //echo $rest;
      //echo $json_response;                                                  
      if($rest==200){
         $nama=$response[response][peserta]['nama'];
         $status= $response[response][peserta][statusPeserta]['keterangan'];
         //echo $nama.' —- '.status.' '.$status;
         //echo $json_response;
         // function decrypt
         //  function stringDecrypt($key, $string){
               
               $string = $response['response'];
               $encrypt_method = 'AES-256-CBC';

               // hash
               $key_hash = hex2bin(hash('sha256', $key));
         
               // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
               $iv = substr(hex2bin(hash('sha256', $key)), 0, 16);

               $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key_hash, OPENSSL_RAW_DATA, $iv);

               $lihat = \LZCompressor\LZString::decompressFromEncodedURIComponent($output);
               echo $lihat;
         //  }

      }
      else if($rest==201){
         echo $response[metaData]['message'];
      
      }
      else{
         echo "Error men";
         echo $response;
      }
}

if($reqdata=="norujukan"){
  
if ($Fktp=='1') {
   $ip= $ip."/Rujukan/";
 } 
 else{
  $ip= $ip."/Rujukan/RS/";
 }

//$ip= "http://dvlp.bpjs-kesehatan.go.id:8081/devwslokalrest/Rujukan";
$nilai1=$norujukan;
$url= "".$ip."$nilai1";
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER,
        array("Accept: application/json\r\n" . "X-cons-id: $cons_id\r\n" . "X-Timestamp: $tStamp\r\n" . "X-Signature: $encodedSignature\r\n". "user_key: $userkey"));
curl_setopt($curl, CURLOPT_GET, true);
#curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
$json_response = curl_exec($curl);
#$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);
$response = json_decode($json_response, true);
$rest=$response[metaData]['code'];
//echo $json_response;
//echo $json_response;
//echo $nilai1;

if($rest==200){
//$diagnosa=$response[response]['item']['diagnosa']['kdDiag'];
//echo $diagnosa;
//echo $json_response;
// function decrypt
  //  function stringDecrypt($key, $string){
        
        $string = $response['response'];
        $encrypt_method = 'AES-256-CBC';

        // hash
        $key_hash = hex2bin(hash('sha256', $key));
  
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hex2bin(hash('sha256', $key)), 0, 16);

        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key_hash, OPENSSL_RAW_DATA, $iv);

        $lihat = \LZCompressor\LZString::decompressFromEncodedURIComponent($output);
        echo $lihat;
  //  }
}
elseif($rest==201){
$diagnosa=$response[metaData]['message'];
echo $diagnosa;
}


else{
echo "error coy";
echo $url;
echo $rest;
}
}

if($reqdata=="listkontrol"){
  

  $ip= $ip."/RencanaKontrol/ListRencanaKontrol/tglAwal/2021-11-01/tglAkhir/2021-11-30/filter/2";


//$ip= "http://dvlp.bpjs-kesehatan.go.id:8081/devwslokalrest/Rujukan";
//$nilai1=$norujukan;
$url= "".$ip."$nilai1";
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER,
        array("Accept: application/json\r\n" . "X-cons-id: $cons_id\r\n" . "X-Timestamp: $tStamp\r\n" . "X-Signature: $encodedSignature\r\n". "user_key: $userkey"));
curl_setopt($curl, CURLOPT_GET, true);
#curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
$json_response = curl_exec($curl);
#$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);
$response = json_decode($json_response, true);
$rest=$response[metaData]['code'];
//echo $json_response;
//echo $json_response;
//echo $nilai1;

if($rest==200){
//$diagnosa=$response[response]['item']['diagnosa']['kdDiag'];
//echo $diagnosa;
//echo $json_response;
// function decrypt
  //  function stringDecrypt($key, $string){
        
        $string = $response['response'];
        $encrypt_method = 'AES-256-CBC';

        // hash
        $key_hash = hex2bin(hash('sha256', $key));
  
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hex2bin(hash('sha256', $key)), 0, 16);

        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key_hash, OPENSSL_RAW_DATA, $iv);

        $lihat = \LZCompressor\LZString::decompressFromEncodedURIComponent($output);
        echo $lihat;
  //  }
}
elseif($rest==201){
$diagnosa=$response[metaData]['message'];
echo $diagnosa;
}


else{
echo "error coy";
echo $url;
echo $rest;
}
}

if($reqdata=="deletesep"){
$scml='{
       "request": {
          "t_sep": {
             "noSep": "'.$noSep.'",
             "user": "Delete bridging Ws"
          }
       }
    }                 
  ';
  
$ip= $ip."/SEP/Delete";
//$ip= "http://dvlp.bpjs-kesehatan.go.id:8081/devwslokalrest/Rujukan";
$nilai1=$nopeserta;
$url= $ip;
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
curl_setopt($curl, CURLOPT_POSTFIELDS, $scml); 
curl_setopt($curl, CURLOPT_HTTPHEADER,
        array("Accept: application/json\r\n" . "X-cons-id: $cons_id\r\n" . "X-Timestamp: $tStamp\r\n" . "X-Signature: $encodedSignature\r\n". "user_key: $userkey"));
#curl_setopt($curl, CURLOPT_HTTPGET, true);
#curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
$json_response = curl_exec($curl);
#$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);
$response = json_decode($json_response, true);
$rest=$response['metaData']['code'];
//echo $json_response;
//echo $json_response;
//echo $nilai1;

if($rest==200){
//$diagnosa=$response[response]['item']['diagnosa']['kdDiag'];
//echo $diagnosa;
echo $response['metaData']['message'];;
}
elseif($rest==201){
$diagnosa=$response['metaData']['message'];
echo $diagnosa;
}


else{
echo "error coy";
echo $url;
echo $rest;
}
}

if($reqdata=="historirujukan"){
  
 if($Fktp=1){
  $ip= $ip."/Rujukan/Peserta/";
 } 
else{
  $ip= $ip."/Rujukan/RS/Peserta/";
}
//$ip= "http://dvlp.bpjs-kesehatan.go.id:8081/devwslokalrest/Rujukan";
$nilai1=$nopeserta;
$url= "".$ip."$nilai1";
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER,
        array("Accept: application/json\r\n" . "X-cons-id: $cons_id\r\n" . "X-Timestamp: $tStamp\r\n" . "X-Signature: $encodedSignature\r\n". "user_key: $userkey"));
curl_setopt($curl, CURLOPT_GET, true);
#curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
$json_response = curl_exec($curl);
#$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);
$response = json_decode($json_response, true);
$rest=$response[metaData]['code'];
//echo $json_response;
//echo $json_response;
//echo $nilai1;

if($rest==200){
//$diagnosa=$response[response]['item']['diagnosa']['kdDiag'];
//echo $diagnosa;
//echo $json_response;
$string = $response['response'];
        $encrypt_method = 'AES-256-CBC';

        // hash
        $key_hash = hex2bin(hash('sha256', $key));
  
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hex2bin(hash('sha256', $key)), 0, 16);

        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key_hash, OPENSSL_RAW_DATA, $iv);

        $lihat = \LZCompressor\LZString::decompressFromEncodedURIComponent($output);
        echo $lihat;
}
elseif($rest==201){
$diagnosa=$response[metaData]['message'];
echo $diagnosa;
}


else{
echo "error coy";
echo $url;
echo $rest;
}
}
}
?>