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

    <title>Report Crime</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

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
                <a class="navbar-brand" href="index.php">Baltimore Crime Data</a>
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
                    <li class="active">
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
                            Report a Crime
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Report Crime</h3>
                            </div>
                            <div class="panel-body">
                                 <div id="form-content">
                                    <form action = "addcrime.php" method = "post"><br>
                                    Date: <input type = "text" name = "date" value = "2015-12-08"/><br>
                                    Crime Code: <input type = "text" name="crime_code" value = "3AK"/><br>
                                    Location: <input type = "text" name="location" value = "100 W FAYETTE ST"/><br>
                                    Weapon: <input type = "text" name = "weapon" value = "KNIFE"/><br>
                                    Post: <input type = "text" name = "post" value = "112"/><br>
                                    Neighborhood: <input type = "text" name = "neighborhood" value = "Downtown"/><br>
                                    District: <input type = "text" name = "district" value = "CENTRAL"/><br>
                                    Lat: <input type = "text" name ="latitude" value = "39.2903600000"/><br>
                                    Long: <input type = "text" name ="longitude" value = "-76.6169500000"/><br>
                                    Race: <input type = "text" name ="race" value = "U"/><br>
                                    <input type="submit"/>
                                    </form>
                                 </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

    <script type="text/javascript">

    </script>
</body>

</html>
