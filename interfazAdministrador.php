<!-- INTERFAZ DEL ADMINISTRADOR despues de iniciar sesion -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Administrador</title>
</head>

<body>


<?php 
        $id= $_REQUEST["idadmin"];
        $nombre= $_REQUEST["nameadmin"];

        // LEYENDO ARCHIVO TXT
        $rutaAd = "archivoAdmin.txt";
        if(file_exists($rutaAd)){
            $leerAd=fopen("archivoAdmin.txt","r");
            $flag=true;
            while(!feof($leerAd)){
                $claveId=fgets($leerAd);
                $clavePass=fgets($leerAd);
                $claveNom=fgets($leerAd);
                $claveFoto=fgets($leerAd);
                $clavePuesto=fgets($leerAd);
                $claveSal=fgets($leerAd);
                $claveSexo=fgets($leerAd);
                if($id == $claveId){
                    break;
                }
            }
            fclose($leerAd);
        }
    ?>

    <!-- interfaz del administrador -->
    <h1>Sistema Administrador</h1>
    <label>Rol de sesión iniciado: Administrador</label><br>
    <label>Nombre del usuario: <?php echo $nombre ?></label><br>
    <label>Id del usuario: <?php echo $id ?></label><br>
    <!-- llama al modal de modificar datos -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalUpdateAdmin" data-bs-whatever="@mdo" id="btnRegistrarmodal">Modificar datos</button>
    <!-- boton para mostrar los datos de los empleados -->
    <?php echo "<a href=mostrarEmpleados.php?idadmin=$id&nameadmin=$nombre>" ?> <button type="button" class="btn btn-warning">Mostrar Empleados</button></a>

    <?php echo "<a href=mostrarGrafica.php?idadmin=$id&nameadmin=$nombre>" ?> <button type="button" class="btn btn-warning">Mostrar Grafica</button></a>


    <!-- boton para regresar al inicio de sesion -->
    <a href="index.html"><button type="button" class="btn btn-danger">Volver</button></a>



    <!-- Modal para modificar datos admin -->
    <div class="modal fade" id="modalUpdateAdmin" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modificar datos: Administrador</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- se usa la funcion de modificarAdmin -->
                    <form action="modificarAdmin.php" method="post" id="registro-form">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">id:</label>
                            <input type="text" class="form-control" id="idregistro" name="updateId" value="<?php echo $claveId ?>">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Contraseña:</label>
                            <input type="password" class="form-control" id="passregistro" name="updatePassword" placeholder="Establece una contraseña" value="<?php echo $clavePass ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Nombre:</label>
                            <input type="text" class="form-control" id="registerName" name="updateNombre" placeholder="Nombre" value="<?php echo $claveNom ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Foto:</label>
                            <br><input type="text" class="form-control" id="fotoregistro" name="updateFoto"
                                placeholder="Ingresa la direccion URL de tu foto" value="<?php echo $claveFoto ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Rol:</label>
                            Administrador <input type="radio" id="administrador" name="administradorRadio" value="Administrador" checked>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Puesto:</label>
                            <input type="text" class="form-control" id="tipoempleadoregistro" name="updateEmpleado"
                                placeholder="Puesto" value="<?php echo $clavePuesto ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Salario:</label>
                            <input type="text" class="form-control" id="salarioregistro" name="updateSalario"
                                placeholder="Salario" value="<?php echo $claveSal ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Sexo:</label>
                            <br>
                            Hombre <input type="radio" id="hombreregistro" name="updateEmp"
                                value="Masculino" <?php if($claveSexo == "Masculino\n") echo "checked"; ?>>
                                
                            Mujer <input type="radio" id="mujerregistro" name="updateEmp" value="Femenino" <?php if($claveSexo == "Femenino\n") echo "checked"; ?>>
                        </div>
                        <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button class="btn btn-secondary" id="btnguardar">Guardar Cambios</button>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>


    <!-- Tabla con la informacion del empleado -->
    <table border='1'>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Fotografía</th>
            <th>Puesto</th>
            <th>Salario</th>
            <th>Sexo</th>
        </tr>
        <tr>
            <td><?php echo $claveId; ?></td>
            <td><?php echo $claveNom ?></td>
            <td><img src= "<?php echo $claveFoto; ?>" style="width: 100px; height: 100px;"></img></td> 
            <td><?php echo $clavePuesto; ?></td>
            <td><?php echo $claveSal; ?></td>
            <td><?php echo $claveSexo; ?></td>
        </tr>
    </table>

    <!-- libreria modal -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
    
</body>

</html>