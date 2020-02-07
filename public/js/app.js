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
// $(".drop-list").css('display', 'none');
$(".upImage").on('change', function() {
    $(".write > form > textarea").focus();
});

$(".write > form > textarea").focus(function () {

    $(".drop-list").animate({ "margin-top": "20px"}, 0);
    $(".drop-list").animate({ "margin-bottom": "110px"}, 0);        
    $(".media").animate({ bottom: "70px" }, 0);
    $(".write .btn_group").css('display', 'block');
});

$(".write .btn_group > #cancel").on("click", function () {
    $(".drop-list").animate({ "margin-top": "0px"}, 0);
    $(".drop-list").animate({ "margin-bottom": "0px"}, 0);
    $(".media").animate({ bottom: "20px" }, 0);
    $(".write .btn_group").css('display','none');
});


// 글쓰기 애니메이션 끝

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
$(".section > .ti-more-alt").on("click", function() {
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

// 쪽지 보내기
$(".open_message").on("click", function() {
    $(".cover_wrapper_msg").fadeIn('fast');
});
$("#message_cancel").on("click", function() {
    $(".cover_wrapper_msg").fadeOut('fast');
    $(".post_input").text("");
    $("#message_input").val("");
    $(".friend_list").fadeIn('fast');
    $("#message_input").fadeOut('fast');
});

$(".message_form > .friend_list > ul li").on("click", function() {
    let uName = $(this).children().children().children(".message_name").text();
    $(".message_form > .post_input").val(uName);
    $(".message_form > .friend_list").fadeOut('fast');
    $(".message_form > #message_input").fadeIn('fast');
});
// 쪽지 보내기 끝

// 쪽지 조회
let cover = $(".cover_wrapper_msg_show");
$(".message_list.first_list > ul li").on("click", function() {
    cover.fadeIn('fast');
    let msg_receiver = $(this).children().children().children().children(".msg_receiver").val();
    let msg_content = $(this).children().children().children().children(".msg_content").val();

    $(".cover_wrapper_msg_show > .message_write > .message_top > h3").text("보낸쪽지");
    $(".friend_profile > .message_name").text(msg_receiver + "님에게");
    $("#show_msg_input").text(msg_content);

});

$(".friend_profile > .ti-more-alt").on("click", function() {
    $(this).parent().children(".delete_msg").css("display", "inline-block");
    $(".ti-more-alt").css("color", "#989898");
});

$(document).on("click", function(e) {
    if ( !$(e.target).hasClass("delete_msg") && !$(e.target).hasClass("ti-more-alt") ) {
        $(".delete_msg").css("display", "none");
        $(".ti-more-alt").css("color", "#c2c2c2");
    }
});

$(".msg_cancel").on("click", function() {
    cover.fadeOut('fast');
    $("#show_msg_input").text("");
    $(".friend_profile > .message_name").text("");
    $(".message_write > .message_top > h3").text("");
});

$(".message_list.second_list > ul li").on("click", function() {
    $(".cover_wrapper_msg_show > .message_write > .message_top > h3").text("받은쪽지");
    cover.fadeIn('fast');
    
    let msg_writer = $(this).children().children().children(".msg_writer").val();
    let msg_content = $(this).children().children().children(".msg_content").val();

    $(".friend_profile > .message_name").text(msg_writer + "으로부터");
    $("#show_msg_input").text(msg_content);
});

// 쪽지 조회 끝
// 이미지 업로드 (드래그앤드롭, input(file))

$(".write .btn_group > #cancel").on("click", function () {
    $(".fileThumb").fadeOut('fast');
    $(".fileThumb").val("");
});

const dropZone = document.querySelector(".write");
const dropList = document.querySelector(".drop-list");

$(".write .btn_group > #cancel").on("click", function () {
    $('.drop-list').children().fadeOut(500, function() {
        $('.drop-list').empty();
    });
});

dropZone.addEventListener("dragover", e => {
    e.preventDefault();
});

dropZone.addEventListener("drop", e=>{
    e.preventDefault();

    const files = Array.from(e.dataTransfer.files);
    loadThumbnail(files);
});

// if($(".file_input").val().length > 0) {

//     loadThumbnail(file);
// }

$(".write").on("dragover", dragOver).on("dragleave", dragOver).on("drop", dragOver);
function dragOver(e) {
    e.stopPropagation();
    e.preventDefault();

    if (e.type == "dragover") {
        $(".write").css({
            "border": "2px dashed #F26A41"
        });
    } else {
        $(".write").css({
            "border": "2px solid #fff"
        });
    }
}

function loadThumbnail(files){
    files.forEach(async x => {
        let img = await loadFile(x);
        dropList.appendChild(img);

        let formData = new FormData();
        formData.append("file", x);
        $.ajax({
            url:"/write",
            method:"post",
            processData: false,
            contentType: false,
            data:formData,
            success:(result)=>{
                console.log(result);
            }
        });
    });
}

function loadFile(file){
    return new Promise( (res, rej)=>{
        let reader = new FileReader();

        reader.addEventListener("load", ()=>{
            let img = new Image();
            img.src = reader.result;
            img.addEventListener("load", ()=>{
                let canvas = document.createElement("canvas");
                canvas.width = 100;
                canvas.height = 100;
                let ctx = canvas.getContext("2d");
                ctx.drawImage(img, 0, 0, 100, 100);
                let url = canvas.toDataURL();

                let thumbImg = new Image();
                thumbImg.src = url;

                res(thumbImg);
            });
        });
        reader.readAsDataURL(file);
    });
}

$(".upImage").on("change", function(e) {
    let input = document.querySelector('.input-file');
    for( let i = 0; i < input.files.length; i++ ) {
        let reader = new FileReader();
        reader.onload = function(e) {
            // $('.drop-list').append(`<div>${input.files[i].name}</div>`);
            $('.drop-list').append(`<img src="${e.target.result}" alt="" />`);

            console.log(input.files[i].name, e.target.result);
        }
        reader.readAsDataURL(input.files[i]);
    }

});
// 이미지 업로드 (드래그앤드롭, input(file)) 끝

// textarea 입력 자동 줄바꿈
$("textarea#write_input").on('keydown keyup', function () {
	$(this).height(1).height( $(this).prop('scrollHeight') );	
});

$(".post_content").on('keydown keyup', function () {
	$(this).height(1).height( $(this).prop('scrollHeight') );	
});
// textarea 입력 자동 줄바꿈 끝