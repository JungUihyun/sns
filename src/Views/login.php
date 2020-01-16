<link rel="stylesheet" href="/css/login.css">
<div class="container">
    <div id="bg">
        <img src="/images/bg_1.jpg" alt="bg1" class="bg1">
        <img src="/images/bg_2.jpg" alt="bg2" class="bg2">
        <img src="/images/bg_3.jpg" alt="bg3" class="bg3">
        <img src="/images/bg_4.jpg" alt="bg4" class="bg4">
    </div>
	<div id="wrap">
        <div id="logo">
            <img src="/images/logo.png" alt="logo">
        </div>
		<div id="pageLogin">
            <div class="intro">
                <img id="msg" src="/images/msg1.png" alt="msg">
            </div>
            <form id="login-form" method="post" action="/login">
                <input type="text" name="id" id="id" placeholder="아이디" autocomplete="off">
                <input type="password" name="password" id="password" placeholder="비밀번호">
                <div class="keepLogin">
                    <input type="checkbox" id="keepLoginbox" name="keepLogin">
                    <label for="keepLogin" id="keepLabel">아이디 기억</label>
                </div>
                <input type="submit" id="loginBtn" value="로그인">
            </form>
            <div class="register">
                <a href="/register">회원가입</a>
                <a href="/asdfasdfadsf">에러페이지 가기</a>
            </div>            
        </div>  
	</div>
</div>