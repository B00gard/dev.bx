<?php

class Page
{
	public static function header(): string
	{
		return '
		<!DOCTYPE html>
		<html lang="en">
		<head>
			<meta charset="UTF-8"/>
			<title>DiffTool</title>
			<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
				  integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"/>
			<link rel="stylesheet" href="../CSS/style.css"/>
		</head>
		 ';
	}

	public static function beforeText(): string
	{
		return '
		<body>
			<div class="text-center" style="padding-top: 30px">
				РЕЗУЛЬТАТ СРАВНЕНИЯ
			</div>
			<div class="row">
				<div class="col-6">
					<p class="result">
		';
	}

	public static function betweenTexts(): string
	{
		return '
		</p>
		</div>
		<div class="col-6">
			<p class="result">
		';
	}

	public static function afterText(): string
	{
		return '
				</p>
				</div>
			</div>
		</body>
		</html>
		';
	}
}
