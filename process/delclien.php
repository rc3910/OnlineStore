<?php
session_start();
include '../library/configServer.php';
include '../library/consulSQL.php';

sleep(5);
$nameCl= $_POST['clien-name'];
$consC=  ejecutarSQL::consultar("select * from cliente where Nombre='$nameCl'");
$totalC = mysqli_num_rows($consC);

if($totalC>0){
    if(consultasSQL::DeleteSQL('cliente', "Nombre='".$nameCl."'")){
        echo '<img src="assets/img/correcto.png" class="center-all-contens"><br><p class="lead text-center">cliente eliminado éxitosamente</p>';
    }else{
       echo '<img src="assets/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">Ha ocurrido un error.<br>Por favor intente nuevamente</p>'; 
    }
}else{
    echo '<img src="assets/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">El nombre del cliente no existe</p>';
}

