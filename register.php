<?php

require_once "config/database.php";

$message = "";
$message_type = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $full_name = trim($_POST["full_name"]);
    $email = trim($_POST["email"]);
    $username = trim($_POST["username"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];


    // Check if passwords match
    if ($password !== $confirm_password) {

        $message = "Passwords do not match.";
        $message_type = "error";

    } else {

        // Check if username or email already exists
        $check = $conn->prepare(
            "SELECT id FROM users WHERE email = ? OR username = ?"
        );

        $check->bind_param(
            "ss",
            $email,
            $username
        );

        $check->execute();

        $result = $check->get_result();


        if ($result->num_rows > 0) {

            $message = "Email or username is already registered.";
            $message_type = "error";

        } else {

            // Encrypt password
            $hashed_password = password_hash(
                $password,
                PASSWORD_DEFAULT
            );


            // Insert user
            $stmt = $conn->prepare(
                "INSERT INTO users
                (full_name, email, username, password)
                VALUES (?, ?, ?, ?)"
            );

            $stmt->bind_param(
                "ssss",
                $full_name,
                $email,
                $username,
                $hashed_password
            );


            if ($stmt->execute()) {

                $message = "Registration successful! You can now sign in.";
                $message_type = "success";

            } else {

                $message = "Registration failed.";
                $message_type = "error";

            }

            $stmt->close();

        }

        $check->close();

    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Register | SUN SON SOLAR</title>

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
                Create your account
            </p>

        </div>


        <?php if ($message != ""): ?>

            <div class="<?php echo $message_type; ?>-message">

                <?php echo htmlspecialchars($message); ?>

            </div>

        <?php endif; ?>


        <form method="POST"
              action="register.php">


            <div class="form-group">

                <label>
                    Full Name
                </label>

                <input
                    type="text"
                    name="full_name"
                    placeholder="Enter your full name"
                    required
                >

            </div>


            <div class="form-group">

                <label>
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    placeholder="Enter your email"
                    required
                >

            </div>


            <div class="form-group">

                <label>
                    Username
                </label>

                <input
                    type="text"
                    name="username"
                    placeholder="Create a username"
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
                    placeholder="Create a password"
                    required
                >

            </div>


            <div class="form-group">

                <label>
                    Confirm Password
                </label>

                <input
                    type="password"
                    name="confirm_password"
                    placeholder="Confirm your password"
                    required
                >

            </div>


            <button
                type="submit"
                class="auth-button"
            >
                Register
            </button>

        </form>


        <p class="auth-link">

            Already have an account?

            <a href="login.php">
                Sign In
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