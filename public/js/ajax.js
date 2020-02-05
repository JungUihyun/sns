// 좋아요 버튼

$.ajax({
    type: 'method',
    data: 전송데이터,
    url: '보낼 url',
    success: function(data) {
      if(data == "지정한 성공값(스크랩 성공") {
                //성공시 동작
      } else if(data == "지정한 성공값(스크랩 해지)") {
              //해지시 동작
      } else {
            // 그 외 동작
      }
    }
});
// 좋아요 버튼 끝