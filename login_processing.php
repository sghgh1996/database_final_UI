<?php
session_start();
$username = $_POST['userTxt'];
$password = $_POST['userTxt'];

include("connection.php");
$connection = new Connection("localhost", "root", "");
$link = $connection->con;
$query = mysqli_query($link,"SELECT * from mysql.user
WHERE user = '$username' and Host = 'localhost'");
$exists = mysqli_num_rows($query);
$connection->closeConnection();

$table_users = "";

if($exists > 0) {
    while($row = mysqli_fetch_row($query)) {
        $table_users = $row[1];
    }

    if($username == $table_users) {
        $_SESSION['user'] = $username;
        $_SESSION['password'] = $password;

        header("location:index.php");
    } else {
        print '<script>alert("Incorrect Password!");</script>';
        print '<script>window.location.assign("login_page.php");</script>';
    }
} else {
    Print '<script>alert("Incorrect Username!");</script>';
    Print '<script>window.location.assign("login_page.php");</script>';
}
