    // 로그인 배경화면
    function slideSwitch() {
        let $active = $('#bg .bg.active');
        if ($active.length == 0) $active = $('#bg .bg:last');

        let $next = $active.next().length ? $active.next() : $('#bg .bg:first');

        $active.addClass('last-active');
        $next.css({ opacity: 0 }).addClass('active').animate({ opacity: 1.0 }, 500, function () {
            $active.removeClass('active last-active');
        });
    }

    let texts = ['msg1.png', 'msg2.png', 'msg3.png'];
    let i = 0;
    function changeText() {
        i++;

        if(i > 2) {
            i = 0;
        }

        $(".intro > img").attr('src', '/images/' + texts[i]);
    }

    $(function () {
        setInterval("changeText()", 5000);
        setInterval("slideSwitch()", 5000);
    });    
    // 로그인 배경화면 끝

    // 아이디 기억
    // $(document).ready(function () {
    //     // 저장된 쿠키값을 가져와서 ID칸에 넣음. 없으면 공백
    //     let key = getCookie("key");
    //     $("#id").val(key);

    //     if ($("#id").val != "") {    // 그 전에 ID를 저장해서 처음 페이지 로딩 시, 입력 칸에 저장된 ID가 표시된 상태라면
    //         $("#keepLoginbox").attr("checked", true);  // ID 저장하기를 체크 상태로 두기
    //     }

    //     $("#keepLoginbox").change(function () {
    //         if ($("#keepLoginbox").is(":checked")) { // ID 저장하기 체크했을 떄,
    //             setCookie("key", $("#id").val(), 3);    // 3일 동안 쿠키 보관
    //         } else {    // ID 저장하기 체크 해제 시,
    //             deleteCookie("key");
    //         }
    //     });

    //     // ID저장하기 체크한 상테에서 ID를 입력하는 경우, 이럴 때도 쿠키 저장
    //     $("#id").keyup(function () {     // ID입력 칸에 ID를 입력할 때
    //         if ($("#keepLoginbox").is(":checked")) {     // ID저장하기를 체크한 상태라면,
    //             setCookie("key", $("#id").val(), 3);    // 3일동안 쿠키 보관
    //         }
    //     });
    // });

    // function setCookie(cookieName, value, exdays) {
    //     let exdate = new Date();
    //     exdate.setDate(exdate.getDate() + exdays);
    //     let cookieValue = escape(value) + ((exdays == null) ? "" : "; expires=" + exdate.toGMTString());
    //     document.cookie = cookieName + "=" + cookieValue;
    // }

    // function deleteCookie(cookieName) {
    //     let expireDate = new Date();
    //     expireDate.setDate(expireDate.getDate() - 1);
    //     document.cookie = cookieName + "= " + "; expires=" + expireDate.toGMTString();
    // }

    // function getCookie(cookieName) {
    //     cookieName = cookieName + '=';
    //     let cookieData = document.cookie;
    //     let start = cookieData.indexOf(cookieName);
    //     let cookieValue = '';
    //     if (start != -1) {
    //         start += cookieName.length;
    //         let end = cookieData.indexOf(';', start);
    //         if (end == -1) end = cookieData.length;
    //         cookieValue = cookieData.substring(start, end);
    //     }
    //     return unescape(cookieValue);
    // }
    // 아이디 기억 끝

    // 글쓰기 애니메이션
    // $(".drop-list").css('display', 'none');
    $(".upImage").on('change', function() {
        $(".write > form > textarea").focus();
    });

    $(".link").focus(function() {
        $(".drop-list").animate({ "margin-top": "20px"}, 0);
        $(".drop-list").animate({ "margin-bottom": "110px"}, 0);        
        $(".media").animate({ bottom: "70px" }, 0);
        $(".write .btn_group").css('display', 'block');
    });

    $(".write > form > textarea").focus(function () {
        $(".drop-list").animate({ "margin-top": "20px"}, 0);
        $(".drop-list").animate({ "margin-bottom": "110px"}, 0);        
        $(".media").animate({ bottom: "70px" }, 0);
        $(".write .btn_group").css('display', 'block');
        $(".selectBox").css('display', 'block');
    });

    $(".write .btn_group > #post").on("click", function() {
        $(".drop-list").empty();
        location.reload();
    });

    $(".write .btn_group > #cancel").on("click", function () {
        $(".drop-list").animate({ "margin-top": "0px"}, 0);
        $(".drop-list").animate({ "margin-bottom": "0px"}, 0);
        $(".media").animate({ bottom: "20px" }, 0);
        $(".write .btn_group").css('display','none');
        $(".selectBox").css('display', 'none');
    });
    // 글쓰기 애니메이션 끝

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

        let src = $(this).children().children().children().children('img').attr('src');
        console.log(src);
        $(".message_write > .friend_profile > a > img").attr("src", src);

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
        $(".message_write > .friend_profile > a > img").attr("src", "");
    });

    $(".message_list.second_list > ul li").on("click", function() {
        $(".cover_wrapper_msg_show > .message_write > .message_top > h3").text("받은쪽지");
        cover.fadeIn('fast');
        
        let msg_writer = $(this).children().children().children(".msg_writer").val();
        let msg_content = $(this).children().children().children(".msg_content").val();

        $(".friend_profile > .message_name").text(msg_writer + "으로부터");
        $("#show_msg_input").text(msg_content);

        let src = $(this).children().children().children('img').attr('src');
        console.log(src);
        $(".message_write > .friend_profile > a > img").attr("src", src);
    });

    // 쪽지 조회 끝

    // 이미지 업로드 (드래그앤드롭, input(file))

    $(".write .btn_group > #cancel").on("click", function () {
        $(".fileThumb").css("display","none");
        $(".fileThumb").val("");
    });

    const dropZone = document.querySelector(".write");
    const dropList = document.querySelector(".drop-list");

    $(".write .btn_group > #cancel").on("click", function () {
        $('.drop-list').empty();
    });

    dropZone.addEventListener("dragover", function(e) {
        e.preventDefault();
    });

