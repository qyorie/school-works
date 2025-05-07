<?php
session_start();
include ("dbconnection.php");

if (isset($_POST["login"])) {
    $username = $_POST['user'];
    $password = $_POST['pass'];

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT admin_user, admin_pass FROM admin WHERE admin_user = ? AND admin_pass = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        // Login success
        $_SESSION["Username"] = $row['admin_user'];
        $_SESSION["Password"] = $row['admin_pass'];

        header("Location: order-list.php");
        exit();
    } else {
        // Login failed
        echo "<script>alert('Invalid username or password'); window.location.href='login_page.php';</script>";
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WashMax Laundry Login</title>
    <link rel="icon" type="image/x-icon" href="logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
        }

        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background: url('https://tse4.mm.bing.net/th?id=OIP.LZ-R-iSa3xrfM9S9iCrKDAHaEK&pid=Api&P=0&h=220') no-repeat center center fixed;
            background-size: cover;
            filter: blur(8px);
            z-index: -1;
        }

        .box-area {
            background-color: rgba(255, 255, 255, 0.85);
            border-radius: 1rem;
            backdrop-filter: blur(10px);
        }
    </style>
</head>
<body>

    <!----------------------- Main Container -------------------------->
    <div class="container d-flex justify-content-center align-items-center min-vh-100">

        <!----------------------- Login Container -------------------------->
        <div class="row border rounded-5 p-3 shadow box-area">

            <!--------------------------- Left Box ----------------------------->  
            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #c62828;">
                <div class="featured-image mb-3">
                    <img src="—Pngtree—vector laundry material_6065499.png" class="img-fluid" style="width: 200px;">
                </div>
                <p class="text-white fs-2 fw-bold" style="font-family: 'Courier New', Courier, monospace;">Welcome to WashMax</p>
                <small class="text-white text-wrap text-center" style="width: 17rem; font-family: 'Courier New', Courier, monospace;">Your trusted laundry tracking service.</small>
            </div> 

            <!----------------------- Right Box ---------------------------->
            <div class="col-md-6 right-box">
                <div class="row align-items-center">
                    <div class="header-text mb-4">
                        <h2>Login to WashMax</h2>
                        <p>Track and manage your laundry orders easily.</p>
                    </div>
                    <form id="loginForm" action="#" method="POST" onsubmit="return validateForm()">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control form-control-lg bg-light fs-6" id="username"  name="user" placeholder="Username" required>
                        </div>
                        <div class="input-group mb-1">
                            <input type="password" class="form-control form-control-lg bg-light fs-6" id="password" name="pass" placeholder="Password" required>
                        </div>
                        <div class="input-group mb-3">
                            <button type="submit" class="btn btn-lg btn-danger w-100 fs-6" name="login">Login</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>  
    </div>

</body>
</html>