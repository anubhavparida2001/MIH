<?php require_once "controllerUserData.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Your Match</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100%;
            width: 78px;
            background: #11101D;
            padding: 6px 14px;
            z-index: 99;
            transition: all 0.5s ease;
        }

        .sidebar.open {
            width: 250px;
        }

        .sidebar .logo-details {
            height: 60px;
            display: flex;
            align-items: center;
            position: relative;
        }

        .sidebar .logo-details .icon {
            opacity: 0;
            transition: all 0.5s ease;
        }

        .sidebar .logo-details .logo_name {
            color: #fff;
            font-size: 20px;
            font-weight: 600;
            opacity: 0;
            transition: all 0.5s ease;
        }

        .sidebar.open .logo-details .icon,
        .sidebar.open .logo-details .logo_name {
            opacity: 1;
        }

        .sidebar .logo-details #btn {
            position: absolute;
            top: 50%;
            right: 0;
            transform: translateY(-50%);
            font-size: 22px;
            transition: all 0.4s ease;
            font-size: 23px;
            text-align: center;
            cursor: pointer;
            transition: all 0.5s ease;
        }

        .sidebar.open .logo-details #btn {
            text-align: right;
        }

        .sidebar i {
            color: #fff;
            height: 60px;
            min-width: 50px;
            font-size: 28px;
            text-align: center;
            line-height: 60px;
        }

        .sidebar .nav-list {
            margin-top: 20px;
            height: 100%;
        }

        .sidebar li {
            position: relative;
            margin: 8px 0;
            list-style: none;
        }

        .sidebar li .tooltip {
            position: absolute;
            top: -20px;
            left: calc(100% + 15px);
            z-index: 3;
            background: #fff;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 15px;
            font-weight: 400;
            opacity: 0;
            white-space: nowrap;
            pointer-events: none;
            transition: 0s;
        }

        .sidebar li:hover .tooltip {
            opacity: 1;
            pointer-events: auto;
            transition: all 0.4s ease;
            top: 50%;
            transform: translateY(-50%);
        }

        .sidebar.open li .tooltip {
            display: none;
        }

        .sidebar input {
            font-size: 15px;
            color: #FFF;
            font-weight: 400;
            outline: none;
            height: 50px;
            width: 100%;
            width: 50px;
            border: none;
            border-radius: 12px;
            transition: all 0.5s ease;
            background: #1d1b31;
        }

        .sidebar.open input {
            padding: 0 20px 0 50px;
            width: 100%;
        }

        .sidebar .bx-search {
            position: absolute;
            top: 50%;
            left: 0;
            transform: translateY(-50%);
            font-size: 22px;
            background: #1d1b31;
            color: #FFF;
        }

        .sidebar.open .bx-search:hover {
            background: #1d1b31;
            color: #FFF;
        }

        .sidebar .bx-search:hover {
            background: #FFF;
            color: #11101d;
        }

        .sidebar li a {
            display: flex;
            height: 100%;
            width: 100%;
            border-radius: 12px;
            align-items: center;
            text-decoration: none;
            transition: all 0.4s ease;
            background: #11101D;
        }

        .sidebar li a:hover {
            background: #FFF;
        }

        .sidebar li a .links_name {
            color: #fff;
            font-size: 15px;
            font-weight: 400;
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: 0.4s;
        }

        .sidebar.open li a .links_name {
            opacity: 1;
            pointer-events: auto;
        }

        .sidebar li a:hover .links_name,
        .sidebar li a:hover i {
            transition: all 0.5s ease;
            color: #11101D;
        }

        .sidebar li i {
            height: 50px;
            line-height: 50px;
            font-size: 18px;
            border-radius: 12px;
        }

        .sidebar li.profile {
            position: fixed;
            height: 60px;
            width: 78px;
            left: 0;
            bottom: -8px;
            padding: 10px 14px;
            background: #1d1b31;
            transition: all 0.5s ease;
            overflow: hidden;
        }

        .sidebar.open li.profile {
            width: 250px;
        }

        .sidebar li .profile-details {
            display: flex;
            align-items: center;
            flex-wrap: nowrap;
        }

        .sidebar li img {
            height: 45px;
            width: 45px;
            object-fit: cover;
            border-radius: 6px;
            margin-right: 10px;
        }

        .sidebar li.profile .name,
        .sidebar li.profile .job {
            font-size: 15px;
            font-weight: 400;
            color: #fff;
            white-space: nowrap;
        }

        .sidebar li.profile .job {
            font-size: 12px;
        }

        .sidebar .profile #log_out {
            position: absolute;
            top: 50%;
            right: 0;
            transform: translateY(-50%);
            background: #1d1b31;
            width: 100%;
            height: 60px;
            line-height: 60px;
            border-radius: 0px;
            transition: all 0.5s ease;
        }

        .sidebar.open .profile #log_out {
            width: 50px;
            background: none;
        }

        .home-section {
            position: relative;
            background: #E4E9F7;
            min-height: 100vh;
            top: 510px;
            left: 679px;
            width: calc(55% - 494px);
            transition: all 0.5s ease;
            z-index: 2;
        }

        .sidebar.open~.home-section {
            left: 250px;
            width: calc(100% - 250px);
        }

        .home-section .text {
            display: inline-block;
            color: #11101d;
            font-size: 25px;
            font-weight: 500;
            margin: 18px
        }

        @media (max-width: 420px) {
            .sidebar li .tooltip {
                display: none;
            }
        }

        .test {
            max-width: 10000px;
            position: absolute;
            top: 60%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #E4E9F7;
            text-align: left;
            background: rgb(167, 167, 233);
            padding: 30px 35px;
            border-radius: 5px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            font-size: 20px;
        }

        .test img {
            border-radius: 50%;
            height: 150px;
            width: 150px;
            margin-left: 65px;
            margin-right: 65px;

        }

        ::selection {
            color: #E4E9F7;
            background: #E4E9F7;
        }

        html,
        body {
            background: #E4E9F7;
            font-family: 'Poppins', sans-serif;
        }

        h2 {
            padding: 100px 100px;
            text-align: center;
        }

        .para {
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <div class="logo-details">
            <i class='images/logo.png'></i>
            <div class="logo_name">MIH</div>
            <i class='bx bx-menu' id="btn"></i>
        </div>
        <ul class="nav-list">
            <li>
                <a href="#">
                    <i class='bx bx-arrow-back' id="back"></i>
                    <span class="links_name">Go back</span>
                </a>
                <span class="tooltip">back</span>
            </li>
            <li>
                <a href="index.html">
                    <i class='bx bx-home'></i>
                    <span class="links_name">HOME</span>
                </a>
                <span class="tooltip">HOME</span>
            </li>
            <li>
                <a href="login-user.php">
                    <i class='bx bx-user'></i>
                    <span class="links_name">LOGIN/REGISTER</span>
                </a>
                <span class="tooltip">LOGIN/REG</span>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-play-circle'></i>
                    <span class="links_name">ABOUT US</span>
                </a>
                <span class="tooltip">ABOUT</span>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-pie-chart-alt-2'></i>
                    <span class="links_name">PLANNERS</span>
                </a>
                <span class="tooltip">PLANNER</span>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-folder'></i>
                    <span class="links_name">BLOG</span>
                </a>
                <span class="tooltip">BLOG</span>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-message-square-detail'></i>
                    <span class="links_name">CONTACT US</span>
                </a>
                <span class="tooltip">CONTACT</span>
            </li>
            <li>
                <a href="pricing.php">
                    <i class='bx bx-heart'></i>
                    <span class="links_name">MEMBERSHIP</span>
                </a>
                <span class="tooltip">MEMBER</span>
            </li>
            <li>
                <a href="delete.php">
                    <i class='bx bx-cog'></i>
                    <span class="links_name">SETTING</span>
                </a>
                <span class="tooltip">Setting</span>
            </li>
            <li class="profile">
                <div class="name_job">
                    <div class="name"><?php echo $fetch_info['name'] ?></div>
                    <div class="job">USER</div>
                </div>
                <a href="logout-user.php">
                    <i class='bx bx-log-out' id="log_out"></i>
                </a>
            </li>
        </ul>
    </div>

    <div class="home_section">

        <h2>Find Your Perfect Match</h2>

        <div class="para">

            <?php

            error_reporting(E_ERROR | E_WARNING | E_PARSE);

            session_start();
            $email = $_SESSION['email'];

            $sql = "SELECT * FROM `usertable` WHERE email = '$email'";
            $result = mysqli_query($con, $sql);

            $row = mysqli_fetch_assoc($result);

            echo "Hello, " . $row['name'] . ". We hope that you will find your soulmate here. All the Best.";

            echo " <br><br>Some Recomended Names from our side: <br><br>";

            if ($row['G'] == "Male") {
                $sql = "SELECT * FROM `usertable` WHERE G = 'Female' ";
                $result = mysqli_query($con, $sql);

                if ($result->num_rows > 0) {

                    while ($row = mysqli_fetch_assoc($result)) {

                        echo "Name: " . $row['name'] . "<br>";
                        echo "Date of Birth: " . $row['DOB'] . "<br>";
                        echo "Religion: " . $row['R'] . "<br>";
                        echo "Mother Tongue: " . $row['MT'] . "<br>";
                        echo "Caste: " . $row['C'] . "<br>";
                        echo "Employed In: " . $row['EI'] . "<br>";
                        echo "Occupation: " . $row['OCC'] . "<br>";
                        echo "Annual Income: " . $row['AI'] . "<br>";
                        echo "Work Location: " . $row['WL'] . "<br>";
                        echo "Residing State: " . $row['RS'] . "<br>";
                        echo "About: " . $row['About'] . "<br>";
                        echo "<br>";
                        echo "You can like this profile. If this user also like your profile then you guys can chat.";
                        echo "<br><br><br>"; 
                    }
                }
            } else {
                $sql = "SELECT * FROM `usertable` WHERE G = 'Male' ";
                $result = mysqli_query($con, $sql);

                if ($result->num_rows > 0) {

                    while ($row = mysqli_fetch_assoc($result)) {

                        echo "Name: " . $row['name'] . "<br>";
                        echo "Date of Birth: " . $row['DOB'] . "<br>";
                        echo "Religion: " . $row['R'] . "<br>";
                        echo "Mother Tongue: " . $row['MT'] . "<br>";
                        echo "Caste: " . $row['C'] . "<br>";
                        echo "Employed In: " . $row['EI'] . "<br>";
                        echo "Occupation: " . $row['OCC'] . "<br>";
                        echo "Annual Income: " . $row['AI'] . "<br>";
                        echo "Work Location: " . $row['WL'] . "<br>";
                        echo "Residing State: " . $row['RS'] . "<br>";
                        echo "About: " . $row['About'] . "<br>";
                        echo "<br>";
                        echo "You can like this profile. If this user also like your profile then you guys can chat.";
                        echo "<br><br><br>";
                    }
                }
            }

            ?>
        </div>
    </div>
</body>

</html>