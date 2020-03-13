<?php
    $conn = mysqli_connect(
        'localhost',
        'root',
        'E9LWMIZotVGX',
        'contest'
    );

    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "SELECT * FROM notice WHERE title='$title'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    if($row >= 1){
        $sql = "UPDATE notice SET content='$content', date=NOW() WHERE title='$title'";
        $result = mysqli_query($conn, $sql);
    } else {
        $sql = "INSERT INTO notice(title, content, date) VALUES('".$title."', '".$content."', NOW())";
        $result = mysqli_query($conn, $sql);
    }
?>
<meta charset="utf-8">
<script type="text/javascript">alert('공지사항 작성이 완료되었습니다.')</script>
<meta http-equiv="refresh" content="0 url=admin.php">
