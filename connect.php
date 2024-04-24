<?php
$conn = mysqli_connect("localhost", "root", "", "crud");
if (!$conn) {
    die("db not connected : ".mysqli_connect_error());
    exit();
}
