<!-- METODO PARA AGREGAR EL EMPLEADO -->
<?php

$id = $_POST["registerIdEmp"];
$pass = $_POST["registerPasswordEmp"];
$nom = $_POST["registerNombreEmp"];
$foto = $_POST["registerFotoEmp"];
$puesto = $_POST["registerEmpleadoEmp"];
$salario = $_POST["registerSalarioEmp"];
$sexo = $_POST["sexoEmp"];



$existeid=false;

//leer el archivo para ver si existe
$leeradmin=fopen("archivoAdmin.txt","r");

while(!feof($leeradmin)){
    $claveidadmin=fgets($leeradmin);
    $passwordadmin=fgets($leeradmin);
    $nombreadmin=fgets($leeradmin);
    $claveFotoadmin=fgets($leeradmin);
    $clavePuestoadmin=fgets($leeradmin);
    $claveSaladmin=fgets($leeradmin);
    $claveSexadmin=fgets($leeradmin);

    if($id==$claveidadmin){
        echo "Este id ya existe y es de un Administrador";
        echo "<br><a href=tipoUsuario.html?><button type=button class=btn btn-warning>Volver a intentar</button></a>";
        $existeid = true;
        break;
    }
}
fclose($leeradmin);




if ($existeid==false){
$ruta = "archivoEmpleado.txt";
if(file_exists($ruta)){
    $leer=fopen("archivoEmpleado.txt","r");
    $flag=true;
    while(!feof($leer)){
        $claveId=fgets($leer);
        $clavePass=fgets($leer);
        $claveNom=fgets($leer);
        $claveFoto=fgets($leer);
        $clavePuesto=fgets($leer);
        $claveSal=fgets($leer);
        $claveSex=fgets($leer);
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
        $fileSave = fopen("archivoEmpleado.txt", "a+");
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
        $fileSave = fopen("archivoEmpleado.txt", "a+");
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

print("Registro de Empleado realizado con exito!!!");
print("<br><a href=index.html>Iniciar sesión</a>");


}

?>