<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Database User Interface</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!--    <link rel="stylesheet" type="text/css" href="css/bootstrap-rtl.css">-->
    <link rel="stylesheet" type="text/css" href="css/app.css">

    <script src="js/html5shiv.min.js"></script>
    <script src="js/respond.min.js"></script>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
    <script src="js/jquery-1.11.3.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

    <!--my own styles-->
    <style type="text/css">

    </style>
</head>

<body>
<?php
include("connection.php");
$connection = new Connection("localhost", "root", "");
$link = $connection->con;
$dbs = mysqli_query($link, "show databases");

$has_db = false;
$has_table = false;
if(isset($_GET['dbname'])){
    $dbname = $_GET['dbname'];
    $has_db = true;
    $link->select_db($dbname);
    if(isset($_GET['table_name'])){
        $table_name = $_GET['table_name'];
        $has_table=true;
    } else{
        $table_name = "null";
    }
} else{
    $dbname = "null";
    $table_name="null";
}
?>

<div class="wrapper container">
    <div class="row">
        <div class="col-md-4">
            <div class="container-fluid">
                <div class="panel panel-default">
                    <div class="panel-heading">Databases</div>
                    <div class="panel-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Databases</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $dbs_num = mysqli_num_rows($dbs);
                            if($dbs_num == 0){
                                echo'<tr><td>'."no database to show".'</td></tr>';
                            }
                            while( $database = mysqli_fetch_row( $dbs ) ){
                                $db_url = "index.php?dbname=".$database[0];
                                echo '<tr><td>
                                <a href='.$db_url.'>'.$database[0].'</a>'.
                                    '</td></tr>';
                            }
                            ?>
                            </tbody>
                        </table>

                        <h3>Create new database</h3>
                        <form role="form" action="create_db.php" method="post">
                            <div class="form-group">
                                <label for="name">Database Name:</label>
                                <input type="text" class="form-control" name="dbname">
                            </div>
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-btn fa-plus"></i> Create
                            </button>
                        </form>

                        <h3>delete database</h3>
                        <form role="form" action="drop_db.php" method="post">
                            <div class="form-group">
                                <label for="name">Database Name:</label>
                                <input type="text" class="form-control" name="dbname">
                            </div>
                            <button type="submit" class="btn btn-danger">
                                <i class="fa fa-btn fa-trash"></i> delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="container-fluid">
                <div class="panel panel-default">
                    <div class="panel-heading">User Interface</div>
                    <div class="panel-body">
                        <nav class="navbar navbar-inverse" role="navigation">
                            <div class="navbar-header">
                                <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#me">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <a class="navbar-brand" href="index.php">Database User Interface</a>
                            </div>
                            <div class="collapse navbar-collapse" id="me">
                                <ul class="nav navbar-nav">
                                    <li><a href="index.php">home</a></li>
                                    <?php
                                    if($has_db){
                                        if($has_table)
                                            $query_url = "query.php?dbname=".$dbname."&table_name=".$table_name;
                                        else
                                            $query_url = "query.php?dbname=".$dbname;
                                    }else{
                                        $query_url = "query.php";
                                    }

                                    ?>
                                    <li><a href=<?php echo $query_url; ?>>run query</a></li>
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                            Record
                                            <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a href="#">insert</a></li>
                                            <li><a href="#">delete</a></li>
                                            <li><a href="#">update</a></li>
                                            <li><a href="#">select</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                            Create
                                            <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a href="#">tables</a></li>
                                            <li><a href="#">Stored procedure</a></li>
                                            <li><a href="#">function</a></li>
                                            <li><a href="#">triggers</a></li>
                                            <li><a href="#">transaction</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </nav>

                    <!-- content here -->