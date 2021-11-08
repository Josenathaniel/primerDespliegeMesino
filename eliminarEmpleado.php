<?php
// METODO PARA ELIMINAR EL EMPLEADO
// recibe el id que se quiere eliminar
$idd = (int)"$_REQUEST[id]";

// Redirecciona
$ida= $_REQUEST["idadmin"];
$namea= $_REQUEST["nameadmin"];


$leerPres = fopen("prestamoEmpleado.txt","r");
$leer  = fopen("archivoEmpleado.txt","r");
$escribir = fopen("temp.txt","a+");
$flag = false;


while(!feof($leerPres)){
    $idP = fgets($leerPres);
    if($idP == $idd){
        $flag = true;
        break;
    }
}


if($flag==false){
    while(!feof($leer)){
        $id=fgets($leer);
        $pass=fgets($leer);
        $nom=fgets($leer);
        $foto=fgets($leer);
        $puesto=fgets($leer);
        $sal=fgets($leer);
        $sexo=fgets($leer);
        if($idd!=$id){
            fputs($escribir,$id);
            fputs($escribir,$pass);
            fputs($escribir,$nom);
            fputs($escribir,$foto);
            fputs($escribir,$puesto);
            fputs($escribir,$sal);
            fputs($escribir,$sexo);
        }
    }
    fclose($leer);
    fclose($escribir);
    rename("temp.txt", "archivoEmpleado.txt");
}

fclose($leerPres);
header("location:mostrarEmpleados.php?idadmin=$ida&nameadmin=$namea");


?>
