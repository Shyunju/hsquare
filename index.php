<!DOCTYPE html>
<?php
    session_start();
    $conn = mysqli_connect("localhost", "root", "hj990814", "HSQUARE");
?>
<html>
<head>
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="home.css">
</head>

<body>
    <input type="button" name="logo" value="로고" onClick="location.href='index.php'"><br><br>
    <form action = "login_access.php" method ='post'>
        <input id="home_email" type="text" name="email" placeholder="이메일 입력"><br>
        <p><input id="home_email" type="password" name="pwd" placeholder="비밀번호 입력"></p>
        <input type="submit" name="login" value="로그인">
        <input type="button" name="join" value="회원가입" onClick="location.href='join.php'">   
    </form>

</body>
</html>