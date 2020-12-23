<?php
    session_start();
    $conn = mysqli_connect("localhost", "root", "hj990814", "hsquare");
    $sql = "SELECT * FROM umaster WHERE id={$_SESSION['mem']}";
    $result= mysqli_query($conn, $sql) or die(mysqli_error($conn).$sql);
    $row = mysqli_fetch_array($result);
    ?>
<!DOCTYPE html>
<script>
        function check_input() {
            if (!document.con_form.title.value){// con_form 이름을 가진 form 안의 title 의 value가 없으면
                alert("제목을 입력하세요.");
                document.con_form.title.focus();
                // 화면 커서 이동
                return;
            }
            if (!document.con_form.what.value){
                alert("카테고리를 선택하세요.");
                document.con_form.what.focus();
                return;
            }
            if (!document.con_form.descript.value){
                alert("내용을 입력하세요.");
                document.con_form.descript.focus();
                return;
            }
            document.con_form.submit();
            // 모두 확인 후 submit()
        }
</script>
<html>

<head>
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="poster_confirm.css">
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
    <div id='confirm_zone'><?= $row['uname']?>님의 컨펌 ZONE</div>

    <div id='con_cat'>
        <input type="button" name="poster_button" value="포스터" onClick="location.href='poster_confirm.php'">
        <input type="button" name="video_button" value="영상" onClick="location.href='video_confirm_thumbnail.php'"><br>
    </div>

    <div id='left_side'>
        <input type="button" name="confirm_button" value="컨펌" onClick="location.href='poster_confirm.php'"><br>
        <input type="button" name="finish_button" value="완료" onClick="location.href='poster_finish.php'">
    </div>
    <div id='content'>

    <div id="disqus_thread"></div>

    <form action="contents_c.php" name="con_form" method="POST">
        <input type="text" name="title" placeholder="제목"><br>
        <select name="what">
            <option selected>포스터/영상</option>
            <option name="poster" value="p">포스터</option>
            <option name="video" value="v">영상</option>
        </select><br>
        <textarea name="descript" placeholder="내용"></textarea><br>
        <input type="submit" value="업로드" onClick="check_input()">
    </form>
    
    </div>
    <script type="text/javascript" src="outcheck.js"></script>
</body>

</html>