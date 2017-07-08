<?php include '../header.php'; ?>
<?php include '../sidebar.php'; ?>
<?php include '../content.php'; ?>
<h1>Column Chart</h1>
<div id="chartContainer"></div>
<?php
function datapoints(){
	$conn = new mysqli("localhost", "root", "", "canvasjs_db");
	$sql="select * from datapoints limit 11";
	$result = mysqli_query($conn,$sql);
	if ($result->num_rows > 0) {
	   while($row = $result->fetch_assoc()) {
			$x[]=$row['x'];
			$y[]=$row['y'];
		} 
	}
	return array($x,$y);
}
$datapoints=datapoints();
$x=$datapoints[0];
$y=$datapoints[1];
for($i=0;$i<=10;$i++){
	$dataPoints[] = array("y" => $y[$i], "x" => $x[$i]);
}
?>

<script type="text/javascript">

    $(function () {
        var chart = new CanvasJS.Chart("chartContainer", {
            theme: "theme2",
            animationEnabled: true,
            title: {
                text: "Daily Stroke Report."
            },
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

<?php include '../footer.php'; ?>