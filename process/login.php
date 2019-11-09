<?php
    session_start();
    include '../library/configServer.php';
    include '../library/consulSQL.php';
    //include 'C:\xampp\htdocs\OnlineStore\process\PHPMailer.php';
    //include 'C:\xampp\htdocs\OnlineStore\process\SMTP.php';
    
    sleep(2);
    $nombre=$_POST['nombre-login'];
    $clave=md5($_POST['clave-login']);
    $radio=$_POST['optionsRadios'];
    
    if(!$nombre==""&&!$clave==""){
        $verUser=ejecutarSQL::consultar("select * from cliente where Nombre='$nombre' and Clave='$clave'");
        $verAdmin=ejecutarSQL::consultar("select * from administrador where Nombre='$nombre' and Clave='$clave'");
        $address=  ejecutarSQL::consultar("select Email from cliente where Nombre='$nombre' and Clave='$clave'");
        $correoOk="";
        while ($row = $address->fetch_assoc()) {
            $correoOk=$row['Email'];
        }
         
        
        
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////7

        // primero hay que incluir la clase phpmailer para poder instanciar
  //un objeto de la misma
  require "PHPMailer.php";
  require "SMTP.php";

  $mail = new PHPMailer\PHPMailer\PHPMailer();
$mail->IsSMTP();
$mail->CharSet = 'UTF-8';
$mail->Host = "smtp.live.com";
$mail->SMTPAuth= true;
$mail->Port = 587;
$mail->Username= 'fvilar3@outlook.com';
$mail->Password= 'atlante3910';
$mail->SMTPSecure = 'tls';
$mail->From = 'fvilar3@outlook.com';
$mail->FromName= 'Luis Eduardo';
$mail->isHTML(true);
$mail->Subject = 'Prueba mailer';
$mail->Body = 'Mensaje';
$mail->addAddress($correoOk);
if(!$mail->send()){
    echo "Mailer Error: " . $mail->ErrorInfo;
   }else{
    echo "E-Mail has been sent";
   }

   /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////7



}
        if($radio=="option2"){
            $AdminC=mysqli_num_rows($verAdmin);
            if($AdminC>0){
                $_SESSION['nombreAdmin']=$nombre;
                $_SESSION['claveAdmin']=$clave;
                echo '<script> location.href="index.php"; </script>';
            }else{
              echo '<img src="assets/img/error.png" class="center-all-contens"><br>Error nombre o contraseña invalido'; 
            }
        }
        if($radio=="option1"){
            $UserC=mysqli_num_rows($verUser);
            if($UserC>0){
                $_SESSION['nombreUser']=$nombre;
                $_SESSION['claveUser']=$clave;
                echo '<script> location.href="index.php"; </script>';

            }else{
                echo '<img src="assets/img/error.png" class="center-all-contens"><br>Error nombre o contraseña invalido';
            }
        }

    


    else{
        echo '<img src="assets/img/error.png" class="center-all-contens"><br>Error campo vacío<br>Intente nuevamente';
    }
    