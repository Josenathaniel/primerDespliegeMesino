<?php
// VALIDACION DE LA SESION DEL ADMINISTRADOR
$id=$_POST["inicioId"];
$pass=$_POST["inicioPass"];

//leer el archivo para ver si existe
$leer=fopen("archivoAdmin.txt","r");
$flag = false;
$flagFin = false;
while(!feof($leer)){
    $claveid=fgets($leer);
    $password=fgets($leer);
    $nombreAd=fgets($leer);
    $claveFoto=fgets($leer);
    $clavePuesto=fgets($leer);
    $claveSal=fgets($leer);
    $claveSex=fgets($leer);

    if($id==$claveid && $pass==$password){
        ////en el caso de que encuentre el id y contraseña abrira la ventana del administrador
        header("location:interfazAdministrador.php?idadmin=$id&nameadmin=$nombreAd");
        $flag = true;
        break;
    }
}

// VALIDACION DE LA SESION DEL EMPLEADO
if($flag==false){
    $leerEs = fopen("archivoEmpleado.txt", "r");
    while(!feof($leerEs)){
        $claveidEm=fgets($leerEs);
        $passwordEm=fgets($leerEs);
        $nombreEm=fgets($leerEs);
        $claveFotoEm=fgets($leerEs);
        $clavePuestoEm=fgets($leerEs);
        $claveSalEm=fgets($leerEs);
        $claveSexEm=fgets($leerEs);
    

        if($id==$claveidEm && $pass==$passwordEm){
            ////en el caso de que encuentre el id y contraseña abrira la ventana del empleado
            header("location:interfazEmpleado.php?idempleado=$id&nameempleado=$nombreEm");
            $flagFin = true;
            break;
        }
    }
    if($flagFin==false){
        header("location:index.html");
    }
    fclose($leerEs);
}

fclose($leer);

?>