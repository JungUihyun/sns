<link rel="stylesheet" href="/css/style.css">
<?php if(isset($_SESSION['user'])) : ?>
<header>
    <div id="logo">
        <img src="/images/main_logo.png" alt="main_logo">
    </div>

    <div class="input">
        <input type="text" class="input_search" placeholder="친구, 채널, 태그, 장소 검색">
        <button class="btn_search">
            <i class="far fa-search"></i>
        </button>
    </div>

</header>

<div id="side">
    <div class="profile">
        <a href="/profile" class="link_img">
            <img src="/images/default_profile.jpg" alt="profile_img">
        </a> 
        <a href="/profile" class="link_name"><?= $_SESSION['user']->name ?></a>
    </div>

    <!-- <div class="friend">
        <ul>
            <li><a href="/friend">친구</a></li>
            <li><a href="/friend">신청</a></li>
            <li><a href="/friend">쪽지</a></li>
        </ul>
    </div> -->
</div>

<div class="container">
    <div class="section">
        
    </div>
</div>

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
