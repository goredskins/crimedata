<?php
// Check if session is not registered, redirect back to main page. 
// Put this code in first line of web page. 
session_start();
if(!isset($_SESSION['username'])) {
    header("location:login.php");
}
else {
    $username = $_SESSION['username'];
}
?>
<!DOCTYPE html>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Baltimore Crime Data Dashboard</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
		#map-canvas {
		  width: 100%;
		  height: 400px;
		  margin-bottom: 15px;
		  border: 2px solid #fff;
		}
    </style>
</head>
<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">NYC Crime Data</a>
            </div>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="charts.php"><i class="fa fa-fw fa-bar-chart-o"></i> Charts</a>
                    </li>
                    <li>
                        <a href="tables.php"><i class="fa fa-fw fa-table"></i> Tables</a>
                    </li>
                    <li>
                        <a href="hoods.php"><i class="fa fa-fw fa-table"></i>Neighborhoods</a>
                    </li>
                    <li>
                        <a href="reportcrime.php"><i class="fa fa-fw fa-table"></i>Report Crime</a>
                    </li>
                    <li>
                        <a href="map.php"><i class="fa fa-fw fa-table"></i>Map of Crimes by Date</a>
                    </li>
                    <li class="active">
                        <a href="heatmap.php"><i class="fa fa-fw fa-table"></i>Heat Map</a>
                    </li>
                    <li>
                        <a href="logout.php"><i class="fa fa-fw fa-table"></i>Logout</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Heat Map
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Heat Map </h3>
                            </div>
                            <div class="panel-body">
                                 <div id="map-canvas"></div>
                                 <div id="latlong"></div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBaI6XGo6lIsbV2FdQECz68XPjlOTUBA3I&libraries=visualization&amp;sensor=true"> </script>
    <script type="text/javascript">
    var markers = [];
		function initialize() {
	        var mapOptions = {
	            center: new google.maps.LatLng(39.2959200000, -76.579310000),
	            zoom: 11,
	            scrollwheel: false,
	            draggable: true,
	            panControl: true,
	            zoomControl: true,
	            mapTypeControl: true,
	            scaleControl: true,
	            streetViewControl: true,
	            overviewMapControl: true,
	            rotateControl: true,
	        };
			var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);		  
			makeHeatMap(map);
		}
		function makeHeatMap(map) {
			//ajax call

			//on success
			$.ajax({
                type : 'post',
                url : 'coordinates.php',  
                data :  {limit: 200000},
                success : function(r) {
                    //$("#latlong").html(r);
                    var obj = JSON.parse(r);
                    console.debug(obj);
                    var dataPoints = [];
                    for(var key in obj) {
                    	//console.debug(key);
                    	//console.debug(obj[key]);
                    	//parseFloat(obj[key]['latitude']);
						dataPoints.push(new google.maps.LatLng(parseFloat(obj[key]['latitude']), parseFloat(obj[key]['longitude'])));
                    }
                    console.debug(dataPoints);
                	var heatmap = new google.maps.visualization.HeatmapLayer({
					    data: dataPoints,
					    map: map
					  });
                	heatmap.set('opacity', 0.6);
				}
            });
        }
		google.maps.event.addDomListener(window, 'load', initialize);
		// Sets the map on all markers in the array.
		function setMapOnAll(map) {
		  for (var i = 0; i < markers.length; i++) {
		    markers[i].setMap(map);
		  }
		}

		// Removes the markers from the map, but keeps them in the array.
		function clearMarkers() {
		  setMapOnAll(null);
		}

		// Shows any markers currently in the array.
		function showMarkers() {
		  setMapOnAll(map);
		}

		// Deletes all markers in the array by removing references to them.
		function deleteMarkers() {
		  clearMarkers();
		  markers = [];
		}
    </script>
</body>

</html>