let fileList = [];

$(function() {
    dropZone.addEventListener("drop", function(e){
        $(".write > form > textarea").focus();
        e.stopPropagation();
        e.preventDefault();
        console.log(e.originalEvent);
        
        let f_cnt = 0;
        let files = e.originalEvent.dataTransfer;
        console.log(files);
        fileObjects = { ...Array.from(files.files) };

        for(let i = f_cnt; i < files.files.length; i++) {
            let file = files.files[i];
            fileList.push(file);

            let reader = new FileReader();

            reader.onload = function(event) {
                console.log(event);
                $('.drop-list').append(`<img src="${event.target.result}" data-name="${file.name}" data-idx="${i}" alt="" />`);
            }
            reader.readAsDataURL(file);
        }
        console.log(fileList); 
        console.log(fileList.length); 
        if(fileList.length > 5) {
            alert("5장 이상은 넣을 수 없습니다.");
            location.reload();
    
            return;
        }
        // loadThumbnail(files);
    });
});

$("#post").on("click", function() {
    post();
});

function post() {
    let formData = new FormData();

    fileList.forEach(x => {
        formData.append("list[]", x);
    });

    $.ajax({
        url : "/write",
        method : "post",
        data : formData,
        processData: false,
        contentType: false,
        success:(result)=>{
            console.log(result);
        }
    });
}

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

    // 이미지 업로드 (드래그앤드롭, input(file)) 끝

    // textarea 입력 자동 줄바꿈
    $("textarea#write_input").on('keydown keyup', function () {
        $(this).height(1).height( $(this).prop('scrollHeight') );	
    });

    $(".post_content").on('keydown keyup', function () {
        $(this).height(1).height( $(this).prop('scrollHeight') );	
    });

    // $(".comment_").on('keydown keyup', function () {
    //     $(this).height(1).height( $(this).prop('scrollHeight') );	
    // });
    // textarea 입력 자동 줄바꿈 끝

    // 이미지 썸네일 위치바꿈
    $(function() {
        $("#sortable").sortable();
        $("#sortable").disableSelection();

        $(".drop-list").sortable({
            placeholder:"itemBoxHighlight",
            start: function(event, ui) {
                ui.item.data('start_pos', ui.item.index());
            },
            stop: function(event, ui) {
                let spos = ui.item.data('start_pos');
                let epos = ui.item.index();
                reorder();
            }
        });
    });

    function reorder() {
        $(".itemBox").each(function(i, box) {
            $(box).find(".itemNum").html(i + 1);
        });
    }
    // 이미지 썸네일 위치바꿈 끝

    // 섹션 이미지 슬라이드
    $(function() {
        $('.itemValue').val("1");
        let position = $(".itemValue").val();
        console.log(position);
        $("#prev_btn").on("click", function() {
            if(1 < position) {
                $(this).parent().children('.slider').animate({ left: "+=490px" }, 300);
                position--;
                console.log(position + '마이너스');
            }
        });

        $("#next_btn").on("click", function() {
            if($(this).parent().children().children('li').length > position) {
                $(this).parent().children('.slider').animate({ left: "-=490px" }, 300);
                position++;
                console.log(position + "플러스");
            }
        });
    });
    // 섹션 이미지 슬라이드 끝

    // 프로필 이미지
    $(".profile_image > input").on("change", function(e) {
        let formData = new FormData();
        let file = $(this)[0].files[0];

        formData.append("file", file);
        // console.log(file['name']);

        $.ajax({
            url : "/setProfile",
            type: "post",
            processData : false,
            contentType : false,
            data : formData,
            success : (result)=>{
                console.log(result);
            },
            error : (result)=> {
                console.log(result);
            }
        });
        setTimeout(() => {
            location.reload();
        }, 300);
    });
    // 프로필 이미지 끝

    // 배경 이미지
    $(".myStory > .bg_change > #bg_change").on("change", function(e) {
        let formData = new FormData();
        let file = $(this)[0].files[0];

        formData.append("file", file);
        // console.log(file['name']);

        $.ajax({
            url : "/setBackground",
            type: "post",
            processData : false,
            contentType : false,
            data : formData,
            success : (result)=>{
                console.log(result);
            },
            error : (result)=> {
                console.log(result);
            }
        });
        setTimeout(() => {
            location.reload();
        }, 300);
    });
    // 프로필 이미지 끝

    // 공개범위 설정
$(function() {
    $(".section > .ti-more-alt").on("click", function() {
        let distanceValue = $(this).parent().children('.btnList').children('.radioMoved').val();
        if(distanceValue == 1) {
            $(this).parent().children('.btnList').children('.distance').children('.all').attr("checked", true);
        } else if(distanceValue == 2) {
            $(this).parent().children('.btnList').children('.distance').children('.friend').attr("checked", true);
        } else if(distanceValue == 3) {
            $(this).parent().children('.btnList').children('.distance').children('.me').attr("checked", true);
        }
    });
});

// 공개범위 설정 끝

// 탭 키 눌렀을 때
$('textarea').on('keydown', function(e) {
	if ( e.keyCode === 9 ) {
		let start = this.selectionStart;
		let end = this.selectionEnd;

		$(this).val( $(this).val().substring(0, start) + '\t' + $(this).val().substring(end));

		this.selectionStart = this.selectionEnd = start + 1;

		e.preventDefault();
	}
});
// 탭 키 눌렀을 때 끝