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

    <title>Baltimore Crime Data</title>

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
                <a class="navbar-brand" href="index.php">Baltimore Crime Data</a>
            </div>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
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
                    <li>
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
                            Dashboard <small>Statistics Overview</small>
                        </h1>
                        <ul class="nav nav-pills">
                          <li role="presentation" id="crimes_link"><a href="#">Recent Crimes</a></li>
                          <li role="presentation" id="homeless_link"><a href="#">Homeless Shelters</a></li>
                          <li role="presentation" id="courthouse_link"><a href="#">Courthouses</a></li>
                        <li role="presentation" id="hospital_link"><a href="#">Hospitals</a></li>
                        </ul>
                    </div>
                </div>
                <!-- /.row -->

                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row">
                                    <div id = "table_content"> </div>
                                </div>
                            </div>
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
    <script>
        function loadCrimes() {
            $.ajax({
                type : 'post',
                url : 'loadTable.php',  
                data :  {
                    'table_name': 'crimes',
                },
                success : function(r) {
                    $("#table_content").html(r);
                }
            });
        }
        function loadHomelessShelters() {
            $.ajax({
                type : 'post',
                url : 'loadTable.php',  
                data :  {
                    'table_name': 'homeless_shelters',
                },
                success : function(r) {
                    $("#table_content").html(r);
                }
            });
        }
        function loadHospitals() {
            $.ajax({
                type : 'post',
                url : 'loadTable.php',  
                data :  {
                    'table_name': 'hospitals',
                },
                success : function(r) {
                    $("#table_content").html(r);
                }
            });
        }
        function loadCourthouses() {
            $.ajax({
                type : 'post',
                url : 'loadTable.php',  
                data :  {
                    'table_name': 'courthouses',
                },
                success : function(r) {
                    $("#table_content").html(r);
                }
            });
        }
        $(function(){
            loadCrimes();
            $('#crimes_link').click( function() { 
                loadCrimes();
            });
            $('#homeless_link').click( function() { 
                loadHomelessShelters();
            });
            $('#hospital_link').click( function() { 
                loadHospitals();
            });
            $('#courthouse_link').click( function() { 
                loadCourthouses();
            });
        });
    </script>
    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
</body>

</html>
