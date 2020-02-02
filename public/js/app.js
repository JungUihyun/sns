// https://offbyone.tistory.com/279     파일 업로드
// https://www.phpschool.com/gnuboard4/bbs/board.php?bo_table=qna_html&wr_id=285850     ajax

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

// 이미지 업로드
// function uploadImage(f) {
//     // 업로드 할 수 있는 파일 확장자를 제한합니다.
//     // let extArray = new Array('hwp', 'xls', 'doc', 'xlsx', 'docx', 'pdf', 'jpg', 'gif', 'png', 'txt', 'ppt', 'pptx');
//     let extArray = new Array('jpg', 'gif', 'png');
//     let path = document.getElementById("upfile").value;

//     if (path == "") {
//         alert("사진을 선택해 주세요.");
//         return false;
//     }
//     let pos = path.indexOf(".");

//     if (pos < 0) {
//         alert("적합하지 않은 파일 입니다. 다시 선택해 주세요.");
//         return false;
//     }

//     let ext = path.slice(path.indexOf(".") + 1).toLowerCase();
//     let checkExt = false;

//     for (let i = 0; i < extArray.length; i++) {
//         if (ext == extArray[i]) {
//             checkExt = true;
//             break;
//         }
//     }

//     if (checkExt == false) {
//         alert("업로드 할 수 없는 파일 확장자 입니다.");
//         return false;
//     }

//     return true;
// }
// 파일 업로드 끝

// 글 수정
$(".btnList > .modify").on("click", function () {
    $(".cover_wrapper").css("display", "block");
});

$("#modify_cancel").on("click", function () {
    $(".cover_wrapper").css("display", "none");
});
// 글 수정 끝

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
$(".comment_input > input").on("click", function () {
    $(this).parent().animate({ width: "87%" }, 200);
    $(this).parent().parent().children('input').fadeIn('fast');
});

$("#side").on("click", function () {
    $(".comment_input").animate({ width: "100%" }, 200);
    $(".comment_post").fadeOut('fast');
});
// 댓글 input창 눌렀을 때 끝

// 댓글 리스트 크기조절
if($(".comment").height() >= 110) {    
    $(".section").css( 'height', '400');
}
// 댓글 리스트 크기조절 끝

// 댓글 작성
// $("#btn").click(function(){
//     let id = $("#id").val();
//     let no = $("#no").val();
//     let comment = $(".comment_").val();
//     let date = chan_val;
//     let data_arr = {"id":id,"no":no,"comment":comment,"date":date};
//     $.ajax({
//       type:"post",
//       data:data_arr,
//       url:"./cnt_save.php",
//       dataType:"html",
//       success:function(data){
//         $("#cmt_view").append("<div style='width:600px; border:1px solid #e1e1e1; display:inline-block; margin-bottom:10px;'><ul style='height:30px; margin:0; padding:0; list-style:none; background:#e6e6e6;'><li style='width:100px; height:30px; line-height:30px; padding-left:10px; box-sizing:border-box; float:left; font-size:17px;'>" + id + "</li><li style='width:200px; height:30px; line-height:30px; padding-left:10px; box-sizing:border-box; float:left; font-size:15px;'>" + date + "</li><li style='width:50px; height:30px; line-height:30px; padding-left:10px; box-sizing:border-box; float:right; font-size:15px;'><a href=''>삭제</a></li></ul><div style='width:600px; min-height:100px; padding:10px; box-sizing:border-box;'>" + comment + "</div></div>");
//         document.getElementById("comment").value='';
//       }
//     });
   
//   });

// comments -> idx, uidx, pidx, content, wdate
// 댓글 작성 끝

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
    $(this).parent().parent().parent().remove();
    recommend_cnt = recommend_cnt - 1;

    $("#recommend_cnt").html(recommend_cnt);
});

// 친구 추천 리스트에서 지우기 끝