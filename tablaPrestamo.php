<!DOCTYPE html>
<html>

<head>
    <!-- DOC PDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
</head>


<body>
     
<?php

$id= $_REQUEST["idempleado"];
$name= $_REQUEST["nameempleado"];

echo "<div id='tabla'>";

echo "<h1>Tabla de amortizacion</h1>";
$leer = fopen("prestamoEmpleado.txt","r");

print("<table border=1><tr><th>Número de cuota</th><th>Saldo Inicial</th><th>Pago realizado</th><th>Saldo Final</th></tr>");

while(!feof($leer)){
    $idd=fgets($leer);
    $montoA=fgets($leer);
    $quincenaa=fgets($leer);
    if($id == $idd){
        $i = 1;
        $pago = round(($montoA/$quincenaa),3);
        
        while($montoA != 0){

            if($i > $quincenaa-1){
                print("<tr><td>".$i."</td><td>$".$montoA."</td><td>$".$pago."</td><td>0</td></tr>");
                break;
            }

            print("<tr><td>".$i."</td><td>$".$montoA."</td><td>$".$pago."</td><td>$".round(($montoA - $pago),3)."</td></tr>");
            $i++;
            $montoA = round(($montoA - $pago),3);
        }
        break;
    }else{
        print("<label>No solicitaste ningun prestamo</label>");
    }

}

print("</table>");

echo "</div>";

echo "<a href=interfazEmpleado.php?idempleado=$id&nameempleado=$name><button type=button class=btn btn-warning>Volver</button></a>";

?>

<!-- BOTON PDF -->
<button type="button" class="btn btn-info" id="btnSave" onclick="convertPDF()">Guardar PDF</button>

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