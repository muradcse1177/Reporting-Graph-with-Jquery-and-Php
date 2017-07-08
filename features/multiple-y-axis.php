<?php include '../header.php'; ?>
<?php include '../sidebar.php'; ?>
<?php include '../content.php'; ?>
<div id="chartContainer"></div>

<?php
    function datapoints1(){
		$conn = new mysqli("localhost", "root", "", "report");
		$sql="SELECT substr(date,-5) as date,chl from gpcamp where partner='KM'";
		$result = mysqli_query($conn,$sql);
		if ($result->num_rows > 0) {
		   while($row = $result->fetch_assoc()) {
				$x[]=$row['date'];
				$y[]=$row['chl'];
			} 
		}
		return array($x,$y);
	}
	$datapoints=datapoints1();
	$x=$datapoints[0];
	$y=$datapoints[1];
	for($i=0;$i<=2;$i++){
		$dataPoints1[] = array("label" => $x[$i], "y" => $y[$i]);
	}
	
	function datapoints2(){
		$conn = new mysqli("localhost", "root", "", "report");
		$sql="SELECT substr(date,-5) as date,camp from gpcamp where partner='KM'";
		$result = mysqli_query($conn,$sql);
		if ($result->num_rows > 0) {
		   while($row = $result->fetch_assoc()) {
				$x[]=$row['date'];
				$y[]=$row['camp'];
			} 
		}
		return array($x,$y);
	}
	$datapoints=datapoints2();
	$x=$datapoints[0];
	$y=$datapoints[1];
	for($i=0;$i<=2;$i++){
		$dataPoints2[] = array("label" => $x[$i], "y" => $y[$i]);
	}
?>
	

<script type="text/javascript">

    $(function () {
        var chart = new CanvasJS.Chart("chartContainer", {
            title: {
                text: "Campaign  Report of Indivisual Partner."
            },
            animationEnabled: true,
			zoomEnabled: true,
            toolTip: {
                shared: true,
                content: function (e) {
                    var body;
                    var head;
                    head = "<span style = 'color:DodgerBlue; '><strong>" + (e.entries[0].dataPoint.x) + " </strong></span><br/>";

                    body = "<span style= 'color:" + e.entries[0].dataSeries.color + "'> " + e.entries[0].dataSeries.name + "</span>: <strong>" + e.entries[0].dataPoint.y + "</strong>  <br/> <span style= 'color:" + e.entries[1].dataSeries.color + "'> " + e.entries[1].dataSeries.name + "</span>: <strong>" + e.entries[1].dataPoint.y + "</strong>  ";

                    return (head.concat(body));
                }
            },
            axisY: {
                title: "CHL",
                includeZero: false,
                lineColor: "#369EAD"
            },
            axisY2: {
                title: "Campaign",
                includeZero: false,
                lineColor: "#C24642"
            },
            axisX: {
                title: "Date",
            },
            data: [
            {
                type: "spline",
                name: "CHL",
				showInLegend: true,
                dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
            },
            {
                type: "spline",
                axisYType: "secondary",
                name: "Campaign",
				showInLegend: true,
                dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
            }
            ]
        });

        chart.render();
    });
</script>

<?php include '../footer.php'; ?>