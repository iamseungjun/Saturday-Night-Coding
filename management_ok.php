<?php
    $conn = mysqli_connect(
        'localhost',
        'root',
        'E9LWMIZotVGX',
        'contest'
    );

    $identy = $_POST['identy'];
    $name = $_POST['name'];
    $year = $_POST['year'];
    $email = $_POST['email'];
    $rating = $_POST['rating'];
    $tier = $_POST['tier'];

    $sql = "UPDATE member SET id='{$identy}', name='{$name}', year='{$year}', email='{$email}', rating='{$rating}', tier='{$tier}' WHERE id='{$identy}'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
?>
<meta charset="utf-8">
<script type="text/javascript">alert('수정 완료'); history.back();</script>
