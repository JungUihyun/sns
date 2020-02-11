<link rel="stylesheet" href="/css/profile.css">

<?php 
    if(!isset($_SESSION['user'])) {
        move("/login", "로그인을 해주세요");
    }
?>

<header>
    <div class="write" style="display: none;"></div>
    <div class="drop-list" style="display: none;"></div>
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
        <a href="/profile?idx=<?= $_SESSION['user']->idx ?>" class="link_img">
            <img src="/images/default_profile.jpg" alt="profile_img">
        </a> 
        <a href="/profile?idx=<?= $_SESSION['user']->idx ?>" class="link_name"><?= $_SESSION['user']->name ?></a>
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
            <span>친구 요청 <span id="recommend_cnt"><?= $question_cnt ?></span></span>
            <div class="friend_list">
                <ul>
                    <?php foreach($question_list as $item) { ?>
                        <li>
                            <div class="friend_profile" onclick="location.href='/profile?idx=<?= $item->idx ?>'">
                                <form action="/friend/receive" method="post">
                                    <input type="hidden" value="<?= $item->idx ?>" name="question_qidx">
                                    <?php if($item->p_img) { ?>
                                        <img src="<?= $item->p_img ?>" alt="내 친구 프로필 이미지">
                                    <?php } else { ?>
                                        <img src="/images/default_profile.jpg" alt="내 친구 프로필 이미지">
                                    <?php } ?>
                                    <span><?= $item->name ?></span>
                                    <div class="recommend_btn">
                                        <span class="refuse ti-close"><a href="/friend/refuse"></a></span>
                                        <span class="ti-check"><input type="submit" value="" class="accept recommend_submit"></span>
                                    </div>
                                </form>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <span>내 친구 <span id="recommend_cnt"><?= $friend_cnt ?></span></span>
            <div class="friend_list">
                <ul>
                    <?php foreach($friend_list as $item) { ?>
                        <li>
                            <div class="friend_profile" onclick="location.href='/profile?idx=<?= $item->idx ?>'">
                                <form>
                                    <?php if($item->p_img) { ?>
                                        <img src="<?= $item->p_img ?>" alt="내 친구 프로필 이미지">
                                    <?php } else { ?>
                                        <img src="/images/default_profile.jpg" alt="내 친구 프로필 이미지">
                                    <?php } ?>
                                    <span><?= $item->name ?></span>
                                    <div class="recommend_btn">
                                        <span class="refuse ti-close"><a href="/friend/friend_delete?idx=<?= $item->idx ?>"></a></span>
                                        <input type="submit" value="" class="accept recommend_submit"><span class="ti-check"></span>
                                    </div>
                                </form>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="recommend content">
            <span>보낸 신청 <span id="send_cnt"><?= $send_cnt ?></span></span>
            <div class="friend_list">
                <ul>
                    <?php foreach($send_list as $item) { ?>
                    <li>
                        <div class="friend_profile" onclick="location.href='/profile?idx=<?= $item->idx ?>'">
                            <form>
                                <?php if($item->p_img) { ?>
                                    <img src="<?= $item->p_img ?>" alt="내 친구 프로필 이미지">
                                <?php } else { ?>
                                    <img src="/images/default_profile.jpg" alt="내 친구 프로필 이미지">
                                <?php } ?>
                                <input type="hidden" value="<?= $item->idx ?>" name="ridx">
                                <span><?= $item->name ?></span>
                                <div class="recommend_btn">
                                    <span class="sended ti-close"><a href="/friend/send_cancel?ridx=<?= $item->idx ?>" class="send_cancel refuse"></a></span>
                                </div>
                            </form>
                        </div>
                    </li>
                    <?php } ?>
                </ul>
            </div>
            <span>추천 친구 <span id="recommend_cnt"><?= $recommend_cnt ?></span></span>
            <div class="friend_list">
                <ul>
                    <?php foreach($recommend_list as $item) { ?>
                        <?php if($item->idx != user()->idx) { ?>
                            <li>
                                <div class="friend_profile" onclick="location.href='/profile?idx=<?= $item->idx ?>'">
                                    <form action="/friend/question" method="post">
                                        <?php if($item->p_img) { ?>
                                            <img src="<?= $item->p_img ?>" alt="내 친구 프로필 이미지">
                                        <?php } else { ?>
                                            <img src="/images/default_profile.jpg" alt="내 친구 프로필 이미지">
                                        <?php } ?>
                                        <input type="hidden" value="<?= $item->idx ?>" name="ridx">
                                        <span><?= $item->name ?></span>
                                        <div class="recommend_btn">
                                            <span class="refuse ti-close"></span>
                                            <span class="ti-check"><input type="submit" value="" class="accept recommend_submit"></span>
                                        </div>
                                    </form>
                                </div>
                            </li>
                        <?php } ?>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="note content">
            <div class="note_button">
                <a href="javascript:return false;" class="open_message">새 쪽지 작성</a>
            </div>
            <span>보낸 쪽지함 <span id="send_msg_cnt"><?= $send_msg_cnt ?></span></span>
            <div class="message_list first_list">
                <ul>
                    <?php foreach($send_msg_list as $item) { ?>
                        <li>
                            <a href="javascript:return false;" class="show_msg">
                                <div class="send_profile">
                                    <form>
                                        <img src="/images/default_profile.jpg" alt="보낸 쪽지함 프로필 이미지">
                                        <input type="hidden" value="<?= $item->content ?>" name="content" class="msg_content">
                                        <input type="hidden" value="<?= $item->receiver ?>" class="msg_receiver">
                                        <div class="send_info">
                                            <span><?= $item->receiver ?></span>
                                            <span class="send_date"><?= $item->date ?></span>
                                        </div>
                                    </form>
                                </div>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <span>받은 쪽지함 <span id="receive_msg_cnt"><?= $receive_msg_cnt ?></span></span>
            <div class="message_list second_list">
                <ul>
                    <?php foreach($receive_msg_list as $item) { ?>
                        <li>
                            <div class="send_profile">
                                <form>
                                    <img src="/images/default_profile.jpg" alt="받은 쪽지함 프로필 이미지">
                                    <input type="hidden" value="<?= $item->content ?>" name="content" class="msg_content">
                                    <input type="hidden" value="<?= $item->writer ?>" class="msg_writer">
                                    <div class="send_info">
                                        <span><?= $item->writer ?></span>
                                        <span class="send_date"><?= $item->date ?></span>
                                    </div>
                                </form>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="container_wrap">
        <div class="bg"></div>
        <div class="myStory" style="background-image: url(<?= $background_image->b_img ?>);">
            <div class="name">
                <img src="/images/default_profile.jpg" alt="프로필 사진">
                <?php if($name->name == $_SESSION['user']->name) { ?>
                    <div class="profile_image">
                        <input type="file" name="userProfile">
                        <i class="fas fa-camera"></i>
                    </div>
                <?php } ?>
                <span><?= $name->name ?></span>
            </div>
            <div class="menu_story">
                <ul>
                    <li class="active">전체</li>
                    <li>캘린더</li>
                    <li>사진</li>
                    <li>동영상</li>
                    <li>장소</li>
                    <li>뮤직</li>
                    <li>더보기</li>
                </ul>
            </div>
            <?php if($name->name == $_SESSION['user']->name) { ?>
            <div class="bg_change">
                <label for="bg_change">배경 화면 편집</label>
                <input type="file" id="bg_change" name="bg_change">
            </div>
            <?php } ?>
        </div>
    </div>
    <div class="asd">
        <div class="myPost">
            <?php foreach($list as $item) { ?>
                <div class="section">
                    <div class="post_profile">
                        <img src="/images/default_profile.jpg" alt="기본 프로필 이미지">
                        <div class="post_info">
                            <span name="writer" class="writer"><?= $item->writer ?></span>
                            <span name="time" class="time"><?= $item->date ?></span>
                        </div>
                    </div>
                    <div class="post_content"><?= $item->content ?></div>
                    <?php if($_SESSION['user']->name == $item->writer) { ?>
                        <span class="ti-more-alt"></span>
                        <div class="btnList">
                            <input type="hidden" value="<?= $item->id ?>">
                            <a class="modify" href="javascript:return false;">수정</a>
                            <a class="delete" href="/delete?id=<?= $item->id ?>">삭제</a>
                        </div>
                    <?php } ?>
                    <div class="comment">
                        <div class="comment_group">
                            <a href="/board/like?id=<?= $item->id ?>">좋아요 <span class="like"><?= $item->liked ?></span></a>
                            <a href="#">댓글 <span class="comment_cnt"><?= $item->commented ?></span></a>
                        </div>
                        <div class="comment_list">
                            <ul>
                                <?php foreach($item->comments as $item2) { ?>
                                    <li>
                                        <div class="comment_profile">
                                            <div class="comment_info">
                                                <img src="/images/default_profile.jpg" alt="댓글 기본 프로필 이미지">
                                                <span><?= $item2->writer ?></span>
                                                <span class="time" style="font-size:11px; font-weight: normal"><?= $item2->wdate ?></span>
                                            </div>
                                        </div>
                                        <div class="comment_content">
                                            <?= $item2->content ?>
                                        </div>
                                        <!-- ?php if($_SESSION['user']->idx == $item2->uidx || $_SESSION['user']->name == $item->writer) { ?> -->
                                        <?php if($_SESSION['user']->idx == $item2->uidx) { ?>
                                            <div class="comment_btnList">
                                                <a href="/comment_delete?id=<?= $item->id ?>" class="comment_delete"><span class="ti-close"></span></a>
                                            </div>
                                        <?php } ?>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <form action="/comment_write" method="post">
                            <div class="comment_input">
                                <input type="text" style="display:none;" name="pidx" value="<?= $item->id ?>">
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
        <div class="widget">
            <div class="widget_info">
                <h3>정보</h3>
                <div class="list_info">
                    <ul>
                        <li>
                            <span class="ti-pencil"></span>
                            <span class="story">스토리</span>
                            <h4><?= $cnt ?></h4>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="widget_friend">
                <h3>추천친구</h3>
            </div>
        </div>
    </div>
</div>

<!-- 쪽지작성 틀 -->
<div class="cover_wrapper_msg">
    <div class="message_write">
        <div class="message_top">
            <h3>새쪽지 작성</h3>
            <button type="button" id="message_cancel"><span class="ti-close"></span></button>
        </div>
        <form action="/message" method="post" class="message_form">
            <input type="text" name="receiver" placeholder="받는사람" class="post_input" readonly>
            <!-- <span class="ti-close close_person"></span> -->
            <div class="friend_list">
                <ul>
                    <?php foreach($friend_list as $item) { ?>
                        <li>
                            <div class="friend_profile" >
                                <a href="javascript:return false;">
                                    <img src="/images/default_profile.jpg" alt="내 친구 프로필 이미지">
                                    <span class="message_name"><?= $item->name ?></span>
                                    <input type="hidden" value="<?= $item->idx ?>" name="message_ridx" class="message_ridx">
                                </a>    
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <textarea name="message_input" id="message_input" cols="30" rows="10"></textarea>
            <div class="btn_group">
                <input type="submit" value="보내기" id="message_post">
            </div>
        </form>
    </div>
</div>
<!-- 쪽지작성 틀 끝 -->

<!-- 쪽지 조회 -->
<div class="cover_wrapper_msg_show">
    <div class="message_write">
        <div class="message_top">
            <h3>보낸쪽지</h3>
            <button type="button" id="message_cancel" class="msg_cancel"><span class="ti-close"></span></button>
        </div>
        <div class="friend_profile" >
            <a href="/profile">
                <img src="/images/default_profile.jpg">
            </a>
            <span class="message_name"></span>
            <span class="ti-more-alt"></span>
            <div class="delete_msg">
                <a href="/delete_msg">삭제하기</a>
            </div>
        </div>
        <textarea name="message_input" readonly id="show_msg_input" cols="30" rows="10"></textarea>
        <div class="btn_group">
            <input type="submit" value="답장" id="message_post">
        </div>
    </div>
</div>
<!-- 쪽지 조회 끝 -->

<!-- 글쓰기 수정 -->
<div class="cover_wrapper">
    <div class="modify_write">
        <form action="/modify" method='post'>
            <input type="hidden" value="" name="pidx" class="pidx">
            <textarea name="modify_input" id="modify_input" cols="30" rows="10" placeholder="<?= $_SESSION['user']->name ?>님의 이야기를 기다리고 있어요."></textarea>
            <div class="btn_group">
                <button type="button" id="modify_cancel">취소</button>
                <input type="submit" value="올리기" id="modify_post">
            </div>
        </form>
    </div>
</div>
<!-- 글쓰기 수정 끝 -->

</body>
</html>