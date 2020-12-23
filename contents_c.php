<?php
    session_start();
    $conn = mysqli_connect(
        'localhost',
        'root',
        'hj990814',
        'hsquare'
    );

    $filtered = array(
        'title' => mysqli_real_escape_string($conn, $_POST['title']),
        'what' => mysqli_real_escape_string($conn, $_POST['what']),
        'descript' => mysqli_real_escape_string($conn, $_POST['descript'])
    );

    $sql = "INSERT INTO media (what, ttt, title, descript, umaster_id, done) 
            VALUES ('{$filtered['what']}', 
                    NOW(), 
                    '{$filtered['title']}', 
                    '{$filtered['descript']}',
                    '{$_SESSION['mem']}',
                    'n'
                    )";

    $result = mysqli_query($conn, $sql);

    if($filtered['what'] === 'p') {
        header("Location: poster_confirm.php");
    } else if($filtered['what'] === 'v') {
        header('Location: video_confirm_thumbnail.php');
    } else {
        echo "저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요";
        error_log(mysqli_error($conn));
    }
?>
