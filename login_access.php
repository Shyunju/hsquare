<?php
    session_start();
    $conn = mysqli_connect("localhost", "root", "hj990814", "hsquare");

    $filtered = array('uname'=>mysqli_real_escape_string($conn, $_POST['uname']), 
                        'email'=>mysqli_real_escape_string($conn, $_POST['email']),
                        'pwd'=>mysqli_real_escape_string($conn, $_POST['pwd']),
                        'pnum'=>mysqli_real_escape_string($conn, $_POST['pnum']));
    $email = $filtered['email'];
    $pwd = hash('sha256', $filtered['pwd']);

    $sql = "SELECT * FROM umaster WHERE email ='$email' AND pwd='$pwd'";
    $result= mysqli_query($conn, $sql) or die(mysqli_error($conn).$sql);
    $row = mysqli_fetch_array($result);

    if($email === $row['email'] && $pwd === $row['pwd']){ //email과 pwd가 맞다면로그인
        $_SESSION['uname']=$row['uname'];
        $_SESSION['email']=$row['email'];
        $_SESSION['pwd']=$row['pwd'];
        $_SESSION['id']=$row['id'];

        if($_SESSION['id'] == 1){
            echo "<script> location.href='dev_main.php';</script>";
        }else{
            echo "<script> location.href='main.php';</script>";
        }

    } else{
        echo"<script> window.alert('잘못된 아이디 혹은 비밀번호입니다.');</script>";
        echo"<script> location.href='index.php';</script>";
    } 
?>