<!DOCTYPE html>
<html>
    <head>
        <title>Basic Column Chart using CanvasJS</title>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
	<script src="http://canvasjs.com/assets/script/canvasjs.min.js"></script>
    </head>
 
    <?php
        $dataPoints = array();
        $y = 40;
        for($i = 0; $i < 100000; $i++){
            $y += rand(0, 10) - 5; 
            array_push($dataPoints, array("x" => $i, "y" => $y));
        }
    ?>
 
    <body>
        <div id="chartContainer"></div>
 
        <script type="text/javascript">
 
            $(function () {
                var chart = new CanvasJS.Chart("chartContainer", {
                    theme: "theme2",
                    zoomEnabled: true,
                    animationEnabled: true,
                    title: {
                        text: "Performance Demo - 10000 DataPoints"
                    },
                    subtitles:[
                        {   text: "(Try Zooming & Panning)" }
                    ],
                    data: [
                    {
                        type: "column",                
                        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                    }
                    ]
                });
                chart.render();
            });
        </script>
    </body>
 