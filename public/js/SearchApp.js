class SearchApp {
    constructor() {
        this.search = $(".btn_input");
        this.addEvent();
        this.data = [];
        $.ajax({
            url: '/search',
            method: 'get',
            success: (data) => {
                this.data = data;
                this.loadData(data);
            }
        });
    }

    addEvent(){
        $(".btn_search").on("click", this.search);
    }

    search = () => {
        let value = this.search.val();
        let regex = new RegExp(value, "gi");

        this.data.forEach(item => {
            
        });
    }

    loadData(data) {
        this.cardList.empty();
        data.forEach((item, idx) => {            
            let str = this.makeCard(item);
            this.cardList.append(str);
            setTimeout(() => {
                $(".card-list > .card").eq(idx).addClass("active");
            }, 50 + idx * 300);
        });
    }

    makeCard(item) {
        return `
            <div class="section">
                <div class="post_profile">
                    <img src="/images/default_profile.jpg" alt="기본 프로필 이미지">
                    <div class="post_info">
                        <span class="writer">${ $item.writer }</span>
                        <span class="time">${ $item.date }</span>
                    </div>
                </div>
                <div class="post_content">${ $item.content }</div>
                <div class="btnList">
                    <span id="section_idx">${ $item.id }</span>
                    <button class="modify">수정</button>
                    <!-- <a class="modify" href="/modify?id=${ $item.id }">수정</a> -->
                    <a href="/delete?id=${ $item.id }">삭제</a>
                </div>
                <div class="comment">
                    <div class="comment_list">
                        <ul>
                            <?php foreach($item->comments as $item2) { ?>
                                <li>
                                    <div class="comment_profile">
                                        <div class="comment_info">
                                            <img src="/images/default_profile.jpg" alt="댓글 기본 프로필 이미지">
                                            <span>${ $item2.writer }</span>
                                            <span class="time" style="font-size:11px; font-weight: normal">${ $item2.wdate }</span>
                                        </div>
                                    </div>
                                    <div class="comment_content">
                                        ${ $item2.content }
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <form action="/comment_write" method="post">
                        <div class="comment_input">
                            <input type="text" style="display:none;" name="pidx" value="${ $item.idx }">
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
            `;
    }
}