<?php 
if(isset($_SESSION['user'])) {
    move("/", "로그인 중입니다.");
} 
?>

<link rel="stylesheet" href="/css/register.css">
<div class="container">
    <div id="logo">
        <img src="/images/black_logo.png" alt="logo">
    </div>

    <div class="formBox">
        <h3>계정 정보를 입력해주세요</h3>
        <form action="/register" method="post" class="form" enctype="multipart/form-data">
            <p>계정 아이디</p>
            <input type="text" name="id" autocomplete=”off” placeholder="아이디 입력">
            <p>비밀번호</p>
            <input type="password" name="password" placeholder="비밀번호(8~32자리)">
            <input type="password" name="passwordc" placeholder="비밀번호 재입력">

            <p>이름</p>
            <input type="text" name="name" placeholder="이름을 입력해주세요">

            <p style="margin-top: 30px; margin-bottom: 20px">프로필 사진</p>
            <input type="file" name="upProfile[]" class="upProfile">
            <!-- <input type="file" name="upImage[]" class="upProfile"> -->

            <input class="btn" type="submit" value="회원가입">
        </form>
    </div>

</div>