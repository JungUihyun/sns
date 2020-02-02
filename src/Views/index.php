<link rel="stylesheet" href="/css/style.css">
<?php 
    if(!isset($_SESSION['user'])) {
        move("/login", "로그인을 해주세요");
    }
?>

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
        <a href="/logout">
            <span class="ti-shift-right" style="position: absolute; right: 50px; top: 20px; cursor: pointer; font-size: 20px;"></span>
        </a>
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
            <span>추천 친구 8</span>
            <div class="friend_list">
                <ul>
                    <?php foreach($recommend_list as $item) { ?>
                    <li>
                        <a href="">
                            <div class="friend_profile">
                                <img src="/images/default_profile.jpg" alt="추천친구 프로필 이미지">
                                <span><?= $item->name ?></span>
                            </div>
                            <div class="recommend_btn">
                                <a href="" class="refuse"><span class="ti-close"></span></a>
                                <a href="" class="accept"><span class="ti-check"></span></a>
                            </div>
                        </a>
                    </li>
                    <?php } ?>
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
    <div class="posting">
        <div class="write">
            <form action="/write" method="post" id="writeForm">
                <textarea id="write_input" name="content" cols="30" rows="10" placeholder="<?= $_SESSION['user']->name ?>님의 이야기를 기다리고 있어요."></textarea>
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
                    <input type="reset" id="cancel" value="취소">
                    <input type="submit" value="올리기" id="post">
                    <!-- <button id="cancel">취소</button> -->
                    <!-- <button id="post" >올리기</button> -->
                </div>
            </form>
        </div>
        <br>
        <?php foreach($list as $item) { ?>
            <div class="section">
                <div class="post_profile">
                    <img src="/images/default_profile.jpg" alt="기본 프로필 이미지">
                    <div class="post_info">
                        <span class="writer"><?= $item->writer ?></span>
                        <span class="time"><?= $item->date ?></span>
                    </div>
                </div>
                <div class="post_content"><?= $item->content ?></div>
                <div class="btnList">
                    <span id="section_idx"><?= $item->id ?></span>
                    <button class="modify">수정</button>
                    <!-- <a class="modify" href="/modify?id=<?= $item->id ?>">수정</a> -->
                    <a href="/delete?id=<?= $item->id ?>">삭제</a>
                </div>
                <div class="comment">
                    <div class="comment_list">
                        <ul>
                            <?php foreach($comment_list as $item2) { ?>
                                <li>
                                    <div class="comment_profile">
                                        <div class="comment_info">
                                            <img src="/images/default_profile.jpg" alt="댓글 기본 프로필 이미지">
                                            <span><?= $item2->writer ?></span>
                                        </div>
                                    </div>
                                    <div class="comment_content">
                                        <?= $item2->content ?>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <form action="/comment_write" method="post">
                        <div class="comment_input">
                            <input type="text" name="comment_" class="comment_" placeholder="댓글을 입력하세요">
                            <div class="comment_icon">
                                <span class="ti-image"></span>
                                <span class="ti-face-smile"></span>
                            </div>
                        </div>
                        <input type="submit" class="comment_post" value="전송">
                    </form>
                </div>
            </div>
            <br>
        <?php } ?>
    </div>
</div>

<div class="cover_wrapper">
    <div class="modify_write">
        <textarea name="modify_input" id="modify_input" cols="30" rows="10" placeholder="<?= $_SESSION['user']->name ?>님의 이야기를 기다리고 있어요."></textarea>
            <div class="btn_group">
                <button id="modify_cancel">취소</button>
                <a href="/modify?id=<?= $item->id ?>" id="modify_post">올리기</a>
                <!-- <button id="modify_post">올리기</button> -->
            </div>
    </div>
</div>

<script>
    // dateFormat(dateString);

    // function dateFormat(dateString) {
    //     let date = new Date(dateString);
    //     return date;
    // }
</script>