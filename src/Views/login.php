<style>
	* {
        font-family:'Malgun Gothic' !important;
		margin: 0;
		padding: 0;
		box-sizing: border-box;
	}

	.container {
        position: relative;
		width: 100%;
		height: 100%;
		background-image: url(/images/bg_4.jpg);
		background-size: cover;
		background-repeat: no-repeat;
	}

    #logo {
        position: absolute;
        top: 20px;
        left: 20px;
        z-index: 10;
        display: inline-block;
        width: 140px;
        height: 27px;
        margin: 0 auto;
        line-height: 1;
    }

    #logo img {
        width: 100%;
    }

	#wrap {
		width: 100%;
		height: 969px;
		display: flex;
		justify-content: center;
		align-items: center;
	}

	#pageLogin {
		width: 380px;
		height: 43%;
		/* background-color: #eee; */
	}

    .intro {
        width: 100%;
        height: 93px;
    }

    .intro > #msg {
        max-width: 100%;
        height: 93px;
    }

    #login-form {
        display: flex;
        flex-direction: column;
        position: relative;
        width: 380px;
    }

    #login-form input:nth-child(1),
    #login-form input:nth-child(2) {
        background-color: transparent;
        border: none;
        border-bottom: 1px solid #fff;
        /* background-color: blue; */
        width: 100%;
        height: 47px;
    }

    #loginBtn {
        background-color: #ffe500;
        height: 50px;
        border: none;
        border-radius: 4px;
        font-size: 15px;
    }

</style>

<div class="container">
	<div id="wrap">
        <div id="logo">
            <img src="/images/logo.png" alt="logo">
        </div>
		<div id="pageLogin">
            <div class="intro">
                <img id="msg" src="/images/msg1.png" alt="msg">
            </div>
            <form id="login-form">
                <input type="text" name="id" id="id">
                <input type="password" name="password" id="password">
                <input type="checkbox" id="keepLogin" name="keepLogin">
                <input type="submit" id="loginBtn" value="로그인">
            </form>
        </div>  
	</div>
</div>