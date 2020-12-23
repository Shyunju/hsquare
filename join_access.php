<?php
    $conn = mysqli_connect("localhost", "root", "hj990814", "hsquare");

    $filtered = array('uname'=>mysqli_real_escape_string($conn, $_POST['uname']), 
                        'email'=>mysqli_real_escape_string($conn, $_POST['email']),
                        'pwd'=>mysqli_real_escape_string($conn, $_POST['pwd']),
                        'pnum'=>mysqli_real_escape_string($conn, $_POST['pnum']));
    $sql = "SELECT * FROM umaster WHERE email='{$filtered['email']}'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    if(isset($row)){
        echo"<script> window.alert('이미 가입된 이메일입니다.');</script>";
        echo"<script> location.href='join.php';</script>";
    } else{
        $pwd = hash('sha256', $filtered['pwd']);
        $sql = "INSERT INTO umaster (uname, email, pwd, pnum) 
            VALUES ('{$filtered['uname']}', 
                    '{$filtered['email']}', 
                    '{$pwd}', 
                    '{$filtered['pnum']}') ";
        $result= mysqli_query($conn, $sql) or die(mysqli_error($conn).$sql);
    }
?>
<!Doctype html>
<html>
    <script> 
    alert('회원가입이 완료되었습니다. 로그인 해주세요.');
    document.location.href="index.php"; 
    </script>
</html>
