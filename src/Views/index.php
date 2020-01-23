<link rel="stylesheet" href="/css/style.css">
<?php if(isset($_SESSION['user'])) : ?>
<header>
    <div id="logo">
        <img src="/images/main_logo.png" alt="main_logo">
    </div>

    <div class="input">
        <input type="text" class="input_search" placeholder="친구, 채널, 태그, 장소 검색">
        <button class="btn_search">
            <span class="ti-search"></span>
        </button>
    </div>

    <div class="logout">
        <a href="/logout" style="position: absolute; right: 200px; top: 20px;">로그아웃</a>
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
            <textarea name="write_input" id="write_input" cols="30" rows="10" placeholder="<?= $_SESSION['user']->name ?>님의 이야기를 기다리고 있어요."></textarea>
            <div class="media">
                <div class="type">
                    <ul>
                        <li>
                            <a href="" class="link_menu">
                                <span class="txt_menu">
                                    <span class="ico ti-camera"></span>
                                    <em>사진/동영상</em>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="" class="link_menu">
                                <span class="txt_menu">
                                <span class="ico ti-music-alt"></span>
                                    <em>뮤직</em>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="" class="link_menu">
                                <span class="txt_menu">
                                    <span class="ico ti-link"></span>
                                    <em>링크</em>
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="btn_group">
                <button id="cancel">취소</button>
                <button id="post">올리기</button>
            </div>
        </div>
        <br>
        <div class="section">
            <div class="btnList">
                <button class="modify">수정</button>
                <button class="delete">삭제</button>
            </div>
        </div>
        <br>
    </div>
</div>
<div class="cover_wrapper">
    <div class="modify_write">
        <textarea name="modify_input" id="modify_input" cols="30" rows="10" placeholder="<?= $_SESSION['user']->name ?>님의 이야기를 기다리고 있어요."></textarea>
            <div class="btn_group">
                <button id="modify_cancel">취소</button>
                <button id="modify_post">올리기</button>
            </div>
    </div>
</div>

<?php 
    else : 
        move("/login", "로그인을 해주세요");
    endif; 
?>
