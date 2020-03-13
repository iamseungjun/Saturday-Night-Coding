<?php
    $conn = mysqli_connect(
        'localhost',
        'root',
        'E9LWMIZotVGX',
        'contest'
    );

    $id = $_SESSION['id'];
    $passwd = password_hash($_POST['pw'], PASSWORD_DEFAULT);
    $email = $_POST['email'];

    $sql = "UPDATE member SET pw='{$passwd}', email='{$email}' WHERE id='{$id}'";
    $result = mysqli_query($conn, $sql);
    $_SESSION['id'] = $id;
?>
    <meta charset="utf-8">
    <script type="text/javascript">alert('수정이 완료되었습니다.'); history.back();</script>
