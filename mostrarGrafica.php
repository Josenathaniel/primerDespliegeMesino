<?php

$idadmin= $_REQUEST["idadmin"];
$nombre= $_REQUEST["nameadmin"];


$dataPoints = array();

$leer = fopen("prestamoEmpleado.txt", "r");

$rangouno = 0;
$rangodos = 0;
$rangotres = 0;
$rangocuatro = 0;
$rangocinco = 0;
$rangoseis = 0;
$rangosiete = 0;
$rangoocho = 0;
$rangonueve = 0;
$rangodiez = 0;
$rangoonce = 0;



while(!feof($leer)){
    $id = fgets($leer);
    $monto = fgets($leer);
    $quincenas = fgets($leer);

    if($monto>=1000 && $monto<=2000){
        $rangouno++;

    }else if($monto>=2001 && $monto<=3000){
        $rangodos++;

    }else if($monto>=3001 && $monto<=4000){
        $rangotres++;

    }else if($monto>=4001 && $monto<=5000){
        $rangocuatro++;

    }else if($monto>=5001 && $monto<=6000){
        $rangocinco++;

    }else if($monto>=6001 && $monto<=7000){
        $rangoseis++;

    }else if($monto>=7001 && $monto<=8000){
        $rangosiete++;

    }else if($monto>=8001 && $monto<=9000){
        $rangoocho++;

    }else if($monto>=9001 && $monto<=10000){
        $rangonueve++;

    }else if($monto>=10001 && $monto<=11000){
        $rangodiez++;

    }else if($monto>=11001){
        $rangoonce++;

    }

    // $flag = false;
    // $i = -1;
    // foreach ($arrayPres as $value) {
    //     if($monto == $value){
    //         $flag = true;
    //         $i++;
    //         break;
    //     }
    // }
    // if($flag == true){
    //     array_push($arrayPres,$monto);
    //     $flag = false;
    // }
}
fclose($leer);


// Valida los contadores que estan vacios y los que no, para imprimir
if($rangouno!=0){
    array_push($dataPoints,array("y" => $rangouno, "label" => "$1000 - $2000"));
}
if($rangodos!=0){
    array_push($dataPoints,array("y" => $rangodos, "label" => "$2001 - $3000" ));
}
if($rangotres!=0){
    array_push($dataPoints,array("y" => $rangotres, "label" => "$3001 - $4000"));
}
if($rangocuatro!=0){
    array_push($dataPoints,array("y" => $rangocuatro, "label" => "$4001 - $5000" ));
}
if($rangocinco!=0){
    array_push($dataPoints,array("y" => $rangocinco, "label" => "$5001 - $6000" ));
}
if($rangoseis!=0){
    array_push($dataPoints,array("y" => $rangoseis, "label" => "$6001 - $7000" ));
}
if($rangosiete!=0){
    array_push($dataPoints,array("y" => $rangosiete, "label" => "$7001 - $8000" ));
}
if($rangoocho!=0){
    array_push($dataPoints,array("y" => $rangoocho, "label" => "$8001 - $9000" ));
}
if($rangonueve!=0){
    array_push($dataPoints,array("y" => $rangonueve, "label" => "$9001 - $10000"));
}
if($rangodiez!=0){
    array_push($dataPoints,array("y" => $rangodiez, "label" => "$10001 - $11000"));
}
if($rangoonce!=0){
    array_push($dataPoints,array("y" => $rangoonce, "label" => "$11001  o más"));
}
// print_r($arrayPres);



// $dataPoints = array(
// 	array("y" => $rangouno, "label" => "$1000 - $2000" ),
// 	array("y" => $rangodos, "label" => "$2001 - $3000" ),
// 	array("y" => $rangotres, "label" => "$3001 - $4000" ),
// 	array("y" => $rangocuatro, "label" => "$4001 - $5000" ),
// 	array("y" => $rangocinco, "label" => "$5001 - $6000" ),
// 	array("y" => $rangoseis, "label" => "$6001 - $7000" ),
// 	array("y" => $rangosiete, "label" => "$7001 - $8000" ),
// 	array("y" => $rangoocho, "label" => "$8001 - $9000" ),
// 	array("y" => $rangonueve, "label" => "$9001 - $10000" ),
// 	array("y" => $rangodiez, "label" => "$10001 - $11000" ),
// 	array("y" => $rangoonce, "label" => "$11001  o más" ),
// );
 
// array_push($dataPoints,array("y" => $rangoonce, "label" => "$11001  o más" ));

?>
<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Inicio</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="sb-admin-2.min.css" rel="stylesheet">


    
</head>

<body id="page-top">
    <div class="cloumn">
    <div id="content-wrapper" class="d-flex flex-column">
            <script>
                window.onload = function() {
                
                var chart = new CanvasJS.Chart("chartContainer", {
                    animationEnabled: true,
                    theme: "lithg1",
                    title:{
                        text: "Gráfica de prestamos"
                    },
                    axisY: {
                        title: "Pretamos otorgados"
                    },
                    axisX: {
                        title: "Rango de monto"
                    },
                    data: [{
                        type: "column",
                        yValueFormatString: "#,##0.## prestamos otorgados",
                        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                    }]
                });
                chart.render();
                }
            </script>
        </div>
    </div>

        <!-- End of Content Wrapper -->
    <!-- Canvas -->
    <div id="chartContainer" style="height: 470px; width: 100%;"></div>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <br>

    <!-- Volver al admin -->
    <?php echo "<a href=interfazAdministrador.php?idadmin=$idadmin&nameadmin=$nombre><button type=button class=btn btn-warning>Volver</button></a>"; ?>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>