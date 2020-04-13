<?php
    session_start();
    $conn = mysqli_connect(
        'localhost',
        'root',
        'E9LWMIZotVGX',
        'contest'
    );
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR:500&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7cc77c19eb.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <title>SNC Contest</title>
    <style media="screen">
        * {
            font-family: 'Noto Sans KR', sans-serif;
        }
        .introduce-link a:hover {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <header>
         <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
             <a href="index.php" class="navbar-brand">Saturday Night Coding</a>
             <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                 <span class="navbar-toggler-icon"></span>
             </button>
             <div class="collapse navbar-collapse" id="navbarSupportedContent">
                 <ul class="navbar-nav mr-auto">
                     <li class="nav-item dropdown">
                         <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             순위현황
                         </a>
                         <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                             <a href="#" class="dropdown-item">시즌 배치 결과</a>
                             <a href="#" class="dropdown-item" disabled>Bronze</a>
                             <a href="#" class="dropdown-item" disabled>Silver</a>
                             <a href="#" class="dropdown-item" disabled>Gold</a>
                         </div>
                     </li>
                     <li class="nav-item">
                         <a href="dailyresult.php" class="nav-link">오늘의 대회 결과</a>
                     </li>
                     <li class="nav-item">
                         <a href="notice.php" class="nav-link">공지사항
                             <?php
                                $sql = "SELECT * FROM notice ORDER BY date DESC LIMIT 1";
                                $result = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_array($result);
                                $date = $row['date'];
                                $date = strtotime($date.'+7 days');
                                $now = strtotime("NOW");
                                if($date <= $now && !empty($row)){
                                    echo "&nbsp;<span class=\"badge badge-danger\">NEW</span>";
                                }
                             ?></a>
                     </li>
                     <li class="nav-item dropdown">
                         <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             Q&amp;A
                         </a>
                         <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                             <a href="introduce.php" class="dropdown-item">대회안내</a>
                             <a href="book.php" class="dropdown-item">코드업 사용방법</a>
                         </div>
                     </li>
                     <li class="nav-item dropdown">
                         <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             관리
                         </a>
                         <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                             <a href="introduce.php" class="dropdown-item">관리자 소개</a>
                             <a href="book.php" class="dropdown-item">관리자가 추천하는 책</a>
                             <a href="application.php" class="dropdown-item">관리자 신청하기</a>
                         </div>
                     </li>
                     <li class="nav-item">
                         <a href="exception.php" class="nav-link">이의제기</a>
                     </li>
                 </ul>
                 <ul class="navbar-nav ml-auto">
                     <?php
                        if(isset($_SESSION['id'])){
                            echo "<li class=\"nav-item\"><a href=\"profile.php?id={$_SESSION['id']}\" class=\"nav-link\">프로필</a></li>";
                            echo "<li class=\"nav-item\"><a href=\"modify.php\" class=\"nav-link\">정보수정</a></li>";
                            echo "<li class=\"nav-item\"><a href=\"logout.php\" class=\"nav-link\">로그아웃</a></li>";
                        } else {
                            echo "<li class=\"nav-item\"><a href=\"register.php\" class=\"nav-link\">회원가입</a></li>";
                            echo "<li class=\"nav-item\"><a href=\"login.php\" class=\"nav-link\">로그인</a></li>";
                        }
                     ?>
                 </ul>
             </div>
         </nav>
     </header>
     <main role="main">
         <div class="container mt-4">
             <?php
                 $id = $_GET['id'];

                 $conn = mysqli_connect(
                     'localhost',
                     'root',
                     'E9LWMIZotVGX',
                     'contest'
                 );
                 $sql = "SELECT * FROM member WHERE id='$id'";
                 $result = mysqli_query($conn, $sql);
                 $row = mysqli_fetch_array($result);
                 $year = $row['year'];
                 $name = $row['name'];
                 $tier = $row['tier'];
                 if(!empty($id) && !empty($row)){
                     if($tier == 'Admin') {
                         $color = "#FF0000";
                     } else if($tier == 'Gold') {
                         $color = "#FFD700";
                     } else if($tier == 'Silver') {
                         $color = "#C0C0C0";
                     } else if($tier == 'Bronze') {
                         $color = "#CD7F32";
                     } else {
                         $color = "#808080";
                     }
             ?>
             <div class="container">
                 <?php
                    // echo $id;
                    echo "<h2 style=\"color:$color\">$year - $name</h2>";
                ?>
                <span style="color: #555555">
                <?php
                    if(!empty($row['facebook'])){ echo "<a href=\"{$row['facebook']}\" target=\"_blank\"><i class=\"fab fa-facebook-square\"></i></a> "; }
                    if(!empty($row['twitter'])){ echo "<a href=\"{$row['twitter']}\" target=\"_blank\"><i class=\"fab fa-twitter-square\"></i></a> "; }
                    if(!empty($row['instagram'])){ echo "<a href=\"{$row['instagram']}\" target=\"_blank\"><i class=\"fab fa-instagram-square\"></i></a> "; }
                    if(!empty($row['github'])){ echo "<a href=\"{$row['github']}\" target=\"_blank\"><i class=\"fab fa-github-square\"></i></a> "; }
                    if(!empty($row['youtube'])){ echo "<a href=\"{$row['youtube']}\" target=\"_blank\"><i class=\"fab fa-youtube-square\"></i></a> "; }
                    if(!empty($row['discord'])){ echo "<span data-toggle=\"tooltip\" data-placement=\"top\" title=\"{$row['discord']}\"><i class=\"fab fa-discord\"></i></span> "; }
                    if(!empty($row['codeforces'])){ echo "<a href=\"{$row['codeforces']}\" target=\"_blank\"><img src=\"img/codeforces.svg\" alt=\"codeforces\"></a> "; }
                    if(!empty($row['atcoder'])){ echo "<a href=\"{$row['atcoder']}\" target=\"_blank\"><img src=\"img/atcoder.png\" alt=\"atcoder\"></a> "; }
                 ?>
                 </span>
                 <?php echo "<a href=\"https://codeup.kr/userinfo.php?user=$id\" class=\"text-secondary\">- $id</a>"; ?>
             </div>
             <script>
                 $(function(){
                    $('[data-toggle="tooltip"]').tooltip();
                 });
             </script>
             <div id="chart" class="container" style="height: 500px; width: 100%;">
                 <?php
                    if($tier == 'Admin' || $tier == 'Skill'){
                        echo "레이팅이 없는 사용자입니다.";
                    } else if($tier == 'Unranked'){
                        echo "아직 배치가 끝나지 않았거나 대회에 참여하지 않았습니다.";
                    } else {
                ?>
                 <script>
                     google.charts.load('current', {'packages' : ['corechart']});
                     google.charts.setOnLoadCallback(drawChart);

                     function drawChart(){
                         var data = google.visualization.arrayToDataTable([
                             ['날짜', '레이팅'],
                             <?php
                                $sql = "SELECT * FROM rating WHERE id='{$id}' ORDER BY date DESC";
                                $result = mysqli_query($conn, $sql);
                                while($row = mysqli_fetch_array($result)){
                                    $date = strtotime($row['date']);
                                    echo "['".date('Y-m-d', $date)."', '".$row['rating']."'],\n";
                                }
                             ?>
                         ]);

                         var options = {
                            title :  '레이팅 현황',
                            legend : {position: 'top', alignment: 'center'},
                            animation : {
                                startup : true,
                                duration : 4000,
                                easing : 'inAndOut'
                            },
                            chartArea : {
                                width : '90%',
                                height : '50%'
                            },
                            pointsVisible : 'True',
                            colors : ['green']
                         };

                        var chart = new google.visualization.LineChart(document.getElementById('chart'));

                        chart.draw(data, options);
                     }
                 </script>
                 <?php
                     }
                  ?>
             </div>
         <?php
             } else {
                 echo "잘못된 사용자입니다!";
             }
         ?>
         </div>
     </main>
     <hr>
     <footer class="container">
         <h6 class="text-center mt-2">
             COPYRIGHT &copy; 2020~ SeungJun Lee
             <br>
             All Rights Reserved
         </h6>
     </footer>
</body>
</html>
