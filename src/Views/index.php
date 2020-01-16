<?php if(isset($_SESSION['user'])) : ?>
<header>
    <div id="logo">
        <img src="/images/main_logo.png" alt="main_logo">
    </div>

    <div class="input">
        <input type="text" class="input_search" placeholder="친구, 채널, 태그, 장소 검색">
        <button class="btn_search"></button>
    </div>

</header>

<?php if(isset($_SESSION['user'])) : ?>
    <span><?= $_SESSION['user']->name ?>님</span>
    <a href="/logout">로그아웃</a>
    <a href="/write">글쓰기</a>
<?php else : ?>
    <a href="/login">로그인</a>    
    <a href="/register">회원가입</a>
<?php endif; ?>

<?php 
    else : 
        move("/login", "로그인을 해주세요");
    endif; 
?>
