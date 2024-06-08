<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Popup</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: whitesmoke;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: white;
            color: black;
        }

        .logo img {
            height: 50px;
        }

        .nav-auth {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .nav {
            display: flex;
            gap: 15px;
        }

        .nav a {
            color: black;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .nav a:hover {
            text-decoration: underline;
        }

        .auth-buttons {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .login-btn,
        .signup-btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .login-btn {
            background-color: orange;
            color: #fff;
        }

        .signup-btn {
            background-color: lightblue;
            color: #fff;
        }

        /* .login-btn:hover {
            background-color: #777;
        }

        .signup-btn:hover {
            background-color: #0056b3;
        } */

        .profile {
            position: relative;
        }

        .profile-icon {
            height: 40px;
            width: 40px;
            border-radius: 50%;
            cursor: pointer;
        }

        .profile-popup {
            display: none;
            position: absolute;
            top: 50px;
            right: 0;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            overflow: hidden;
            z-index: 1000;

        }

        .profile-content {
            padding: 20px;
            position: relative;
        }

        .profile-content h2 {
            margin-top: 0;
        }

        .profile-toggle {
            display: none;
        }

        .profile-toggle:checked+label+.profile-popup {
            display: block;
            width: 250px;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            cursor: pointer;
        }

        .logout-btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #ff4b5c;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .logout-btn:hover {
            background-color: #d7384a;
        }

        #login-btn,
        #signup-btn {
            color: white;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <header class="header">
        <div class="logo">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR3420502Ztc7RjaetY17CYvJv3m21wM14scg&s" alt="Logo">
        </div>
        <div class="nav-auth">
            <nav class="nav">
                <a href="index.php">Home</a>
                <a href="#about">About</a>
                <a href="#services">Services</a>
                <a href="#contact">Contact</a>
            </nav>
            <div class="auth-buttons">
                <?php
                require_once('lib.php');
                $is_login = is_login();
                if ($is_login == false) { ?>
                    <button class="login-btn"><a href='login.php' id="login-btn">Login</a></button>
                    <button class="signup-btn"><a href='signup.php' id="signup-btn">Signup</a></button>
                <?php
                } else {
                ?>

                    <div class="profile">

                        <input type="checkbox" id="profileToggle" class="profile-toggle">
                        <label for="profileToggle">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRp0xKoXUryp0JZ1Sxp-99eQiQcFrmA1M1qbQ&s" alt="Profile" class="profile-icon">
                        </label>
                        <div class="profile-popup">
                            <div class="profile-content">
                                <label for="profileToggle" class="close">&times;</label>
                                <h2>Profile</h2>
                                <p>Name: <?php echo $is_login->data->username ?></p>
                                <p>Email: <?php echo $is_login->data->email ?></p>
                                <button class="logout-btn"><a href='logout.php'>Logout</a></button>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </header>
</body>

</html>