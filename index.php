<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../bootstrap.min.css">
</head>
<body>
    <div class="container-fluid">
<header class="bg-light p-3 text-center">
    <h1>PHP CRUD operation</h1>
</header>
<main>

<section class="table-responsive">
    <a href="newclient.php" class="text-light text-decoration-none btn btn-primary m-2">Add new client</a>
    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr class="b">
                <th>s.no</th>
                <th>NAME</th>
                <th>email</th>
                <th>mobile</th>
                <th>address</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
<?php
include("connect.php");

$sql = "SELECT * FROM users";
$res = mysqli_query($conn, $sql);

if (!$res) {
    die("Query Error: " . mysqli_error($conn));
}

while ($row = mysqli_fetch_assoc($res)) {
    echo '<tr>
            <td>' . $row["id"] . '</td>
            <td>' . $row["name"] . '</td>
            <td>' . $row["email"] . '</td>
            <td>' . $row["phone"] . '</td>
            <td>' . $row["address"] . '</td>
            <td>
            <a href="update.php?id='.$row["id"].'" class="text-dark text-decoration-none btn btn-warning">update</a>
            <a href="delete.php?id='.$row["id"].'" class="text-dark text-decoration-none btn btn-danger">delete</a>
            </td>
          </tr>';
}
?>        
        </tbody>
    </table>
</section>
</main>

    </div>
</body>
</html>