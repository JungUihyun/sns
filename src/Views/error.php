<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Error</title>
<style>
	html {
		overflow-y: hidden;
		height: 100%;
	}

	* {
		margin: 0;
		padding: 0;
		box-sizing: border-box;
	}

	header {
		position: fixed;
		width: 100%;
		height: 64px;
		background-color: #fff;
		border-bottom: 1px solid #d0d0d0;
		z-index: 100;
	}

	#logo {
		float: left;
		width: 170px;
		height: 64px;
	}

	#logo img {
		width: 140px;
		height: 27px;
		margin: 20px 0 0 16px;
	}

	.container {
		position: absolute;
		left: 0;
		bottom: 0;
		right: 0;
		min-height: 500px;
		width: 100%;
		display: flex;
		justify-content: center;
		align-items: center;
		height: 100%;
		background-color: #f3f3f3;
	}

	.container img {
		width: 150px;
		height: 89px;
	}

	.btn_group {
		width: 370px;
		margin: 15px auto 0;
		padding: 19px 70px 0px 70px;
		border-top: 1px solid #d2d2d2;
		font-size: 14px;
		display: flex;
		justify-content: space-around;
		align-items: center;
	}

	.info_error {
		text-align: center;
		margin-top: 40px;
	}

	h2 {
		font-size: 36px;
		margin-top: 50px;
		color: #2b2c31;
	}

	p {
		font-size: 15px;
		line-height: 20px;
		color: #63676f;
		margin-top: 7px;
	}

	a {
		color: #36373c;
	}


</style>
</head>
<body>
	<header>
		<div id="logo">
			<a href="/">
				<img src="/images/main_logo.png" alt="main_logo">
			</a>
		</div>
	</header>
	<div class="container">
		<div class="info_error info_urlerror">
			<img src="/images/error.png" alt="">
			<h2 class="tit_error">아이코!</h2>
			<p class="desc_error">페이지가 존재하지 않습니다.<br>URL이 잘못됐거나 삭제된 스토리일 수 있습니다.</p>
			<div class="btn_group">
				<a class="link_page" href="#" onclick="return history.back(),!1">이전 페이지</a>
				<a class="link_page" href="/">스토리 홈</a>
			</div>
		</div>
	</div>
</body>
</html>