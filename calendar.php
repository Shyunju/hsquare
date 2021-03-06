<?php
    session_start();

    $conn = mysqli_connect("localhost", "root", "hj990814", "hsquare");
    $sql = "SELECT * FROM umaster WHERE  id={$_SESSION['id']}";
    $result= mysqli_query($conn, $sql) or die(mysqli_error($conn).$sql);
    $row = mysqli_fetch_array($result);

    //---- 오늘 날짜
    $thisyear = date('Y'); // 4자리 연도
    $thismonth = date('n'); // 0을 포함하지 않는 월
    $today = date('j'); // 0을 포함하지 않는 일

    //------ $year, $month 값이 없으면 현재 날짜
    $year = isset($_GET['year']) ? $_GET['year'] : $thisyear;
    $month = isset($_GET['month']) ? $_GET['month'] : $thismonth;
    $day = isset($_GET['day']) ? $_GET['day'] : $today;

    $prev_month = $month - 1;
    $next_month = $month + 1;
    $prev_year = $next_year = $year;
    if ($month == 1) {
        $prev_month = 12;
        $prev_year = $year - 1;
    } else if ($month == 12) {
        $next_month = 1;
        $next_year = $year + 1;
    }
    $preyear = $year - 1;
    $nextyear = $year + 1;

    $predate = date("Y-m-d", mktime(0, 0, 0, $month - 1, 1, $year));
    $nextdate = date("Y-m-d", mktime(0, 0, 0, $month + 1, 1, $year));

    // 1. 총일수 구하기
    $max_day = date('t', mktime(0, 0, 0, $month, 1, $year)); // 해당월의 마지막 날짜
    //echo '총요일수'.$max_day.'<br />';

    // 2. 시작요일 구하기
    $start_week = date("w", mktime(0, 0, 0, $month, 1, $year)); // 일요일 0, 토요일 6

    // 3. 총 몇 주인지 구하기
    $total_week = ceil(($max_day + $start_week) / 7);

    // 4. 마지막 요일 구하기
    $last_week = date('w', mktime(0, 0, 0, $month, $max_day, $year));
?>    
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="cal_test.css">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
    font.holy {font-family: tahoma;font-size: 20px;color: #FF6C21;}
    font.blue {font-family: tahoma;font-size: 20px;color: #0000FF;}
    font.black {font-family: tahoma;font-size: 20px;color: #000000;}
    font.green {font-family: tahoma;font-size: 20px;color: #33FF33;}

    table{
        border-collapse : collapse;
        border : 1px solid black;
    }
    tr, td, th{
        border-collapse : collapse;
        border : 1px solid black;
        width : 90px;
    }

    #reserv{
        background-color : blue;
        color : white;
    }
    #mine{
        background-color : green;
        color : white;
    }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>

<body>
    <input id='logo' type="button" name="logo" value="로고" onClick="location.href='main.php'"><br>
    <div id='right_side'>
        <?php
        echo $_SESSION['uname']."님";
        ?>  
        <input type="button" name="logout" value="logout" onClick="outcheck()">
        <input type="button" name="confirm" value="컨펌ZONE" onClick="location.href='poster_confirm.php'">
        <input type="button" name="confirm" value="강연신청" onClick="location.href='member.php'"><br>
    </div>
    <div class="container">
        <table class="table table-bordered table-responsive">
            <tr align="center" >
                <td>
                    <a href=<?php echo 'calendar.php?year='.$preyear.'&month='.$month . '&day=1'; ?>>◀◀</a>
                </td>
                <td>
                    <a href=<?php echo 'calendar.php?year='.$prev_year.'&month='.$prev_month . '&day=1'; ?>>◀</a>
                </td>
                <td height="50" bgcolor="#FFFFFF" colspan="3">
                    <a href=<?php echo 'calendar.php?year=' . $thisyear . '&month=' . $thismonth . '&day=1'; ?>>
                    <?php echo "&nbsp;&nbsp;" . $year . '년 ' . $month . '월 ' . "&nbsp;&nbsp;"; ?></a>
                </td>
                <td>
                    <a href=<?php echo 'calendar.php?year='.$next_year.'&month='.$next_month.'&day=1'; ?>>▶</a>
                </td>
                <td>
                    <a href=<?php echo 'calendar.php?year='.$nextyear.'&month='.$month.'&day=1'; ?>>▶▶</a>
                </td>
            </tr>
            <tr class="info">
                <th hight="30">일</td>
                <th>월</th>
                <th>화</th>
                <th>수</th>
                <th>목</th>
                <th>금</th>
                <th>토</th>
            </tr>

            <?php
                // 5. 화면에 표시할 화면의 초기값을 1로 설정
                $day=1;

                // 6. 총 주 수에 맞춰서 세로줄 만들기
                for($i=1; $i <= $total_week; $i++){?>
            <tr>
            <?php
            // 7. 총 가로칸 만들기
            for ($j = 0; $j < 7; $j++) {
                // 8. 첫번째 주이고 시작요일보다 $j가 작거나 마지막주이고 $j가 마지막 요일보다 크면 표시하지 않음
                echo '<td height="80" valign="top">';
                if (!(($i == 1 && $j < $start_week) || ($i == $total_week && $j > $last_week))) {

                    if ($j == 0) {
                        // 9. $j가 0이면 일요일이므로 빨간색
                        $style = "holy";
                    } else if ($j == 6) {
                        // 10. $j가 0이면 토요일이므로 파란색
                        $style = "blue";
                    } else {
                        // 11. 그외는 평일이므로 검정색
                        $style = "black";
                    }

                    // 12. 오늘 날짜면 굵은 글씨
                    if ($year == $thisyear && $month == $thismonth && $day == date("j")) {
                        // 13. 날짜 출력
                        echo '<font class='.$style.'>';
                        echo $day;
                        echo '</font>';
                    } else {
                        echo '<font class='.$style.'>';
                        echo $day;
                        echo '</font>';
                    }

                    $sql="SELECT * FROM lec_info WHERE yyy='$year' AND mmm='$month'AND ddd='$day'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($result);

                    if(isset($row)){
                        if($row['umaster_id'] == $_SESSION['id']){
                    ?>
                            <br>
                            <span id='mine'> 내 예약</span>
                    <?php
                        }else{
                    ?>
                            <br>
                            <span id='reserv'> 예약됨</span>
                    <?php
                        }
                    }
                    // 14. 날짜 증가
                    $day++;
                }
                echo '</td>';
            }
            ?>
            </tr>
            <?php } ?>
        </table>
    </div>   
    <script type="text/javascript" src="outcheck.js"></script>
</body>


</html>