<link rel="stylesheet" href="/css/register.css">
<div class="container">
    <div id="logo">
        <img src="/images/black_logo.png" alt="logo">
    </div>

    <div class="formBox">
        <h3>계정 정보를 입력해주세요</h3>
        <form action="/register" method="post" class="form">
            <p>계정 아이디</p>
            <input type="text" name="id" autocomplete=”off” placeholder="아이디 입력">
            <p>비밀번호</p>
            <input type="password" name="password" placeholder="비밀번호(8~32자리)">
            <input type="password" name="passwordc" placeholder="비밀번호 재입력">

            <p>이름</p>
            <input type="text" name="name" placeholder="이름을 입력해주세요">

            <input class="btn" type="submit" value="회원가입">
        </form>
    </div>

</div>