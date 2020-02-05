// 아이디 기억
$(document).ready(function () {
    // 저장된 쿠키값을 가져와서 ID칸에 넣음. 없으면 공백
    let key = getCookie("key");
    $("#id").val(key);

    if ($("#id").val != "") {    // 그 전에 ID를 저장해서 처음 페이지 로딩 시, 입력 칸에 저장된 ID가 표시된 상태라면
        $("#keepLoginbox").attr("checked", true);  // ID 저장하기를 체크 상태로 두기
    }

    $("#keepLoginbox").change(function () {
        if ($("#keepLoginbox").is(":checked")) { // ID 저장하기 체크했을 떄,
            setCookie("key", $("#id").val(), 3);    // 3일 동안 쿠키 보관
        } else {    // ID 저장하기 체크 해제 시,
            deleteCookie("key");
        }
    });

    // ID저장하기 체크한 상테에서 ID를 입력하는 경우, 이럴 때도 쿠키 저장
    $("#id").keyup(function () {     // ID입력 칸에 ID를 입력할 때
        if ($("#keepLoginbox").is(":checked")) {     // ID저장하기를 체크한 상태라면,
            setCookie("key", $("#id").val(), 3);    // 3일동안 쿠키 보관
        }
    });
});

function setCookie(cookieName, value, exdays) {
    let exdate = new Date();
    exdate.setDate(exdate.getDate() + exdays);
    let cookieValue = escape(value) + ((exdays == null) ? "" : "; expires=" + exdate.toGMTString());
    document.cookie = cookieName + "=" + cookieValue;
}

function deleteCookie(cookieName) {
    let expireDate = new Date();
    expireDate.setDate(expireDate.getDate() - 1);
    document.cookie = cookieName + "= " + "; expires=" + expireDate.toGMTString();
}

function getCookie(cookieName) {
    cookieName = cookieName + '=';
    let cookieData = document.cookie;
    let start = cookieData.indexOf(cookieName);
    let cookieValue = '';
    if (start != -1) {
        start += cookieName.length;
        let end = cookieData.indexOf(';', start);
        if (end == -1) end = cookieData.length;
        cookieValue = cookieData.substring(start, end);
    }
    return unescape(cookieValue);
}
// 아이디 기억 끝

// 글쓰기 애니메이션
$(".write textarea").focus(function () {
    $(".write").animate({ height: "308px" }, 300);
    $(".media").animate({ bottom: "70px" }, 300);
    $(".write .btn_group").fadeIn();
});

$(".write .btn_group > #cancel").on("click", function () {
    $(".write").animate({ height: "169px" }, 300);
    $(".media").animate({ bottom: "20px" }, 300);
    $(".write .btn_group").fadeOut('fast');
});
// 글쓰기 애니메이션 끝

// 글 포스팅
/*
$("#post").on("click", function () {
    let value = $(".write textarea").val();
    if ($.trim(value) == "") {
        alert("입력값이 비었습니다. 다시 입력해 주세요.");
        return;
    } else {
        $(".posting").append($("<div class='section'><div class='btnList'><button class='modify'>수정</button><button class='delete'>삭제</button></div>" + value + "</div><br>").fadeIn());
        // $(".write textarea").val('');
        $(".write").animate({ height: "169px" }, 300);
        $(".media").animate({ bottom: "20px" }, 300);
        $(".write .btn_group").fadeOut('fast');
    }
});
*/
// 글 포스팅 끝

// ajax 더보기 버튼
// let currentIdx = 0;
// let grid = null;

// getDataFromServer(currentIdx);

// let moreBtn = $("#moreBtn");
// moreBtn.on("click", function() {
//     console.log("asd");
//     getDataFromServer(5);
// });

// function getDataFromServer(idx){
//     return new Promise( (res, rej) => {
//         $.ajax({
//             url: `/list/${idx}`,
//             method: 'get',
//             success: (data) => {
//                 if(data.success){
//                     makeTemplate(data.list);
//                     currentIdx += data.list.length;
//                     // $(".list-btn").css({display:'inline-block'});
//                     // $(".write-btn").css({display:'none'});
//                 }else {
//                     // $(".icon-btn").css({display:'none'});
//                 }
//                 res();
//             }
//         });
//     });
// }

// function makeTemplate(list){
//     const posting = document.querySelector(".posting");
//     if(currentIdx == 0){
//         posting.innerHTML = "";
//         grid = document.createElement("div");
//         grid.id = "gridContainer";
//     }

//     list.forEach((item, idx) => {
//         setTimeout(()=>{
//             let dom = makeItem(item);
//             grid.appendChild(dom);
//             setTimeout(()=>{
//                 dom.classList.add("active");
//             }, 10);
//         }, Math.floor(idx / 3)  * 500);
//     });
//     posting.appendChild(grid);
// }

// function makeItem(item){
//     let dom = document.createElement("li");
//     // dom.classList.add("todobox");
//     dom.innerHTML = `
//                 <div class="comment_profile">
//                     <div class="comment_info">
//                         <img src="/images/default_profile.jpg" alt="댓글 기본 프로필 이미지">
//                         <span>${ item.title }</span>
//                     </div>
//                 </div>
//                 <div class="comment_content">
//                     ${ item.content }
//                 </div>`;
//     return dom;
// }

// ajax 더보기 버튼 끝

