<form action="" name="reg_form" method="post">
    <div id="main">
        <div id="login">
            <div id="login_input">
            	<center><h3><strong>MOGame2 등록</strong></h3></center>
            </div>
        </div>
        <div id="mainmenu" style="margin-top: 20px;">
            <a href="index.php">처음화면</a>
        <a href="reg.php">등록</a>
        <a href="http://kmsr819.shworks.com/servies/mogame2/" target="_blank">사이트</a>
		<a href="http://kmsr819.shworks.com/servies/mogame2/webirc.php" target="_blank">채팅</a>
		<a href="http://kmsr819.shworks.com/servies/mogame2/board/board.php?id=cnews&articleNo=2&page=1&searchText=&clickCategory=" target="_blank">튜토리얼</a>
		<a href="http://kmsr819.shworks.com/servies/mogame2/board/board.php?id=cnews&articleNo=3&page=1&searchText=&clickCategory=" target="_blank">규정</a>
        </div>
        <div id="rightmenu" class="rightmenu">
            <div id="title">MOGame2 등록</div>
            <div id="content">
                <center>
                    <div id="text1">
                    	<table>
                        	<tr>
                            	<td>{user_reg}:</td>
                                <td><input name="character" size="20" maxlength="20" type="text"></td>
                            </tr>
                        	<tr>
                            	<td>{pass_reg}:</td>
                                <td><input name="passwrd" size="20" maxlength="20" type="password"></td>
                            </tr>
                        	<tr>
                            	<td>{email_reg}:</td>
                                <td><input name="email" size="20" maxlength="40" type="text"></td>
                            </tr>
                        </table>
                    </div>
            		<div id="register" class="bigbutton" onclick="document.reg_form.submit();">{register_now}</div>
            		<div id="text2">
                		<div id="text3">
							<center><b>{accept_terms_and_conditions} <input name="rgt" type="checkbox"></b></center>
               			 </div>
            		</div>
                </center>
			</div>
		</div>
	</div>
</form>