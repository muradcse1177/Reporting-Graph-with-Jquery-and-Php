<?php include '../header.php'; ?>
<?php include '../sidebar.php'; ?>
<?php include '../content.php'; ?>
<div id="chartContainer"></div>

<?php
	date_default_timezone_set('Asia/Dhaka');
	function datapoints1(){
	$conn = new mysqli("localhost", "root", "", "report");
	$sql="SELECT substr(date,-5) as date,subscribed from gpsub2";
	$result = mysqli_query($conn,$sql);
	if ($result->num_rows > 0) {
	   while($row = $result->fetch_assoc()) {
			$x[]=$row['date'];
			$y[]=$row['subscribed'];
		} 
	}
	return array($x,$y);
	}
	$datapoints=datapoints1();
	$x=$datapoints[0];
	$y=$datapoints[1];
	for($i=0;$i<=3;$i++){
		$dataPoints[] = array("y" => $y[$i], "label" => $x[$i]);
	}
	
	
	function datapoints2(){
	$conn = new mysqli("localhost", "root", "", "report");
	$sql="SELECT substr(date,-5) as date,subscribed from blsub";
	$result = mysqli_query($conn,$sql);
	if ($result->num_rows > 0) {
	   while($row = $result->fetch_assoc()) {
			$x[]=$row['date'];
			$y[]=$row['subscribed'];
		} 
	}
	return array($x,$y);
	}
	$datapoints=datapoints2();
	$x=$datapoints[0];
	$y=$datapoints[1];
	for($i=0;$i<=10;$i++){
		$dataPoints1[] = array("y" => $y[$i], "label" => $x[$i]);
	}

?>

<script type="text/javascript">

    $(function () {
        var chart = new CanvasJS.Chart("chartContainer", {
            theme: "theme2",
            animationEnabled: true,
            title: {
                text: "Analysis of Grameenphone."
            },
			animationEnabled: true,
			zoomEnabled: true,
            axisX: {
                title: "Date:<?php echo Date('Y-m')?>"
            },
            axisY: {
                title: "Subscription."
            },

            data: [
            {
                type: "spline",
				name: "Subscription GP",
				showInLegend: true,
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            },
			{
                type: "spline",
				name: "Subscription BL",
				showInLegend: true,
                dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
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

