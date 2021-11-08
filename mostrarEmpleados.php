<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Usuarios</title>
</head>
<body>

<?php
$ida= $_REQUEST["idadmin"];
$namea= $_REQUEST["nameadmin"];

echo "Administrador: ".$namea."<br>ID: ".$ida;

// --------MOSTRAR EMPLEADOS EN TABLA---------
$muestra = fopen("archivoEmpleado.txt","r");
print("<h1>Registros de empleado</h1>");
// Creamos la tabla
print("<table border='1'><tr><th>ID</th><th>Nombre</th><th>Fotografía</th><th>Puesto</th><th>Salario</th><th>Sexo</th><th>Prestamo</th><th>Monto</th><th>Número de quincenas</th></tr>");
do{
    $id=fgets($muestra);
    $pass=fgets($muestra);
    $nom=fgets($muestra);
    $foto=fgets($muestra);
    $puesto=fgets($muestra);
    $sal=fgets($muestra);
    $sex=fgets($muestra);
    $leer = fopen("prestamoEmpleado.txt","r");
    $estado = "No Solicitado";
    $monto = "-----";
    $quincenas = "-----";

    print("<tr>");

    if($id!=''){

        echo "<td><a href=eliminarEmpleado.php?idadmin=$ida&nameadmin=$namea&id=$id>$id</a></td><td>$nom</td><td><img src=$foto style='width: 100px'; height: 100px;></img></td><td>$puesto</td><td>$sal</td><td>$sex</td>";
        while(!feof($leer)){
            $idPres=fgets($leer);
            $monPres=fgets($leer);
            $quinPres=fgets($leer);

            if($idPres == $id){
                $estado = "Solicitado";
                $monto = $monPres;
                $quincenas = $quinPres;
            }
        }
        if($estado == "Solicitado"){
            echo "<td>$estado</td><td>$$monto</td><td>$quincenas quincenas</td>";
        }else{
            echo "<td>$estado</td><td>$monto</td><td>$quincenas</td>";
        }
    }
    print("</tr>");
    fclose($leer);
// Evalua si lee el archivo
} while(!feof($muestra));

// Cerramos la tabla
print("</table>");

// Cerramos el archivo
fclose($muestra);

print("</table>");
// header("location:mostrarEmpleados.php?idadmin=$ida&nameadmin=$namea");
echo "<a href=interfazAdministrador.php?idadmin=$ida&nameadmin=$namea><button type=button class=btn btn-warning>Volver</button></a>";

?>


</body>
</html>