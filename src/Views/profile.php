<link rel="stylesheet" href="/css/profile.css">

<header>
    <div id="logo">
        <a href="/">
            <img src="/images/main_logo.png" alt="main_logo">
        </a>
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

    <div class="side_button">
        <ul>
            <li><a href="javascript:return false;" id="friend">친구</a></li>
            <li><a href="javascript:return false;" id="recommend">추천</a></li>
            <li><a href="javascript:return false;" id="note">쪽지</a></li>
        </ul>
    </div>
    <div class="side_content">
        <div class="friend content">
            <span>내 친구 [숫자]</span>
            <div class="friend_list">
                <ul>
                    <!-- foreach -->
                    <li>
                        <a href="">
                            <div class="friend_profile">
                                <img src="/images/default_profile.jpg" alt="내 친구 프로필 이미지">
                                <span>이름</span>
                            </div>
                        </a>
                    </li>
                    <!-- foreach End -->
                </ul>
            </div>
        </div>
        <div class="recommend content">
            <span>추천 친구 [숫자]</span>
            <div class="friend_list">
                <ul>
                    <!-- foreach -->
                    <li>
                        <a href="">
                            <div class="friend_profile">
                                <img src="/images/default_profile.jpg" alt="추천친구 프로필 이미지">
                                <span>이름</span>
                            </div>
                        </a>
                    </li>
                    <!-- foreach End -->
                </ul>
            </div>
        </div>
        <div class="note content">
            <div class="note_button">
                <a href="">새 쪽지 작성</a>
            </div>
        </div>
    </div>
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
    <div class="asd">
        <div class="myPost">
            <?php foreach($list as $item) { ?>
                <div class="section">
                    <div class="post_profile">
                        <img src="/images/default_profile.jpg" alt="기본 프로필 이미지">
                        <div class="post_info">
                            <span><?= $item->writer ?></span>
                            <span><?= $item->date ?></span>
                        </div>
                    </div>
                    <div class="post_content"><?= $item->content ?></div>
                    <div class="btnList">
                        <button class="modify">수정</button>
                        <button class="delete">삭제</button>
                    </div>
                    <div class="comment">
                        <div class="comment_input">
                            <input type="text" placeholder="댓글을 입력하세요">
                            <div class="comment_icon">
                                <span class="ti-image"></span>
                                <span class="ti-face-smile"></span>
                            </div>
                        </div>
                        <a href="" class="comment_post">전송</a>
                    </div>
                </div>
                <br>
            <?php } ?>
        </div>
        <div class="widget">
            <div class="widget_info">
                <h3>정보</h3>
            </div>
            <div class="widget_friend">
                <h3>추천친구</h3>
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