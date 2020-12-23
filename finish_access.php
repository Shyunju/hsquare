<?php
    session_start();
    $conn = mysqli_connect("localhost", "root", "hj990814", "hsquare");

    $sql = "UPDATE media SET done='y' WHERE id={$_SESSION['media_id']}";
    $result= mysqli_query($conn, $sql) or die(mysqli_error($conn).$sql);

    if($result){
        echo "<script> window.alert('완료 카태고리로 이동 되었습니다.');</script>";
        echo "<script> location.href='show_media.php';</script>";
    }else{
        echo "<script> window.alert('실패.');</script>";
        echo "<script> location.href='show_media.php';</script>";
    }