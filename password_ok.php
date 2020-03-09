<?php
    include "/home/bitnami/amazon-ses-example.php";

    $conn = mysqli_connect(
        'localhost',
        'root',
        'E9LWMIZotVGX1',
        'contest'
    );

    function GenerateString(){
       $characters  = "0123456789";
       $characters .= "abcdefghijklmnopqrstuvwxyz";
       $characters .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
       $characters .= "_";

       $string_generated = "";

       $nmr_loops = 10;
       while ($nmr_loops--){
           $string_generated .= $characters[mt_rand(0, strlen($characters) - 1)];
       }

       return $string_generated;
    }

    $identy = $_POST['id'];
    $name = $_POST['name'];

    $idch = "SELECT * FROM member WHERE id='$identy'";
    $result = mysqli_query($conn, $idch);
    $row = mysqli_fetch_array($result);
    if($row <= 0){
    } else {
        echo "<script>alert('아이디 또는 이름이 잘못되었습니다. 이 알림이 지속되면 관리자에게 연락해주세요.'); history.back();</script>";
        $email = $row['email'];
        $pw = GenerateString();

        $sql = "UPDATE SET pw='{$pw}' WHERE id='{$identy}'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);

        $t = sendEmail($email, $name, $pw);
        if($t == 0){
            echo "<script>alert('오류가 발생했습니다. 다시 시도해주세요. 이 알림이 지속되면 관리자에게 연락해주세요.'); history.back();</script>";
        } else {
?>
    <meta charset="utf-8">
    <script type="text/javascript">alert('등록된 이메일을 확인해주세요. 임시 비밀번호가 발급되었습니다.')</script>
    <meta http-equiv="refresh" content="0 url=login.php">
<?php
        }
    }
?>
