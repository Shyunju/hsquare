<?php
    session_start();
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
    <p><input type="button" name="logo" value="로고" onClick="location.href='dev_main.php'"></p>
    <?php
    echo $_SESSION['uname']."님";
    ?>
    <input type="button" name="logout" value="logout" onClick="outcheck()"><br>
    <input type="button" name="mem_info" value="회원 정보 확인" onClick="location.href='dev_mem_list.php'">
    <input type="button" name="reservation" value="강연 예약 현황" onClick="location.href='dev_calendar.php'"><br>

    <script type="text/javascript" src="outcheck.js"></script>
</body>

</html>