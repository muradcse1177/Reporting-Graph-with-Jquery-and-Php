<?php include '../header.php'; ?>
<?php include '../sidebar.php'; ?>
<?php include '../content.php'; ?>
<h1>Zooming &amp; Panning</h1>
<div id="chartContainer"></div>

<?php 

// $conn = new mysqli("localhost", "root", "", "canvasjs_db");
// for($i=0;$i<100;$i++){
	// $y=$dataPoints[$i]["y"];
	// $x=$dataPoints[$i]["x"];				
	// $sql="Insert into datapoints(x,y) values('$x','$y')";
	// $conn->query($sql);
// }

function datapoints(){
	$conn = new mysqli("localhost", "root", "", "canvasjs_db");
	$sql="select * from datapoints order by id desc limit 90";
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
for($i=0;$i<90;$i++){
	$dataPoints[] = array("y" => $y[$i], "x" => $x[$i]);
}			
?>


<script type="text/javascript">

$(function () {
    var chart = new CanvasJS.Chart("chartContainer", {
        theme: "theme2",
        zoomEnabled: true,
        animationEnabled: true,
        title: {
            text: "Try Zooming & Panning"
        },
        subtitles:[
            {
            text: "Line Chart with 100 Data Points"
            }
        ],
        data: [
        {
            type: "line",

            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
        }
        ]
    });
    chart.render();
});
</script>

<?php include '../footer.php'; ?>