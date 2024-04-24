<?php
include("connect.php");
if(isset($_GET["id"])){
    $id=$_GET["id"];
    
    $sql="DELETE FROM users where id='$id'";
    $res=mysqli_query($conn,$sql);
    if(!$res){
    die("Query Error: " . mysqli_error($conn));
    }
    header("location:index.php");
}
?>