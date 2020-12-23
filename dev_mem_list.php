<?php
    session_start();
    $conn = mysqli_connect("localhost", "root", "hj990814", "hsquare");
    ?>
    
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="mem_list.css">
</head>

<body>
    <input id='logo' type="button" name="logo" value="로고" onClick="location.href='dev_main.php'"><br>

    <div id='right_side'>
    <?php
    echo $_SESSION['uname']."님";
    ?>
        <input type="button" name="logout" value="logout" onClick="outcheck()">
        <input type="button" name="register" value="예약현황" onClick="location.href='dev_calendar.php'"><br>
    </div>
    <div id='info_list'>
        회원 정보 확인<br></div>
    <br>
    <div id='content'>

        <div class='thum'>
        <?php
            $sql = "SELECT * FROM umaster";
            $result= mysqli_query($conn, $sql) or die(mysqli_error($conn).$sql);

            while($row = mysqli_fetch_array($result)){
                if($row['id'] == 1){
                    continue;
                }
        ?>
                <form action="dev_mem_info.php" method='post'>
                <input type="hidden" name='id' value="<?=$row['id']?>">
                <input type="submit" name="name" value="<?=$row['uname']?>">
                </form>
        <?php
            }
        ?>
            <br>
        </div>
    </div>

    <script type="text/javascript" src="outcheck.js"></script>
</body>
</html>