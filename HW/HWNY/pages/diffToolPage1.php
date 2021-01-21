<?php
require_once("header.html");
?>
<body>
	<form name="test" method="post" action="diffToolPage2.php">
		<div class="row">
			<div class="col-6 text-center">
				<p>FIRST TEXT:<Br>
					<textarea name="text1" cols="60" rows="20"></textarea>
				</p>
			</div>

			<div class="col-6 text-center">
				<p>SECOND TEXT:<Br>
					<textarea name="text2" cols="60" rows="20"></textarea>
				</p>
			</div>
		</div>
		<p class="text-center"><input type="submit" value="Отправить"></p>
	</form>
</body>
</html>