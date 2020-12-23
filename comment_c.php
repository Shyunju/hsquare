<?php
    $conn = mysqli_connect(
        'localhost',
        'root',
        'hj990814',
        'hsquare'
    );
    
    $descript = mysqli_real_escape_string($conn, $_POST['descript']);

    $sql = " INSERT INTO comment (ttt, descript, media_id, umaster_id, writer)
                VALUES (NOW(), 
                '{$descript}', 
                '{$_POST['media_id']}', 
                '{$_POST['umaster_id']}', 
                '{$_POST['writer']}'
                )";

    $result = mysqli_query($conn, $sql);

    if($result === false) {
        echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요';
        error_log(mysqli_error($conn));
    } else {
        header('Location: show_media.php');
    }
?>