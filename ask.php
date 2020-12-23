<?php
        $conn = mysqli_connect("localhost", "root", "hj990814", "hsquare");
        session_start();

        $filtered = array(
                'intro' => mysqli_real_escape_string($conn, $_POST['intro']),
                'info' => mysqli_real_escape_string($conn, $_POST['info']),
                'title' => mysqli_real_escape_string($conn, $_POST['title']),
                'theme' => mysqli_real_escape_string($conn, $_POST['theme']),
                'runtime' => mysqli_real_escape_string($conn, $_POST['runtime']),
                'recruit' => mysqli_real_escape_string($conn, $_POST['recruit']),
                'hope' => mysqli_real_escape_string($conn, $_POST['hope']),
                'yyy' => mysqli_real_escape_string($conn, $_POST['yyy']),
                'mmm' => mysqli_real_escape_string($conn, $_POST['mmm']),
                'ddd' => mysqli_real_escape_string($conn, $_POST['ddd']),
        );

        $sql = "INSERT INTO lec_info (intro, info, title, theme, runtime, recruit, hope, yyy, mmm, ddd, umaster_id) 
                VALUES ('{$filtered['intro']}', 
                        '{$filtered['info']}', 
                        '{$filtered['title']}', 
                        '{$filtered['theme']}',
                        '{$filtered['runtime']}',
                        '{$filtered['recruit']}',
                        '{$filtered['hope']}',
                        '{$filtered['yyy']}',
                        '{$filtered['mmm']}',
                        '{$filtered['ddd']}',
                        '{$_POST['umaster_id']}') ";
        $result= mysqli_query($conn, $sql) or die(mysqli_error($conn).$sql);
?>