<?php
    if($_POST['identy'] != NULL){
        $conn = mysqli_connect(
            'localhost',
            'root',
            'E9LWMIZotVGX',
            'contest'
        );

        $sql = "SELECT * FROM application WHERE id='{$_POST['identy']}'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);

        echo "DATA TEST !!!!!!!!!! PLZ\n";
        echo "<ol><li>".$row['content1']."</li><li>".$row['content2']."</li><li>".$row['content3']."</li><li>".$row['content4']."</li><li>".$row['content5']."</li><li>".$row['content6']."</li><li>".$row['content7']."</li></ol>";
    }
?>
