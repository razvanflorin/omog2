<form action="" name="lstpass_form" method="post">
    <div id="main">
        <div id="mainmenu" style="margin-top: 20px;">
           <a href="index.php">처음화면</a>
        <a href="reg.php">등록</a>
      <a href="http://mogame2.kr" target="_blank">사이트</a>
		<a href="http://mogame2.kr/webirc.php" target="_blank">채팅</a>
		<a href="http://kmsr819.shworks.com/servies/mogame2/board/board.php?id=cnews&articleNo=2&page=1&searchText=&clickCategory=" target="_blank">튜토리얼</a>
		<a href="http://kmsr819.shworks.com/servies/mogame2/board/board.php?id=cnews&articleNo=3&page=1&searchText=&clickCategory=" target="_blank">규정</a>
        </div>
        <div id="rightmenu" class="rightmenu">
            <div id="title">{lost_pass_title}</div>
            <div id="content">
                <center>
                    <div id="text1">
						<div align="justify">
                        	{lost_pass_text}
                        </div>
                    </div>
            		<div id="register" class="bigbutton" onclick="document.lstpass_form.submit();">{retrieve_pass}</div>
                    <div id="text2">
                        <div id="text3">
                            <center><b>{email}: <input type="text" name="email" /></b></center>
                        </div>
                    </div>
                </center>
			</div>
		</div>
	</div>
</form>