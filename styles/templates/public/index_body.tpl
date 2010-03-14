<div id="main">
    <div id="login">
        <div id="login_input">
            <form action="" method="post">
            <table width="400" border="0" cellpadding="0" cellspacing="0">
            <tbody>
            <tr style="vertical-align: top;">
                <td style="padding-right: 4px;">
                    {user} <input name="username" value="" type="text">
                    {pass} <input name="password" value="" type="password">
                </td>
            </tr><tr>
                <td style="padding-right: 4px;">
                    {remember_pass} <input name="rememberme" type="checkbox"><input name="submit" value="{login}" type="submit">
                </td>
            </tr><tr>
                <td style="padding-right: 4px;"><a href="index.php?page=lostpassword">{lostpassword}</a></td>
            </tr>
            </tbody>
            </table>
            </form>
        </div>
	</div>
    <div id="mainmenu" style="margin-top: 20px;">
    	<a href="index.php">처음화면</a>
        <a href="reg.php">등록</a>
        <a href="http://mogame2.kr" target="_blank">사이트</a>
		<a href="http://mogame2.kr/webirc.php" target="_blank">채팅</a>
		<a href="http://kmsr819.shworks.com/servies/mogame2/board/board.php?id=cnews&articleNo=2&page=1&searchText=&clickCategory=" target="_blank">튜토리얼</a>
		<a href="http://kmsr819.shworks.com/servies/mogame2/board/board.php?id=cnews&articleNo=3&page=1&searchText=&clickCategory=" target="_blank">규정</a>
	</div>
    <div id="rightmenu" class="rightmenu">
        <div id="title">드넓은 우주의 세계, MOGame2</div>
        <div id="content">
        	<center>
        		<div id="text1">
        			<div style="text-align: left;"><font color="red">MOGame2</font>는 웹브라우저로 간단히 즐길 수 있는 우주 전쟁 게임입니다.<br />
					본 게임은 인터넷상에서 무료로 배포 및 서비스되며 게임 상에 존재할 수 있는 문법에 맞지 않거나 다소 부적절한 표현에 주의하시기 바랍니다.<br>
<font color="#cc0000">베타 테스트중!</font><br />
					</div>
				</div>
        		<div id="register" class="bigbutton" onclick="document.location.href='reg.php';">광활한 우주의 세계로!</div>
                <div id="text2">
                    <div id="text3">
                        <center>지금 바로 끝모를 우주 전쟁에 참가하십시오!<br />
						<font color="white">총 {users_amount}명 중 {online_users}명이 플레이중입니다.</font></center>
                    </div>
                </div>
        	</center>
		</div>
	</div>
</div>