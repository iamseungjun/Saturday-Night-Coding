<?php
    $conn = mysqli_connect(
        'localhost',
        'root',
        'E9LWMIZotVGX',
        'contest'
    );

    $sql = "DELETE FROM member WHERE id='{$_GET['id']}'";
    $result = mysqli_query($conn, $sql);
?>
<meta charset="utf-8">
<script type="text/javascript">alert('삭제 완료'); location.href = "admin.php"; </script>
