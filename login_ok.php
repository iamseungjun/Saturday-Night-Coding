<meta charset="utf-8">
<?php
    if($_POST["id"] == ""){
        echo '<script>alert("아이디를 입력해주세요."); history.back();</script>';
    } else {
        $id = $_POST['id'];
        $pw = $_POST['pw'];

        $conn = mysqli_connect(
            'localhost',
            'root',
            'E9LWMIZotVGX',
            'contest'
        );
        $sql = "SELECT * FROM member WHERE id='$id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        $hash = $row['pw'];
        if(password_verify($pw, $hash)){
            $_SESSION['id'] = $id;
            $ip = $_SERVER['REMOTE_ADDR'];
            $sql = "INSERT INTO accesslog(ip, date, id) VALUES ('$ip', NOW(), '$id')";
            $result = mysqli_query($conn, $sql);
            echo "<script>location.href='index.php';</script>";
        } else {
            echo '<script>alert("아이디 혹은 비밀번호가 잘못되었습니다."); history.back();</script>';
        }
    }
?>
