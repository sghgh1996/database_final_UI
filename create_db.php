<?php
/**
 * Created by PhpStorm.
 * User: Sadjad
 * Date: 6/13/2016
 * Time: 10:33 PM
 */
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $dbname = $_POST['dbname'];
    include("connection.php");
    $connection = new Connection("localhost", "root", "");
    $link = $connection->con;
    mysqli_query($link, "create database $dbname");
    Print '<script>window.location.assign("index.php");</script>';
}
