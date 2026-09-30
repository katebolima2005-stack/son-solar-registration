<?php

session_start();

require_once "config/database.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST["username"]);
    $password = $_POST["password"];


    $stmt = $conn->prepare(
        "SELECT id, full_name, email, username, password
         FROM users
         WHERE username = ?
         LIMIT 1"
    );

    $stmt->bind_param(
        "s",
        $username
    );

    $stmt->execute();

    $result = $stmt->get_result();


    if ($result->num_rows == 1) {

        $user = $result->fetch_assoc();


        // Check password
        if (
            password_verify(
                $password,
                $user["password"]
            )
        ) {

            // Save user information in session
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["user_name"] = $user["full_name"];
            $_SESSION["user_email"] = $user["email"];
            $_SESSION["username"] = $user["username"];


            // Go to dashboard
            header("Location: dashboard.php");

            exit;

        } else {

            $error = "Incorrect password.";

        }

    } else {

        $error = "Username not found.";

    }

    $stmt->close();

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Sign In | SUN SON SOLAR</title>

    <link rel="stylesheet" href="css/style.css">

</head>


<body class="auth-page">


<div class="auth-container">

    <div class="auth-box">


        <div class="auth-logo">

            <div class="auth-sun">
                ☀
            </div>

            <h1>
                SUN SON SOLAR
            </h1>

            <p>
                Sign in to your account
            </p>

        </div>


        <?php if ($error != ""): ?>

            <div class="error-message">

                <?php echo htmlspecialchars($error); ?>

            </div>

        <?php endif; ?>


        <form method="POST"
              action="login.php">


            <div class="form-group">

                <label>
                    Username
                </label>

                <input
                    type="text"
                    name="username"
                    placeholder="Enter your username"
                    required
                >

            </div>


            <div class="form-group">

                <label>
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    placeholder="Enter your password"
                    required
                >

            </div>


            <button
                type="submit"
                class="auth-button"
            >
                Sign In
            </button>

        </form>


        <p class="auth-link">

            Don't have an account?

            <a href="register.php">
                Register
            </a>

        </p>


        <a href="index.php"
           class="back-link">
            ← Back to Home
        </a>


    </div>

</div>


</body>
</html>