
<?php
$texto_planoa ="root";
$texto_planob ="localhost";
$texto_planoc ="store";
$texto_planod ="";
$texto_total = $texto_planoa.$texto_planob.$texto_planoc.$texto_planod;
$texto_encriptado="";
$texto_desencriptado="";
$llave_publica = "-----BEGIN CERTIFICATE-----
MIIDgTCCAmkCFC982sEoZaKsVBzLptdmYboYvWCQMA0GCSqGSIb3DQEBCwUAMH0x
CzAJBgNVBAYTAk1YMQ8wDQYDVQQIDAZUb2x1Y2ExDzANBgNVBAcMBlRvbHVjYTEU
MBIGA1UECgwLRW1wcmVzYSBDby4xDDAKBgNVBAsMA0VNUDEMMAoGA1UEAwwDUm95
MRowGAYJKoZIhvcNAQkBFgsxMjNANDU2LmNvbTAeFw0xOTA2MTcyMzQ3NDFaFw0y
MDA2MTYyMzQ3NDFaMH0xCzAJBgNVBAYTAk1YMQ8wDQYDVQQIDAZUb2x1Y2ExDzAN
BgNVBAcMBlRvbHVjYTEUMBIGA1UECgwLRW1wcmVzYSBDby4xDDAKBgNVBAsMA0VN
UDEMMAoGA1UEAwwDUm95MRowGAYJKoZIhvcNAQkBFgsxMjNANDU2LmNvbTCCASIw
DQYJKoZIhvcNAQEBBQADggEPADCCAQoCggEBALIjh++QLuU+l5SxXAF/tyZ6GVL+
SIgVqH1I9eVAbZOFxUn6eNDU5nUsAXcckh+iNyoCqxksg6bAEB0DI3ZBftEPTC82
hDoDzt1xJ+7A7KDAuuG9nHDfvSzFxaf16zhH7yvkq8MPBD9baHT52mta09z9SUvF
6kkWaDSpKFJG1lAmxSVdmn6JLYzJzMH+M08C6ZTfvgYV2BZlgzEC6Lu0TsR4azqd
j5QYivz1cUSwv7Qh2/ssbzmdq6bf4/7iwAhWndXDCUqah4/F+UZwXcBFyPtf6uY1
gWhuqE5rtwO8fw8nPeIvCrVo7urFPdMPG9tj2PLxb7Gx/RiGpb0HsD7IgEsCAwEA
ATANBgkqhkiG9w0BAQsFAAOCAQEAG0US716H9FdrinERk+EfjShw6xTap1wEOfDa
AhhW2Jo77kbt2KJ4z6eAlYj889hjbbJgkldkE5go+U7nvTDfeeirh+eVHgHuAT9D
hBEH6qsn9ss6IJZw75sy/T1o9jrUnIl+/mXE7jJ8tFJ5TadezsDUY/u/VhecpVdd
7BEWWR+uQHdW7IhKy70PyiV8eYq6eRjnJiHKKAu46zr6zS8VQLDfy5rdXuP0ZKNH
nXSkqgmX51ZBUz0RlwXcwfIiYU8gBir7L230sOhbo5Y1FcCY371x225xVBGIQBX6
/rlN9bmwdLot8pfRi3VA8q4IVax9ZGim3RneTz/T9rl1aRzGhw==
-----END CERTIFICATE-----";
$llave_pub = openssl_pkey_get_public($llave_publica);
openssl_public_encrypt($texto_total, $texto_encriptado, $llave_pub);
//openssl_public_encrypt($texto_planob, $texto_encriptadob, $llave_pub);
//openssl_public_encrypt($texto_planoc, $texto_encriptadoc, $llave_pub);
//openssl_public_encrypt($texto_planod, $texto_encriptadod, $llave_pub);
//$path_llave_privada="C:\xampp\htdocs\firma\prueba1.key";

$fp1=fopen("C:/encriptado/miarchivo.txt","w");
//$archivo = $texto_encriptadoa.PHP_EOL.$texto_encriptadob.PHP_EOL.$texto_encriptadoc.PHP_EOL.$texto_encriptadod;
fwrite($fp1,$texto_encriptado);
//fwrite($fp1,$texto_encriptadoa."\n")
//fwrite($fp1,$texto_encriptadob."\n")
//fwrite($fp1,$texto_encriptadoc."\n")
//fwrite($fp1,$texto_encriptadod."\n")
//fputs($fp1,$texto_encriptadoa);
//fputs($fp1,$texto_encriptadob);
//fputs($fp1,$texto_encriptadoc);
//fputs($fp1,$texto_encriptadod);
fclose($fp1);



// abrimos la privada
$fp=fopen("C:\prueba22.key", "r");
$llave_privada = fread($fp,8192);
fclose($fp);

//Esto debe dar como salida el mismo texto que antes estaba en la variable $texto_plano


$fp2=fopen("C:/encriptado/miarchivo.txt","r");
//lee

//if ($fp2=fopen("C:/encriptado/miarchivo.txt","r")) {
  //  for($i = 1; $i <=4; $i++) {
    //    $texto_encriptado.$i = fgets($fp2);
      //  # do same stuff with the $line
   // }
//    fclose($fp2);
//}
$texto_encriptado=fread($fp2,8192);
//$texto_encriptado2=fgets($fp2);
//$texto_encriptado3=fgets($fp2);
//$texto_encriptado4=fgets($fp2);
fclose($fp2);

 

$res = openssl_get_privatekey($llave_privada);
openssl_private_decrypt($texto_encriptado, $texto_desencriptado, $res);
//openssl_private_decrypt($texto_encriptado2, $texto_desencriptadob, $res);
//openssl_private_decrypt($texto_encriptado3, $texto_desencriptadoc, $res);
//openssl_private_decrypt($texto_encriptado4, $texto_desencriptadod, $res);

$fp2=fopen("C:/encriptado/miarchivo2.txt","w+");
//$archivo = $texto_encriptadoa.PHP_EOL.$texto_encriptadob.PHP_EOL.$texto_encriptadoc.PHP_EOL.$texto_encriptadod;
fwrite($fp2,$texto_desencriptado);
$texto_desencriptadoa = fread($fp2,4);
$texto_desencriptadob = fread($fp2,9);
$texto_desencriptadoc = fread($fp2,5);
$texto_desencriptadod = fread($fp2,1);
fclose($fp2);



//define("USER", $texto_desencriptadoa);
//define("SERVER", $texto_desencriptadob);
//define("BD", $texto_desencriptadoc);
//define("PASS", $texto_desencriptadod);


//define("USER", "root");
//define("SERVER", "localhost");
//define("BD", "store");
//define("PASS", "");

