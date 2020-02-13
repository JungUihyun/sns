$(function() {
    $(".btn_search").on("click", function() {
        if($.trim($(".input_search")).val() == '') {
            alert("검색어를 입력하세요");
            return false;
        } else {
            $(this).submit();
        }
    });






});