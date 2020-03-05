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
    <style>
        * { font-family: 'Noto Sans KR', sans-serif; }
    </style
    <title>SNC Contest</title>
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
         <div class="container mt-4 mb-4">&nbsp;</div>
         <?php
             if(isset($_SESSION['id']) && $_SESSION['id']=="bi0416"){
                    ?>
        <div class="container h1 mt-4 mb-4 text-center">관리 페이지</div>
        <div class="container">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">회원관리</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">이의제기관리</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">신청관리</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">일정관리</a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">번호</th>
                                <th scope="col">이름</th>
                                <th scope="col"></th>
                                <th scope="col">아이디</th>
                                <th scope="col">이메일</th>
                                <th scope="col">레이팅</th>
                                <th scope="col">티어</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql = "SELECT * FROM member ORDER BY name";
                                $result = mysqli_query($conn, $sql);

                                $i=1;
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr><th scope=\"row\">".$i."</th><td>".$row['name']."</td><td>".$row['year']."</td><td>".$row['id']."</td><td>".$row['email']."</td><td>".$row['rating']."</td><td>".$row['tier']."</td></tr>";
                                    $i+=1;
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

                </div>
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">

                </div>
            </div>
        </div>
             <?php 
             } else {
                 echo "<div class=\"container mt-4 mb-4\">잘못된 접근입니다.</div>";
             }
         ?>
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
