<?php include '../header.php'; ?>
<?php include '../sidebar.php'; ?>
<?php include '../content.php'; ?>
<h1>Multiseries Chart</h1>
<div id="chartContainer"></div>

<?php
function datapoints1(){
	$conn = new mysqli("localhost", "root", "", "canvasjs_db");
	$sql="SELECT hour,number from gp";
	$result = mysqli_query($conn,$sql);
	if ($result->num_rows > 0) {
	   while($row = $result->fetch_assoc()) {
			$x[]=$row['hour'];
			$y[]=$row['number'];
		} 
	}
	return array($x,$y);
}
$datapoints=datapoints1();
$x=$datapoints[0];
$y=$datapoints[1];
for($i=0;$i<=10;$i++){
	$dataPoints1[] = array("y" => $y[$i], "x" => $x[$i]);
} 
function datapoints2(){
	$conn = new mysqli("localhost", "root", "", "canvasjs_db");
	$sql="SELECT hour,number from bl";
	$result = mysqli_query($conn,$sql);
	if ($result->num_rows > 0) {
	   while($row = $result->fetch_assoc()) {
			$x[]=$row['hour'];
			$y[]=$row['number'];
		} 
	}
	return array($x,$y);
}
$datapoints=datapoints2();
$x=$datapoints[0];
$y=$datapoints[1];
for($i=0;$i<=10;$i++){
	$dataPoints2[] = array("y" => $y[$i], "x" => $x[$i]);
}    
?>

<script type="text/javascript">

    $(function () {
        var chart = new CanvasJS.Chart("chartContainer", {
            title: {
                text: "Hourly Visitors."
            },
            subtitles: [
                {
                    text: ""
                }
            ],
            animationEnabled: true,
            axisY: {
                titleFontFamily: "arial",
                titleFontSize: 12,
                includeZero: false
            },
            toolTip: {
                shared: true
            },
            data: [
            {
                type: "spline",
                name: "GP",
                showInLegend: true,
                dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
            },
			{
                type: "spline",
                name: "BL",
                showInLegend: true,
                dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
            }
            
            ],
            legend: {
                cursor: "pointer",
                itemclick: function (e) {
                    if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                        e.dataSeries.visible = false;
                    }
                    else {
                        e.dataSeries.visible = true;
                    }
                    chart.render();
                }
            }
        });

        chart.render();
    });
</script>

<?php include '../footer.php'; ?>