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
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
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
                                if($date >= $now){
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
                             <a href="snsinfo.php" class="dropdown-item">SNS 연동방법</a>
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
         <div class="container">
             <div class="h3 text-center mt-4 mb-4">SNS 추가하는 방법</div>
         </div>
         <div class="container">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-facebook-tab" data-toggle="pill" href="#pills-facebook" role="tab" aria-controls="pills-facebook" aria-selected="true">Facebook</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-twitter-tab" data-toggle="pill" href="#pills-twitter" role="tab" aria-controls="pills-twitter" aria-selected="false">Twitter</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-instagram-tab" data-toggle="pill" href="#pills-instagram" role="tab" aria-controls="pills-instagram" aria-selected="false">Instagram</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-github-tab" data-toggle="pill" href="#pills-github" role="tab" aria-controls="pills-instagram" aria-selected="false">Instagram</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-youtube-tab" data-toggle="pill" href="#pills-youtube" role="tab" aria-controls="pills-instagram" aria-selected="false">Instagram</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-discord-tab" data-toggle="pill" href="#pills-discord" role="tab" aria-controls="pills-discord" aria-selected="false">Discord</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-codeforces-tab" data-toggle="pill" href="#pills-codeforces" role="tab" aria-controls="pills-instagram" aria-selected="false">Instagram</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-atcoder-tab" data-toggle="pill" href="#pills-atcoder" role="tab" aria-controls="pills-instagram" aria-selected="false">Instagram</a>
                </li>
            </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-facebook" role="tabpanel" aria-labelledby="pills-facebook-tab">
                        <ol>
                            <li>PC로 페이스북 접속 호 로그인</li>
                            <li>상단의 자신의 프로필로 접속</li>
                            <li>브라우저에 나타나는 주소를 복사, 붙여넣기</li>
                            <li>주소 형식은 https://www.facebook.com/XXXXXXXX 입니다.</li>
                        </ol>
                    </div>
                    <div class="tab-pane fade" id="pills-twitter" role="tabpanel" aria-labelledby="pills-twitter-tab">
                        <ol>
                            <li>https://twitter.com/ 뒤에 자신의 @를 적으시면 됩니다.</li>
                            <li>예를 들어, 자신의 @이 @AbCdE12345이라면 https://twitter.com/AbCdE12345 처럼 기입하세요.</li>
                        </ol>
                    </div>
                    <div class="tab-pane fade" id="pills-instagram" role="tabpanel" aria-labelledby="pills-instagram-tab">
                        <ol>
                            <li>https://instagram.com/ 뒤에 자신의 Username을 적으시면 됩니다.</li>
                            <li>예를 들어, 자신의 Username이 abcde_12345라면 https://instagram.com/abcde_12345 처럼 기입하세요.</li>
                            <li>자신의 Username은 모바일에서 인스타그램 접속 후, 프로필 영역에 들어갑니다.</li>
                            <li>상단에 자신의 Username이 나와있습니다.</li>
                            <li><img src="img/insta_ex.png" alt="인스타그램 예시" style="height: 50px;"></li>
                        </ol>
                    </div>
                    <div class="tab-pane fade" id="pills-github" role="tabpanel" aria-labelledby="pills-github-tab">
                        <ol>
                            <li>https://github.com/ 뒤에 자신의 닉네임을 적으면 됩니다.</li>
                            <li>예를 들어, 자신의 닉네임이 iamtest라면 https://github.com/iamtest 처럼 기입하세요.</li>
                        </ol>
                    </div>
                    <div class="tab-pane fade" id="pills-youtube" role="tabpanel" aria-labelledby="pills-youtube-tab">
                        <ol>
                            <li>Youtube 접속 후, 구글 아이디로 로그인</li>
                            <li>우측 상단의 자신의 프로필 클릭 후, '내 채널' 클릭</li>
                            <li>브라우저에 나타나는 주소를 복사, 붙여넣기</li>
                        </ol>
                    </div>
                    <div class="tab-pane fade" id="pills-discord" role="tabpanel" aria-labelledby="pills-discord-tab">
                        <ol>
                            <li>Discord 실행 후, 좌측 하단의 자신의 이름 클릭(클릭하면 자동으로 복사됩니다.)</li>
                            <li>그대로 붙여넣기하시면 됩니다.</li>
                            <li>Discord는 따로 URL을 지원하지 않아 프로필에서 클릭시 자신의 콜사인이 알림으로 나오게 됩니다.</li>
                        </ol>
                    </div>
                    <div class="tab-pane fade" id="pills-codeforces" role="tabpanel" aria-labelledby="pills-codeforces-tab">
                        <ol>
                            <li>Codeforces에 접속 후, 자신의 아이디로 로그인</li>
                            <li>우측 상단의 자신의 닉네임 클릭</li>
                            <li>자신의 프로필로 접속되면 브라우저에 나타나는 주소를 복사, 붙여넣기</li>
                        </ol>
                    </div>
                    <div class="tab-pane fade" id="pills-atcoder" role="tabpanel" aria-labelledby="pills-atcoder-tab">
                        <ol>
                            <li>https://atcoder.jp/users/ 뒤에 자신의 Username을 적으시면 됩니다.</li>
                            <li>예를 들어, 자신의 Username이 test라면 https://atcoder.jp/users/test 처럼 기입하세요.</li>
                        </ol>
                    </div>
                </div>
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
