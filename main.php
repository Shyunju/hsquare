<?php
    session_start();
    if( $_SESSION['id'] === null){
        echo "<script> location.href='index.php';</script>";
    }
    $conn = mysqli_connect("localhost", "root", "hj990814", "hsquare");
    $sql = "SELECT * FROM umaster WHERE id={$_SESSION['id']}";
    $result= mysqli_query($conn, $sql) or die(mysqli_error($conn).$sql);
    $row = mysqli_fetch_array($result);
    ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="main.css">
</head>

<body>
    <p><input type="button" name="logo" value="로고" onClick="location.href='main.php'"></p>
    <?php
    echo $_SESSION['uname']."님";
    ?><br>
    <input type="button" name="logout" value="logout" onClick="outcheck()">

    <input type="button" name="reservation" value="강연예약" onClick="location.href='calendar.php'"><br>
    <input type="button" name="confirm_p" value="포스터 컨펌존" onClick="location.href='poster_confirm.php'">
    <input type="button" name="confirm_v" value="컨펌존(영상)" onClick="location.href='video_confirm_thumbnail.php'"><br>

    <script type="text/javascript" src="outcheck.js"></script> 
</body>

</html>