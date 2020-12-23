<?php
        $conn = mysqli_connect("localhost", "root", "hj990814", "hsquare");
        session_start();

        $sql = "DELETE FROM lec_info WHERE umaster_id={$_POST['id']}";

        $result= mysqli_query($conn, $sql) or die(mysqli_error($conn).$sql);

        if($result){
            echo "<script> window.alert('해당 해원의 강연정보가 삭제되었습니다.');</script>";
            header('Location: dev_calendar.php');
        }
        else{
            echo "<script> window.alert('정보처리에 문제가 생겼습니다.');</script>";
            header('Location: dev_mem_info.php');
        }