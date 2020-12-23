<?php
    session_start();
    $mem_id = $_POST['id'];
    $conn = mysqli_connect("localhost", "root", "hj990814", "hsquare");
    $sql = "SELECT * FROM umaster WHERE id='$mem_id'";
    $result= mysqli_query($conn, $sql) or die(mysqli_error($conn).$sql);
    $row = mysqli_fetch_array($result);
    
?>  
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="member.css">
</head>

<body>
    <input id='logo' type="button" name="logo" value="로고" onClick="location.href='dev_main.php'"><br>
    <div id='right_side'>
    <?= $_SESSION['uname']?>님
        <input type="button" name="logout" value="logout" onClick="outcheck()">
        <input type="button" name="register" value="예약현황" onClick="location.href='dev_calendar.php'">
        <br>
    </div>

    <section id='right'>
        <table>
            <tr>
                <td> <input type="button" id='button' name="thumnail1" value=" "></td>
                <td>
                    <input id='mem_text' type="text" name="name" value="<?=$row['uname']?>"><br>
                    <input id='mem_text' type="text" name="email" value="<?=$row['email']?>"><br>
                    <input id='mem_text' type="text" name="phone_number" value="<?=$row['pnum']?>"><br>
                </td>
            </tr>
        </table>
        <br>
    <?php
        $sql="SELECT * FROM lec_info WHERE EXISTS (SELECT * FROM lec_info WHERE umaster_id='$mem_id')";
        $result= mysqli_query($conn, $sql);
        
        if($row = mysqli_fetch_array($result)){
            $intro=$row['intro'];
            $info=$row['info'];
            $title=$row['title'];
            $theme=$row['theme'];
            $runtime=$row['runtime'];
            $recruit=$row['recruit'];
            $hope=$row['hope'];
            $yyy=$row['yyy'];
            $mmm=$row['mmm'];
            $ddd=$row['ddd'];
        } else {
            $intro="";
            $info="";
            $title="";
            $theme="";
            $runtime="";
            $recruit="";
            $hope="";
            $yyy="";
            $mmm="";
            $ddd="";
        }
    ?>
        <table>
            <tr>
                <td>강연자 한줄소개 </td>
                <td><input class='ta_tx' type="text" name="introduce" placeholder="한줄소개" value="<?=$intro?>"></td>
            </tr>
            <tr>
                <td>강연자 정보</td>
                <td><input class='ta_tx' type="text" name="information" placeholder="강연자 정보" value="<?=$info?>"></td>
            </tr>
            <tr>
                <td>강연 제목</td>
                <td><input class='ta_tx' type="text" name="introduce" placeholder="강연 제목" value="<?=$title?>"></td>
            </tr>
            <tr>
                <td> 강연 주제</td>
                <td><input class='ta_tx' type="text" name="introduce" placeholder="강연 주제" value="<?=$theme?>"></td>
            </tr>
            <tr>
                <td>강연 런타임</td>
                <td><input class='ta_tx' type="text" name="information" placeholder="강연 런타임" value="<?=$runtime?>"></td>
            </tr>
            <tr>
                <td>모집 인원</td>
                <td><input class='ta_tx' type="text" name="introduce" placeholder="모집 인원" value="<?=$recruit?>"></td>
            </tr>
            <tr>
                <td>요구 사항</td>
                <td><input class='ta_tx' type="text" name="information" placeholder="요구 사항" value="<?=$hope?>"></td>
            </tr>
        </table>
        <form action="poster_confirm.php" method="post">
        <input type="hidden" name='id' value="<?=$mem_id?>">
        <input class='ta_tx' type="submit" name="enter" value="해당회원 컨펌존">
        </form>

        <form action='del_info.php' method='post'>
        <input type="hidden" name='id' value="<?=$mem_id?>">
        <input class='ta_tx' type="submit" name="enter" value="강연완료">
        </form>
    </section>

    <script type="text/javascript" src="outcheck.js"></script>
</body>
</html>