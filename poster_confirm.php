<?php
    session_start();
    $conn = mysqli_connect("localhost", "root", "hj990814", "hsquare");
    
    
    if(isset($_POST['id'])){
        $_SESSION['mem']= $_POST['id'];  
    }else if(isset($_SESSION['mem'])){

    }else{
        $_SESSION['mem']= $_SESSION['id'];
    }
    $sql = "SELECT * FROM umaster WHERE id={$_SESSION['mem']}";
    $result= mysqli_query($conn, $sql) or die(mysqli_error($conn).$sql);
    $row = mysqli_fetch_array($result);
    ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="poster_confirm.css">

</head>


<body>

<?php
    if($_SESSION['id'] === '1'){
?>
            <input id='logo' type="button" name="logo" value="로고" onClick="location.href='dev_main.php'"><br>
<?php
        }else{
?>
            <input id='logo' type="button" name="logo" value="로고" onClick="location.href='main.php'"><br>
<?php
        }
?>
    <div id='right_side'>
        <?php
        echo $_SESSION['uname']."님";
        ?>
        <input type="button" name="logout" value="logout" onClick="outcheck()">
<?php
    if($_SESSION['id'] === '1'){
?>
            <input type="button" name="register" value="강연현황" onClick="location.href='dev_calendar.php'"><br>
<?php
        }else{
?>
            <input type="button" name="register" value="강연신청" onClick="location.href='calendar.php'"><br>
<?php
        }
?>
    </div>
    <div id='confirm_zone'><?= $row['uname']?>님의 컨펌 ZONE</div>
    <?php
        if($_SESSION['id'] == 1){
    ?>
            <a href="create.php">게시물 작성</a>
    <?php
        }
    ?>

    <div id='con_cat'>
        <input type="button" name="poster_button" value="포스터" onClick="location.href='poster_confirm.php'">
        <input type="button" name="video_button" value="영상" onClick="location.href='video_confirm_thumbnail.php'"><br>
    </div>

    <div id='left_side'>
        <input type="button" name="confirm_button" value="컨펌" onClick="location.href='poster_confirm.php'"><br>
        <input type="button" name="finish_button" value="완료" onClick="location.href='poster_finish.php'">
    </div>
    <div id='content'>
        <span id='title'>
        <?php
            $sql="SELECT * FROM media WHERE EXISTS(SELECT * FROM media WHERE umaster_id={$_SESSION['mem']})";
            $result= mysqli_query($conn, $sql);
            
            
            while($row = mysqli_fetch_array($result)){
                if($row['what']==="p" && $row['done']==="n"){
            ?>
                    <form action="show_media.php" method='post'>
                    <input type="hidden" name="media_id" value="<?=$row['id']?>">
                    <input type="submit" name="title" value="<?=$row['title']?>">
                    </form>
            <?php
                }else{
                    continue;
                }
            }
        ?>
        </span>
        <br>
        

        <div id="disqus_thread"></div>
    </div>

    <script type="text/javascript" src="outcheck.js"></script>
</body>
</html>