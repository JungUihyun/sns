<link rel="stylesheet" href="/css/admin.css">
<?php 
    if(user()->id != "admin") {
        move("/", "관리자 외엔 들어가실 수 없습니다.");
    } 
?>
<header>
        <div id="logo">
            <a href="/">
                <img src="/images/main_logo.png" alt="main_logo">
            </a>
        </div>

        <div class="input">
            <form action="/search" method="post">
                <input type="text" class="input_search" placeholder="친구, 채널, 태그, 장소 검색">
                <button class="btn_search">
                    <span class="ti-search"></span>
                </button>
            </form>
        </div>

        <div class="logout">
            <a href="/logout">
                <span class="ti-shift-right" style="position: absolute; right: 50px; top: 20px; cursor: pointer; font-size: 20px;"></span>
            </a>
        </div>

</header>

<div class="container">
    <ul>
        <h3>유저 정보</h3>
        <h5>유저 수 -  <?= $user_cnt ?></h5>
        <?php foreach ($userList as $user) { ?>
            <li>
                <div class="user-profile">
                    <?php if(!empty($user->p_img)) { ?>
                        <img src="<?= $user->p_img ?>" alt="유저프로필">
                    <?php } else { ?>
                        <img src="/images/default_profile.jpg" alt="기본프로필">
                    <?php } ?>
                    <span><?= $user->name ?></span>
                </div>
                <div class="btn_group">
                    <a href="/user_delete/<?= $user->idx ?>">회원탈퇴</a>
                </div>    
            </li>
        <?php } ?>
    </ul>
    <ul>
        <h3>유저 게시판</h3>
        <h5>게시글 수 - <?= $board_cnt ?></h5>
        <?php foreach ($boardList as $board) { ?>
            <li>
                <div class="board-profile">
                    <span>글쓴이 : <?= $board->writer ?></span>
                    <!-- <span>내용 : ?= $board->content ?></span> -->
                    <span>댓글 개수 : <?= $board->commented ?></span>
                    <span>좋아요 개수 : <?= $board->liked ?></span>
                    <span>공개범위 : <?= $board->distance ?></span>
                </div>
                <div class="btn_group">
                    <a href="/board_delete/<?= $board->idx ?>">글삭제</a>
                </div>    
            </li>
        <?php } ?>
    </ul>
    <ul>
        <h3>많은 글을 작성한 유저 TOP 5</h3>
        <?php foreach ($boardTOP as $item) { ?>
            <li>
                <div class="board-profile">
                    <span><?= user($item->uidx)->name ?></span>
                </div>
            </li>
        <?php } ?>
    </ul>
    <ul>
        <h3>많은 댓글을 작성한 유저 TOP 5</h3>
        <?php foreach ($commentTOP as $item) { ?>
            <li>
                <div class="board-profile">
                    <span><?= user($item->uidx)->name ?></span>
                </div>
            </li>
        <?php } ?>
    </ul>
</div>

<!-- 배열
1. 배열 = 모든 자기글
2. 내 친구
3. 친구의 글 1, 2
4. 친구의 친구
4. 친구의 친구의 글 1
5. 중복 제거
6. IDX 정렬 -->

<!--
5번 왕휘균 - 휘균(6), asd(7)
6번 휘균   - 왕휘균(5), cvb(12)

