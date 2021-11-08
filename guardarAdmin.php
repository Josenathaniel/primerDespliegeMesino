<?php

$id = $_POST["registerId"];
$pass = $_POST["registerPassword"];
$nom = $_POST["registerNombre"];
$foto = $_POST["registerFoto"];
$puesto = $_POST["registerEmpleado"];
$salario = $_POST["registerSalario"];
$sexo = $_POST["sexoAdmin"];


$existeid=false;

// VALIDACION DE LA SESION DEL EMPLEADO
    $leerEs = fopen("archivoEmpleado.txt", "r");
    while(!feof($leerEs)){
        $claveidEm=fgets($leerEs);
        $passwordEm=fgets($leerEs);
        $nombreEm=fgets($leerEs);
        $claveFotoEm=fgets($leerEs);
        $clavePuestoEm=fgets($leerEs);
        $claveSalEm=fgets($leerEs);
        $claveSexEm=fgets($leerEs);
    
        if($id==$claveidEm){
            ////en el caso de que encuentre el id y contraseña abrira la ventana del empleado
            echo "Este id ya existe y es de un empleado";
            echo "<br><a href=tipoUsuario.html?><button type=button class=btn btn-warning>Volver a intentar</button></a>";
            $existeid = true;
            break;
        }
    }
    fclose($leerEs);

if ($existeid==false){
    $ruta = "archivoAdmin.txt";
    if(file_exists($ruta)){
        $leer=fopen("archivoAdmin.txt","r");
        $flag=true;
        while(!feof($leer)){
            $claveId=fgets($leer);
            $clavePass=fgets($leer);
            $claveNom=fgets($leer);
            $claveFoto=fgets($leer);
            $clavePuesto=fgets($leer);
            $claveSal=fgets($leer);
            $claveSexo=fgets($leer);
            // $claveSex=fgets($leer);
            
            if($id==$claveId){
                echo "ERROR.....ya existe un registro con ese ID<br>";
                $flag=false;
                break;
            }
        }
        fclose($leer);

        if($flag==true){
            // Escribir en el archivo
            $fileSave = fopen("archivoAdmin.txt", "a+");
            // Capturamos en el archivo
            fputs($fileSave,$id."\n");
            fputs($fileSave,$pass."\n");
            fputs($fileSave,$nom."\n");
            fputs($fileSave,$foto."\n");
            fputs($fileSave,$puesto."\n");
            fputs($fileSave,$salario."\n");
            fputs($fileSave,$sexo."\n");
            // fputs($fileSave,$claveSex."\n");
            fclose($fileSave);
        }

    }else{
            // Escribir en el archivo
            $fileSave = fopen("archivoAdmin.txt", "a+");
            // Capturamos en el archivo
            fputs($fileSave,$id."\n");
            fputs($fileSave,$pass."\n");
            fputs($fileSave,$nom."\n");
            fputs($fileSave,$foto."\n");
            fputs($fileSave,$puesto."\n");
            fputs($fileSave,$salario."\n");
            fputs($fileSave,$sexo."\n");
            // fputs($fileSave,$claveSex."\n");
            fclose($fileSave);

    }

print("Registro de Administrador realizado con exito!!!");
print("<br><a href=index.html>Iniciar sesión</a>");

}

?>