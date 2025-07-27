<?php
session_start();
include("koneksi/koneksi.php");

if(isset($_SESSION["is_login"])){
    header("Location: dashboard.php");
}

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $hash_password = hash('sha256', $password);

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$hash_password'";

    $result = $db->query($sql);

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $_SESSION["username"] = $data["username"];
        $_SESSION["is_login"] = true;
        header("Location: dashboard.php");
        exit();
    } else {
        $login_massage = "akun atau Password salah!";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<style>
    /* Google Font */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap');

/* Reset dan font */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    background: linear-gradient(135deg, #667eea, #764ba2);
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Kontainer utama */
div {
    background: rgba(255, 255, 255, 0.15);
    padding: 40px;
    border-radius: 20px;
    backdrop-filter: blur(10px);
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
    width: 90%;
    max-width: 400px;
    text-align: center;
    color: #fff;
}

/* Heading */
h2 {
    margin-bottom: 20px;
    font-weight: 500;
}

/* Label dan input */
form label {
    display: block;
    text-align: left;
    margin: 15px 0 5px;
    font-size: 14px;
    color: #f0f0f0;
}

form input[type="text"],
form input[type="password"] {
    width: 100%;
    padding: 10px 15px;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    background: rgba(255, 255, 255, 0.8);
    color: #333;
    transition: 0.3s;
}

form input:focus {
    outline: none;
    background: #fff;
    box-shadow: 0 0 5px rgba(255, 255, 255, 0.8);
}

/* Tombol login */
button[type="submit"] {
    margin-top: 20px;
    width: 100%;
    padding: 12px;
    border: none;
    border-radius: 8px;
    background: #fff;
    color: #764ba2;
    font-weight: bold;
    font-size: 16px;
    cursor: pointer;
    transition: 0.3s ease-in-out;
}

button[type="submit"]:hover {
    background: #764ba2;
    color: #fff;
    transform: scale(1.03);
}
</style>

<body>
    <div>
        <h2>Masukkan Username dan Password</h2>

        <form action="login.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <br>
            <button type="submit">Login</button>
        </form>
    </div>

</body>

</html>