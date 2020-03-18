<?php
    $conn = mysqli_connect(
        'localhost',
        'root',
        'E9LWMIZotVGX',
        'contest'
    );

    $title = $_POST['title'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $code = $_POST['code'];
    $datetime = "{$date} {$time}";

    $sql = "INSERT INTO plan(title, date, code) VALUES ('".$title."', '".$datetime."', '".$code."')";
    $result = mysqli_query($conn, $sql);
?>
<meta charset="utf-8">
<script type="text/javascript">alert('일정 작성이 완료되었습니다.')</script>
<meta http-equiv="refresh" content="0 url=admin.php">
