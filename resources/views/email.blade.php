<!DOCTYPE html>
<html>
<head>
	<title>abc</title>
</head>
<body>

<form action="send" method="POST">
	
	@csrf
	To:&nbsp<input type="text" name="to" >
	<br><br>
	Message:&nbsp&nbsp<input type="text" name="message" >
	<br>
	<button type="submit">Submit</button>
</form>
</body>
</html>
