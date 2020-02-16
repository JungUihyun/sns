let page = 0;

// 최초 로드
loadPost();

$(window).scroll(function() {		
	// 맨 밑으로 스크롤이 갔을경우 if문을 탑니다. (footer 439px)
	// console.log(Math.ceil($(window).scrollTop()), $(document).height() - $(window).height() - 439);
	if(Math.ceil($(window).scrollTop()) >= $(document).height() - $(window).height() - 439) { 
		loadPost();
	}
});

function loadPost() {
	page++;
	let posts = $(".section");

	posts.css("display", "none");
	for ( let i = page * 5 - 1; i >= 0; i-- ) {
		$(posts[i]).css("display", "block");
	}
}
