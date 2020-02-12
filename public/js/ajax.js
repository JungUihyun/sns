// 무한스크롤 인식
$(window).scroll(function() {// 스크롤 이벤트가 발생할 때마다 인식
    if ( $(window).scrollTop() == $(document).height() - $(window).height() ) {// 스크롤이 끝에 닿는걸 인식
      console.log("스크롤 인식");
      page++;
      if(statueFilter ==false){// 필터가 안된 상태이면 내 관심사에 따라서 타임라인에 뿌려줌
          console.log("statueFilter false");
          listAll(page,keywords);
      } else if(statueFilter ==true) {// 필터가 적용되면 필터를 계산한 값을 뿌려줌
          listFilter(page,allData);
      }

      let height = $(document).scrollTop();
      $('.posting').animate({scrollTop : height + 400}, 600);
    }
});
//end of 무한스크롤