<?php  
$link = mysqli_connect("localhost", "root", "", "testecadastro");
 
if (!$link) {
    echo "Error: Falha ao conectar-se com o banco de dados MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
} else{  
    echo "Sucesso: Sucesso ao conectar-se com a base de dados MySQL." . PHP_EOL;
}
$sql = "SELECT peso FROM pessoas where sexo like 'F'";

$result = $link->query($sql);

$t = 0;

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        
        $pesoM[$t] = $row['peso'];
         $t++;
    }
} else {
    echo "0 results";
}
   
$sql = "SELECT peso FROM pessoas where sexo like 'M'";

$result = $link->query($sql);
$s = 0;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $pesoH[$s] = $row['peso'];
        $s++;
    }
} else {
    echo "0 results";
}
$link->close();
?>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    
    <div id="container"></div>

    <script>Highcharts.chart('container', {

        title: {
            text: 'Divisão de pesos por sexo'
        },
    
        subtitle: {
            text: ''
        },
    
        yAxis: {
            title: {
                text: ''
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
    
        plotOptions: {
            series: {
                label: {
                    connectorAllowed: false
                },
                pointStart: 2010
            }
        },
    
        series: [{
            name: 'Mulheres',
            data: [<?php 
        
                echo($pesoM[0]);
               
            ?>, <?php 
        
                echo($pesoM[1]);
               
            ?>]
        }, {
            name: 'Homens',
            data: [<?php 
        
                echo($pesoH[0]);
               
            ?>, <?php 
        
                echo($pesoH[1]);
               
            ?>]
        }],
    
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 300
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
    
    });</script>
