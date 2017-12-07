<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
	<meta http-equiv="Content-Type" content="charset=utf-8" />
    <meta charset="UTF-8">
	<title>PDF Reports</title>
</head>
<body>
<h1>
<?php $image_path = '/images/pinaglabananlogo.png'; ?>
	<center><img src="{{ public_path() . $image_path }}"></center>
</h1>
<?php $postImage = '/photos/3/administrator-clipart-administrator.jpg'; ?>
	<img src="{{ public_path() . $postImage }}" width="100" height="100">
	{!!$clients->report_content!!}
</body>
</html>