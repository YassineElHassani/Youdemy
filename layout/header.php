<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./src/css/style.css">
    <script src="./src/js/main.js" defer></script>
</head>

<body class="bg-[#535353]">
    <header>
        <nav class="navbar">
            <span class="hamburger-btn material-symbols-rounded">menu</span>
            <a href="/" class="logo">
                <img src="./src/img/logo.png" alt="logo">
                <h2>Youdemy</h2>
            </a>
            <ul class="links">
                <li><a href="#">Courses</a></li>
                <li><a href="#">About us</a></li>
                <li><a href="#">Contact us</a></li>
            </ul>
            <div style="display: flex; align-items: center; gap: 10px;">
                <a href="./login/index.php"><button class="login-btn">LOG IN</button></a>
                <a href="./register/index.php"><button class="login-btn">REGISTER</button></a>
            </div>
        </nav>
    </header>