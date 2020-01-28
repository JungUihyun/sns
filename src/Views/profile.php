<link rel="stylesheet" href="/css/profile.css">

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
    <div class="container_wrap">
        <div class="bg"></div>
        <div class="myStory">
            <div class="name">
                <img src="/images/default_profile.jpg" alt="프로필 사진">
                <span><?= $_SESSION['user']->name ?></span>
            </div>
            <div class="menu_story">
                <ul>
                    <li>전체</li>
                    <li>캘린더</li>
                    <li>사진</li>
                    <li>동영상</li>
                    <li>장소</li>
                    <li>뮤직</li>
                    <li>더보기</li>
                </ul>
            </div>
        </div>
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
</body>
</html>