// ajax 무한 스크롤
// $(document).ready(function () {
//     $(document).scroll(function () {
//         let maxHeight = $(document).height();
//         let currentScroll = $(window).scrollTop() + $(window).height();

//         if (maxHeight <= currentScroll + 100) {
//             $.ajax({

//             })
//         }
//     })
// });
// ajax 무한 스크롤 끝

// 댓글 input창 눌렀을 때
$(".comment_input > input").on("focus", function () {
    $(this).parent().animate({ width: "87%" }, 200);
    $(this).parent().parent().children('input').fadeIn('fast');
});

$(".comment_input > input").on("blur", function () {
    $(".comment_input").animate({ width: "100%" }, 200);
    $(".comment_post").fadeOut('fast');
});
// 댓글 input창 눌렀을 때 끝

// side bar 버튼 애니메이션
$("#friend").on("click", function() {
    /* css */
    $("#recommend").css( 'border-top', '1px solid #d0d0d0' ).css( 'border-bottom', '1px solid #d0d0d0' );
    $("#note").css( 'border-top', '1px solid #d0d0d0' ).css( 'border-bottom', '1px solid #d0d0d0' );
    $("#friend").css( 'border-top', '2px solid #f26a41' ).css( 'border-bottom', 'none' ).css( 'color', '#000' );
    /* fade */
    $(".recommend").fadeOut('fast');
    $(".note").fadeOut('fast');
    setTimeout(() => {
        $(".friend").fadeIn('fast');
    }, 200);
});
$("#recommend").on("click", function() {
    /* css */
    $("#friend").css( 'border-top', '1px solid #d0d0d0' ).css( 'border-bottom', '1px solid #d0d0d0' );
    $("#note").css( 'border-top', '1px solid #d0d0d0' ).css( 'border-bottom', '1px solid #d0d0d0' );
    $("#recommend").css( 'border-top', '2px solid #f26a41' ).css( 'border-bottom', 'none' ).css( 'color', '#000' );
    /* fade */
    $(".friend").fadeOut('fast');
    $(".note").fadeOut('fast');
    setTimeout(() => {
        $(".recommend").fadeIn('fast');
    }, 200);
});
$("#note").on("click", function() {
    /* css */
    $("#friend").css( 'border-top', '1px solid #d0d0d0' ).css( 'border-bottom', '1px solid #d0d0d0' );
    $("#recommend").css( 'border-top', '1px solid #d0d0d0' ).css( 'border-bottom', '1px solid #d0d0d0' );
    $("#note").css( 'border-top', '2px solid #f26a41' ).css( 'border-bottom', 'none' ).css( 'color', '#000' );
    /* fade */
    $(".friend").fadeOut('fast');
    $(".recommend").fadeOut('fast');
    setTimeout(() => {
        $(".note").fadeIn('fast');
    }, 200);
});
// side bar 버튼 애니메이션 끝

// 친구 추천 리스트에서 지우기 (일시적)
let recommend_cnt = $("#recommend_cnt").text();

$(".refuse").on("click", function() {
    $(this).parent().parent().parent().parent().remove();
    recommend_cnt = recommend_cnt - 1;

    $("#recommend_cnt").html(recommend_cnt);
});

// 친구 추천 리스트에서 지우기 끝

// 댓글 작성 ajax
// $(".comment_post").click(function(){
//     // let id = $("#id").val();
//     // let no = $("#no").val();
//     let comment = $(".comment_").val();
//     let writer = $(".writer").val();
//     let data_arr = {"comment":comment, "writer":writer};

//     $.ajax({
//       type:"post",
//       data:data_arr,
//       url:"/comment_write",
//       dataType:"html",
//       success:function(){
//         $(".comment_list > ul").append(`
//                 <li>
//                     <div class="comment_profile">
//                         <div class="comment_info">
//                             <img src="/images/default_profile.jpg" alt="댓글 기본 프로필 이미지">
//                             <span>` + writer + `</span>
//                         </div>
//                     </div>
//                     <div class="comment_content">
//                         ` + content + `
//                     </div>
//                 </li>
//         `);
//         $(".comment_post").val("");
//       }
//     });
// });   
// 댓글 작성 ajax 끝

// 게시글 메뉴 버튼 클릭
$(".ti-more-alt").on("click", function() {
    $(this).parent().children(".btnList").css("display", "inline-block");
    $(".ti-more-alt").css("color", "#989898");
});

$(document).on("click", function(e) {
    if ( !$(e.target).hasClass("btnList") && !$(e.target).hasClass("ti-more-alt") ) {
        $(".btnList").css("display", "none");
        $(".ti-more-alt").css("color", "#c2c2c2");
    }
});
// 게시글 메뉴 버튼 클릭 끝

// 글 수정
$(".btnList > .modify").on("click", function () {
    $(".cover_wrapper").fadeIn();
    $(".cover_wrapper").css("display", "fixed");
});

$("#modify_cancel").on("click", function () {
    // $("#modify_input").val("");
    $(".cover_wrapper").fadeOut();
});

$(".modify").on("click", function(){
    $(".cover_wrapper").css("display", "fixed");

    let content = $(this).parent().parent().children(".post_content").text();

    $("#modify_input").text(content);

    let pidx = $(this).parent().children("input").val();
    
    $(".pidx").val(pidx);
});
// 글 수정 끝