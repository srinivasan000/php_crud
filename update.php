<?php
include("connect.php");
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "SELECT * FROM users WHERE id=$id";
    $res = mysqli_query($conn, $sql);
    if (!$res) {
        die("query Field :" . mysqli_error($conn));
    }
    $row = mysqli_fetch_assoc($res);
    $id = $row["id"];
    $name = $row["name"];
    $email = $row["email"];
    $phone = $row["phone"];
    $address = $row["address"];
}
$errors = [];

if (isset($_POST["submit"])) {
    // Validate inputs
    $id = $_POST["id"];
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone"]);
    $address = trim($_POST["address"]);

    if (empty($name)) {
        $errors["name"] = "Name is required";
    }

    if (empty($email)) {
        $errors["email"] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Invalid email format";
    }

    if (empty($phone)) {
        $errors["phone"] = "Phone number is required";
    } elseif (!preg_match("/^[0-9]{10}$/", $phone)) {
        $errors["phone"] = "Phone number must contain exactly 10 digits";
    }

    if (empty($address)) {
        $errors["address"] = "Address is required";
    }

    if (empty($errors)) {
        $sql = "UPDATE `users` SET name='$name',email='$email',phone='$phone',address='$address' WHERE id='$id'";
        $res = mysqli_query($conn, $sql);
        if (!$res) {
            die("query Field update :" . mysqli_error($conn));
        }
        header("location:index.php");
    }
}

?>

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

            <section class="container">
                <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
                    <!-- name -->
                    <div class="form-group m-2">
                        <label for="name">NAME</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Your Name" required value='<?= isset($_POST["name"]) ? $_POST["name"] : "$name" ?>'>
                        <span class="text-danger"><?= isset($errors["name"]) ? $errors["name"] : "" ?></span>
                    </div>
                    <!-- email -->
                    <div class="form-group m-2">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email" required value='<?= isset($_POST["email"]) ? $_POST["email"] : "$email" ?>'>
                        <span class="text-danger"><?= isset($errors["email"]) ? $errors["email"] : "" ?></span>
                    </div>
                    <!-- phone -->
                    <div class="form-group m-2">
                        <label for="phone">Mobile</label>
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter Your Mobile Number" required value='<?= isset($_POST["phone"]) ? $_POST["phone"] : "$phone" ?>'>
                        <span class="text-danger"><?= isset($errors["phone"]) ? $errors["phone"] : "" ?></span>
                    </div>
                    <!-- address -->
                    <div class="form-group m-2">
                        <label for="address">Address</label>
                        <textarea class="form-control" id="address" rows="3" name="address" placeholder="Enter Your Address" required><?= isset($_POST["address"]) ? $_POST["address"] : "$address" ?></textarea>
                        <span class="text-danger"><?= isset($errors["address"]) ? $errors["address"] : "" ?></span>
                    </div>
                    <input type="number" style="display: none;" name="id" value='<?= isset($_POST["id"]) ? $_POST["id"] : "$id" ?>' />
                    <!-- submit btn -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-success" name="submit">update details</button>
                    </div>
                </form>
            </section>
        </main>

    </div>
</body>

</html>