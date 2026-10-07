<?php

session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");

    exit;

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Dashboard | SUN SON SOLAR</title>

    <link rel="stylesheet" href="style.css">

</head>


<body class="dashboard-page">


<header class="user-navbar">

    <div class="user-logo">

        ☀ SUN SON SOLAR

    </div>


    <div>

        <span>
            Hello,
            <?php
            echo htmlspecialchars(
                $_SESSION["user_name"]
            );
            ?>
        </span>

        <a href="logout.php">
            Logout
        </a>

    </div>

</header>


<main class="user-dashboard">


    <div class="welcome-card">

        <span>
            WELCOME TO SUN SON SOLAR
        </span>

        <h1>
            Hello,
            <?php
            echo htmlspecialchars(
                $_SESSION["user_name"]
            );
            ?>!
        </h1>

        <p>
            You are successfully signed in to your
            SUN SON SOLAR account.
        </p>

    </div>


    <div class="account-card">

        <h2>
            My Account
        </h2>


        <div class="account-info">

            <p>
                <strong>Name:</strong>

                <?php
                echo htmlspecialchars(
                    $_SESSION["user_name"]
                );
                ?>
            </p>


            <p>
                <strong>Email:</strong>

                <?php
                echo htmlspecialchars(
                    $_SESSION["user_email"]
                );
                ?>
            </p>


            <p>
                <strong>Username:</strong>

                <?php
                echo htmlspecialchars(
                    $_SESSION["username"]
                );
                ?>
            </p>

        </div>

    </div>


    <div class="dashboard-actions">

        <a href="contact.php">
            Request a Solar Quote
        </a>

        <a href="products.php">
            View Products
        </a>

        <a href="services.php">
            View Services
        </a>

    </div>


</main>

</body>
</html>
