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

    <div class="logout">
        <a href="/logout" style="position: absolute; right: 200px; top: 20px;">로그아웃</a>
        <button id="append" style="position: absolute; right: 300px; top: 20px;">글추가</button>
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
    <div class="posting">
        <div class="write">
            <input type="text" placeholder="<?= $_SESSION['user']->name ?>님의 이야기를 기다리고 있어요.">
            <div class="media">
                <div class="type">
                    <ul>
                        <li>
                            <a href="" class="link_menu">
                                <span class="txt_menu">
                                    <span class="ico camera"></span>
                                    <em>사진/동영상</em>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="" class="link_menu">
                                <span class="txt_menu">
                                    <span class="ico music"></span>
                                    <em>뮤직</em>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="" class="link_menu">
                                <span class="txt_menu">
                                    <span class="ico link"></span>
                                    <em>링크</em>
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <br>
        
    </div>
</div>

<?php 
    else : 
        move("/login", "로그인을 해주세요");
    endif; 
?>
