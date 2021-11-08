<?php
// METODO PARA MODIFICAR LOS DATOS DEL ADMINISTRADOR
$id = $_POST["updateId"];
$pass = $_POST["updatePassword"];
$nom = $_POST["updateNombre"];
$foto = $_POST["updateFoto"];
$puesto = $_POST["updateEmpleado"];
$salario = $_POST["updateSalario"];
$sexo = $_POST["updateEmp"];

$leer  = fopen("archivoEmpleado.txt","r");
// Archivo temporal
$escribir = fopen("temp.txt","a+");

while(!feof($leer)){
    $claveId=fgets($leer);
    $clavePass=fgets($leer);
    $claveNom=fgets($leer);
    $claveFoto=fgets($leer);
    $clavePuesto=fgets($leer);
    $claveSal=fgets($leer);
    $claveSex=fgets($leer);

    if($id!=$claveId){
        fputs($escribir,$claveId);
        fputs($escribir,$clavePass);
        fputs($escribir,$claveNom);
        fputs($escribir,$claveFoto);
        fputs($escribir,$clavePuesto);
        fputs($escribir,$claveSal);
        fputs($escribir,$claveSex);
    }else{
         // Capturamos en el archivo
         fputs($escribir,$id."\n");
         fputs($escribir,$pass."\n");
         fputs($escribir,$nom."\n");
         fputs($escribir,$foto."\n");
         fputs($escribir,$puesto."\n");
         fputs($escribir,$salario."\n");
         fputs($escribir,$sexo."\n");
    }
}

fclose($leer);
fclose($escribir);
rename("temp.txt", "archivoEmpleado.txt");

header("location:interfazEmpleado.php?idempleado=$id&nameempleado=$nom");

?>
