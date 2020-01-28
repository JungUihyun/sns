// 아이디 기억
$(document).ready(function() {
    // 저장된 쿠키값을 가져와서 ID칸에 넣음. 없으면 공백
    let key = getCookie("key");
    $("#id").val(key);

    if($("#id").val != "") {    // 그 전에 ID를 저장해서 처음 페이지 로딩 시, 입력 칸에 저장된 ID가 표시된 상태라면
        $("#keepLoginbox").attr("checked", true);  // ID 저장하기를 체크 상태로 두기
    }

    $("#keepLoginbox").change(function() { 
        if($("#keepLoginbox").is(":checked")) { // ID 저장하기 체크했을 떄,
            setCookie("key", $("#id").val(), 3);    // 3일 동안 쿠키 보관
        } else {    // ID 저장하기 체크 해제 시,
            deleteCookie("key");
        }
    });

    // ID저장하기 체크한 상테에서 ID를 입력하는 경우, 이럴 때도 쿠키 저장
    $("#id").keyup(function() {     // ID입력 칸에 ID를 입력할 때
        if($("#keepLoginbox").is(":checked")) {     // ID저장하기를 체크한 상태라면,
            setCookie("key", $("#id").val(), 3);    // 3일동안 쿠키 보관
        }
    });
});

function setCookie(cookieName, value, exdays){
    let exdate = new Date();
    exdate.setDate(exdate.getDate() + exdays);
    let cookieValue = escape(value) + ((exdays==null) ? "" : "; expires=" + exdate.toGMTString());
    document.cookie = cookieName + "=" + cookieValue;
}
 
function deleteCookie(cookieName){
    let expireDate = new Date();
    expireDate.setDate(expireDate.getDate() - 1);
    document.cookie = cookieName + "= " + "; expires=" + expireDate.toGMTString();
}
 
function getCookie(cookieName) {
    cookieName = cookieName + '=';
    let cookieData = document.cookie;
    let start = cookieData.indexOf(cookieName);
    let cookieValue = '';
    if(start != -1){
        start += cookieName.length;
        let end = cookieData.indexOf(';', start);
        if(end == -1) end = cookieData.length;
        cookieValue = cookieData.substring(start, end);
    }
    return unescape(cookieValue);
}
// 아이디 기억 끝

// 글추가 테스트

$("#append").on("click", function() {
    $(".posting").append("<div class='section'> </div><br>");
});

$("#delete").on("click", function() {
    $(".section:last").remove();
    $("br:last").remove();
});
// 글추가 테스트 끝

// 글쓰기 애니메이션
$(".write textarea").focus(function() {
    $(".write").animate({ height : "308px" }, 300);
    $(".media").animate({ bottom : "70px" }, 300);
    $(".write .btn_group").fadeIn();
});

$(".write .btn_group > #cancel").on("click", function() {
    $(".write").animate({ height : "169px" }, 300);
    $(".media").animate({ bottom : "20px" }, 300);
    $(".write .btn_group").fadeOut('fast');
});
// 글쓰기 애니메이션 끝

// 글 포스팅
$("#post").on("click", function() {
    let value = $(".write textarea").val();
    if($.trim(value) == "") {
        alert("입력값이 비었습니다. 다시 입력해 주세요.");
        return;
    } else {
        $(".posting").append($("<div class='section'><div class='btnList'><button class='modify'>수정</button><button class='delete'>삭제</button></div>" + value + "</div><br>").fadeIn());
        // $(".write textarea").val('');
        $(".write").animate({ height : "169px" }, 300);
        $(".media").animate({ bottom : "20px" }, 300);
        $(".write .btn_group").fadeOut('fast');
    }
});
// 글 포스팅 끝

// 글 수정
$(".btnList > .modify").on("click", function() {
    $(".cover_wrapper").css("display","block");
});

$("#modify_cancel").on("click", function() {
    $(".cover_wrapper").css("display","none");
});
// 글 수정 끝


