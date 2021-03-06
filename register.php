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
    <script
      src="https://code.jquery.com/jquery-3.4.1.js"
      integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
      crossorigin="anonymous"></script>
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
         <?php
            if(!isset($_SESSION['id'])){
                ?>
                <div class="container">
                    <h3 class="mt-4 mb-4">
                        회원가입
                    </h3>
                </div>
                <script type="text/javascript">
                    $(document).ready(function(e){
                         $("#identy").on("keyup", function(){
                             var self = $(this);
                             var identy;

                             if(self.attr("id") === "identy"){
                                 identy = self.val();
                             }

                             $.post(
                                 "id_check.php",
                                 { identy : identy },
                                 function(data){
                                     if(data){
                                         self.parent().parent().find("#id-check").html(data);
                                     }
                                 }
                             );
                         });
                    });
                </script>
                <form method="post" action="register_ok.php" name="registerform" id="registerform" class="container">
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label"><span class="text-danger">* </span>아이디</label>
                        <div class="col-sm-10">
                            <input type="text" id="identy" name="identy" style="ime-mode:active;" class="form-control" placeholder="코드업 아이디와 일치시켜 주시기 바랍니다.">
                            <span id="id-check"><span class="text-danger">아이디를 입력하세요.</span</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label"><span class="text-danger">* </span>이름</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" style="ime-mode:disabled;">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label"><span class="text-danger">* </span>기수</label>
                        <div class="col-sm-10">
                            <div class="form-check form-check-inline">
                                <input type="radio" name="year" id="year1" value="1기" class="form-check-input">
                                <label for="year1" class="form-check-label">1기</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="year" id="year2" value="2기" class="form-check-input">
                                <label for="year2" class="form-check-label">2기</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="year" id="yearstaff" value="STAFF" class="form-check-input" disabled>
                                <label for="yearstaff" class="form-check-label">STAFF</label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label"><span class="text-danger">* </span>비밀번호</label>
                        <div class="col-sm-10">
                            <input type="password" name="pw" id="pw1" class="form-control" style="ime-mode:disabled;">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label"><span class="text-danger">* </span>비밀번호 확인</label>
                        <div class="col-sm-10">
                            <input type="password" name="pwch" id="pw2" class="form-control" style="ime-mode:disabled;">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label"><span class="text-danger">* </span>이메일</label>
                        <div class="col-sm-10">
                            <input type="email" name="email" value="" class="form-control" style="ime-mode:disabled;" placeholder="이메일은 비밀번호 찾기에 이용됩니다.">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label"><span class="text-danger">* </span>동의</label>
                        <div class="col-sm-10">
                            <div class="form-check mt-2">
                                <input type="checkbox" class="form-check-input" name="agree" id="agree">
                                <label for="">개인정보 제공에 동의합니다.</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Facebook</label>
                        <div class="col-sm-10">
                            <input type="text" name="facebook" value="" class="form-control" style="ime-mode:disabled;">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Twitter</label>
                        <div class="col-sm-10">
                            <input type="text" name="twitter" value="" class="form-control" style="ime-mode:disabled;">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Instagram</label>
                        <div class="col-sm-10">
                            <input type="text" name="instagram" value="" class="form-control" style="ime-mode:disabled;">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Github</label>
                        <div class="col-sm-10">
                            <input type="text" name="github" value="" class="form-control" style="ime-mode:disabled;">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Youtube</label>
                        <div class="col-sm-10">
                            <input type="text" name="youtube" value="" class="form-control" style="ime-mode:disabled;">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Discord</label>
                        <div class="col-sm-10">
                            <input type="text" name="discord" value="" class="form-control" style="ime-mode:disabled;">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Codeforces</label>
                        <div class="col-sm-10">
                            <input type="text" name="codeforces" value="" class="form-control" style="ime-mode:disabled;">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Atcoder</label>
                        <div class="col-sm-10">
                            <input type="text" name="atcoder" value="" class="form-control" style="ime-mode:disabled;">
                        </div>
                    </div>
                    <div class="col-auto"><span class="text-danger">* 는 필수항목입니다.</span>
                        <button type="submit" id="submit" class="btn btn-primary mt-2">가입하기</button>
                        <a href="snsinfo.php" class="text-primary">SNS 추가하는 방법</a>
                    </div>
                </form>
                <script type="text/javascript">
                    $(document).ready(function(){
                       $("form").submit(function(){
                           var identy = $("input[name='identy']");
                           if(identy.val() == ""){
                               alert("아이디를 입력하세요. 코드업 아이디와 일치시켜 주시기 바랍니다.");
                               identy.focus();
                               return false;
                           }

                           var name = $("input[name='name']");
                           if(name.val() == ""){
                               alert("이름을 입력하세요.");
                               name.focus();
                               return false;
                           }

                           var year = document.getElementsByName('year');
                           var sel_type = null;
                           for(var i=0; i<year.length; i++){
                               if(year[i].checked == true){
                                   sel_type = year[i].value;
                               }
                           }
                           if(sel_type == null){
                               alert("기수를 선택해주세요.");
                               return false;
                           }

                           var pwd1 = $("input[name='pw']");
                           var pwd2 = $("input[name='pwch']");
                           if(pwd1.val() == ""){
                               alert("비밀번호를 입력하세요!");
                               pwd1.focus();
                               return false;
                           }
                           if(pwd1.val().search(/\s/) != -1){
                               alert("비밀번호는 공백 없이 입력해주세요.");
                               pwd1.focus();
                               return false;
                           }
                           if(pwd2.val == ""){
                               alert("비밀번호를 한번 더 입력해주세요.");
                               pwd2.focus();
                               return false;
                           }
                           if(pwd1.val() !== pwd2.val()){
                               alert("비밀번호가 일치하지 않습니다.");
                               pwd2.focus();
                               return false;
                           }
                           if(pwd1.val().length < 8 || pwd1.val().length > 20) {
                               alert("비밀번호는 8~20자 이내로 입력해주세요.");
                               pwd1.focus();
                               return false;
                           }

                           var email = $("input[name='email']");
                           if(email.val() == ''){
                               alert('이메일을 입력하세요');
                               email.focus();
                               return false;
                           } else {
                               var emailRegex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                               if (!emailRegex.test(email.val())) {
                                   alert('이메일 주소가 유효하지 않습니다. 다시 한번 확인해주세요.');
                                   email.focus();
                                   return false;
                               }
                           }

                           if($("input:checkbox[name='agree']").is(":checked") == false) {
                               alert('개인정보 제공에 동의해주세요.');
                               $("input[name='agree']").focus();
                               return false;
                           }

                       });
                    });
                </script>
                <?php
            } else {
                ?>
        <div class="container">
            <span>이미 로그인되어있습니다!</span>
        </div>
                <?php
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
