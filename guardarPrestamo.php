<!DOCTYPE html>
<html>

<head>
    <!-- DOC PDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
</head>


<body>

<?php

$ide= $_REQUEST["idempleado"];
$nombre= $_REQUEST["nameempleado"];
// echo "$ide y $nombre";

$id = $_POST["idUser"];
$monto = $_POST["idMonto"];
$prestamo = $_POST["idQuincenas"];
$idsal = $_POST["idSal"];
$montoA= $monto;
$pago = 0;

if($monto <= $idsal*6){

$flagPrestamo = false;
$ruta =  "prestamoEmpleado.txt";

if(file_exists($ruta)){
    $leer=fopen("prestamoEmpleado.txt","r");
    $flag=true;
    while(!feof($leer)){
        $readId=fgets($leer);
        $readMonto=fgets($leer);
        $readPrestamo=fgets($leer);
        
        if($id==$readId){
            echo "ERROR.....ya existe un prestamo solicitado<br>";
            echo "<a href=interfazEmpleado.php?idempleado=$ide&nameempleado=$nombre><button type=button class=btn btn-warning>Volver</button></a>";
            $flag=false;
            $flagPrestamo = false;
            break;
        }
    }
    fclose($leer);

    if($flag==true){
        // Escribir en el archivo
        $fileSave = fopen("prestamoEmpleado.txt", "a+");
        // Capturamos en el archivo
        fputs($fileSave,$id."\n");
        fputs($fileSave,$monto."\n");
        fputs($fileSave,$prestamo."\n");
        fclose($fileSave);
        $flagPrestamo = true;
    }

}else{
        // Escribir en el archivo
        $fileSave = fopen("prestamoEmpleado.txt", "a+");
        // Capturamos en el archivo
        fputs($fileSave,$id."\n");
        fputs($fileSave,$monto."\n");
        fputs($fileSave,$prestamo."\n");
        fclose($fileSave);
        $flagPrestamo = true;
}


echo "<div id='tabla'>";
if($flagPrestamo == true){
    // Calculo tabla de amortizacion
    $i = 1;
    $pago = round(($montoA/$prestamo),3);

    print("<table border=1><tr><th>Número de cuota</th><th>Saldo Inicial</th><th>Pago realizado</th><th>Saldo Final</th></tr>");
        
        while($montoA != 0){

            if($i > $prestamo-1){
                print("<tr><td>".$i."</td><td>$".$montoA."</td><td>$".$pago."</td><td>0</td></tr>");
                break;
            }

            print("<tr><td>".$i."</td><td>$".$montoA."</td><td>$".$pago."</td><td>$".round(($montoA - $pago),3)."</td></tr>");
            $i++;
            $montoA = round(($montoA - $pago),3);
        }
    print("</table>");
    echo "</div>";


    // este boton regresa a la interfaz empleado, desde la interfaz empleado se mandaron las variables de ide y nombre, para que se pudiera
    // regresar son las que estan hasta arriba
    echo "<a href=interfazEmpleado.php?idempleado=$ide&nameempleado=$nombre><button type=button class=btn btn-warning>Volver</button></a>";

    echo "<button type='button' class='btn btn-info' id='btnSave' onclick='convertPDF()'>Guardar PDF</button>";
}

}else{
    header("location:interfazEmpleado.php?idempleado=$id&nameempleado=$nom&alert('No se puede otorgar el prestamo')");
}

?>



<script>
    function convertPDF(){
        html2canvas(document.querySelector("#tabla"),{
            allowTaint: true,
            useCORS: true,
            scale: 3,
            quality: 8.98
        }).then(canvas => {
            var img = canvas.toDataURL("image/PNG");
            var doc = new jsPDF();
            doc.text(80,15,"Tabla de Amortización")
            doc.text(10,25,"Reporte de Tabla de Amortización")
            doc.addImage(img,'PNG',10,30,450,100);
            doc.save("reporte.pdf");
        });
    }    
</script>

</body>

</html>