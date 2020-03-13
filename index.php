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
    <title>SNC Contest</title>
    <style media="screen">
        * {
            font-family: 'Noto Sans KR', sans-serif;
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
                             <a href="#" class="dropdown-item">Bronze</a>
                             <a href="#" class="dropdown-item">Silver</a>
                             <a href="#" class="dropdown-item">Gold</a>
                         </div>
                     </li>
                     <li class="nav-item">
                         <a href="dailyresult.php" class="nav-link">오늘의 대회 결과</a>
                     </li>
                     <li class="nav-item">
                         <a href="notice.php" class="nav-link">공지사항</a>
                     </li>
                     <li class="nav-item">
                         <a href="contestinfo.php" class="nav-link">대회안내</a>
                     </li>
                     <li class="nav-item dropdown">
                         <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             관리자가 추천하는 것들
                         </a>
                         <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                             <a href="introduce.php" class="dropdown-item">관리자 소개</a>
                             <a href="book.php" class="dropdown-item">관리자가 추천하는 책</a>
                             <a href="#" class="dropdown-item">관리자가 추천하는 코딩 공부법</a>
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
         <div class="container text-center">
             <div class="h3 mt-4 mb-4">다음 대회</div>
             <div class="jumbotron">
                 <p class="lead">1시즌 1차 배치</p>
                 <p class="lead">2020-05-09 19:00:00</p>
                 <h1 class="display-4" id="demo">&nbsp;</h1>
                 <script type="text/javascript">
                     var day= "May 9, 2020 19:00:00";
                     var x = setInterval(function() {
                         var now = new Date().getTime();
                         var then = new Date(day).getTime();
                         var gap = then - now;
                         var days = Math.floor(gap / (1000 * 60 * 60 * 24));
                         var hou = Math.floor((gap % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                         var min = Math.floor((gap % (1000 * 60 * 60)) / (1000 * 60));
                         var sec = Math.floor((gap % (1000 * 60)) / 1000);
                         hou = (hou < 10) ? "0" + hou : hou;
                         min = (min < 10) ? "0" + min : min;
                         sec = (sec < 10) ? "0" + sec : sec;
                         var result = "D-" + days + " " + hou + ":" + min + ":" + sec;
                         document.getElementById("demo").innerHTML = result;
                     }, 1000);
                 </script>
             </div>
         </div>
         <div class="container">
             <div class="h3 text-center mt-4 mb-4">
                 지난 대회의 결과
             </div>
             <div class="card-group">
                 <div class="card">
                     <div class="card-body">
                         <h5 class="card-title text-center">Bronze</h5>
                         <div class="card-text">
                             <div class="row">
                                 <p class="ml-3">1기_이승준</p>
                                 <p class="ml-auto mr-3">2,650</p>
                             </div>
                             <div class="row">
                                 <p class="ml-3">1기_이승준</p>
                                 <p class="ml-auto mr-3">2,650</p>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="card">
                     <div class="card-body">
                         <h5 class="card-title text-center">Silver</h5>
                         <div class="card-text">
                             <div class="row">
                                 <p class="ml-3">1기_이승준</p>
                                 <p class="ml-auto mr-3">2,650</p>
                             </div>
                             <div class="row">
                                 <p class="ml-3">1기_이승준</p>
                                 <p class="ml-auto mr-3">2,650</p>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="card">
                     <div class="card-body">
                         <h5 class="card-title text-center">Gold</h5>
                         <div class="card-text">
                             <div class="row">
                                 <p class="ml-3">1기_이승준</p>
                                 <p class="ml-auto mr-3">2,650</p>
                             </div>
                             <div class="row">
                                 <p class="ml-3">1기_이승준</p>
                                 <p class="ml-auto mr-3">2,650</p>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <div class="container">
             <div class="h3 text-center mt-4 mb-4">
                 TOP 5
             </div>
             <div class="card-group">
                 <div class="card">
                     <div class="card-body">
                         <h5 class="card-title text-center">Bronze</h5>
                         <div class="row">
                             <p class="ml-3">1기_이승준</p>
                             <p class="ml-auto mr-3">2,650</p>
                         </div>
                         <div class="row">
                             <p class="ml-3">1기_이승준</p>
                             <p class="ml-auto mr-3">2,650</p>
                         </div>
                     </div>
                 </div>
                 <div class="card">
                     <div class="card-body">
                         <h5 class="card-title text-center">Silver</h5>
                         <div class="card-text">
                             <div class="row">
                                 <p class="ml-3">1기_이승준</p>
                                 <p class="ml-auto mr-3">2,650</p>
                             </div>
                             <div class="row">
                                 <p class="ml-3">1기_이승준</p>
                                 <p class="ml-auto mr-3">2,650</p>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="card">
                     <div class="card-body">
                         <h5 class="card-title text-center">Gold</h5>
                         <div class="card-text">
                             <div class="row">
                                 <p class="ml-3">1기_이승준</p>
                                 <p class="ml-auto mr-3">2,650</p>
                             </div>
                             <div class="row">
                                 <p class="ml-3">1기_이승준</p>
                                 <p class="ml-auto mr-3">2,650</p>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <div class="container mb-4">
             <div class="h3 text-center mt-4 mb-4">
                 Ban List
             </div>
             <div class="card-group">
                 <div class="card">
                     <div class="card-body">
                         <h5 class="card-title text-center">주최자</h5>
                         <div class="card-text text-center">
                             <?php
                                 $sql = "SELECT * FROM member WHERE tier='Admin'";
                                 $result = mysqli_query($conn, $sql);
                                 while($row = mysqli_fetch_array($result)){
                                     echo "<p>".$row['year']."-".$row['name']."</p>";
                                 }
                             ?>
                         </div>
                     </div>
                 </div>
                 <div class="card">
                     <div class="card-body">
                         <h5 class="card-title text-center">기능반</h5>
                         <div class="card-text text-center">
                             <?php
                                 $sql = "SELECT * FROM member WHERE tier='Skill'";
                                 $result = mysqli_query($conn, $sql);
                                 while($row = mysqli_fetch_array($result)){
                                     echo "<p>".$row['year']."-".$row['name']."</p>";
                                 }
                             ?>
                         </div>
                     </div>
                 </div>
                 <div class="card">
                     <div class="card-body">
                         <h5 class="card-title text-center">치팅</h5>
                         <div class="card-text text-center">
                             <?php
                                 $sql = "SELECT * FROM member WHERE tier='Cheat'";
                                 $result = mysqli_query($conn, $sql);
                                 while($row = mysqli_fetch_array($result)){
                                     echo "<p>".$row['year']."-".$row['name']."</p>";
                                 }
                             ?>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </main>
     <hr class="mt-4 mb-4">
     <footer class="container">
         <h6 class="text-center mt-2">
             COPYRIGHT &copy; 2020~ SeungJun Lee
             <br>
             All Rights Reserved
         </h6>
     </footer>
</body>
</html>
