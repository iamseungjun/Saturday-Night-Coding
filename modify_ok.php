<?php
    $conn = mysqli_connect(
        'localhost',
        'root',
        'E9LWMIZotVGX',
        'contest'
    );

    $name = $_POST['name'];
    $passwd = password_hash($_POST['pw'], PASSWORD_DEFAULT);
    $email = $_POST['email'];

    $sql = "UPDATE member SET pw='{$password}', email='{$email}' WHERE name='{$name}'";
    $result = mysqli_query($conn, $sql);
?>
    <meta charset="utf-8">
    <script type="text/javascript">alert('수정이 완료되었습니다.'); history.back();</script>
