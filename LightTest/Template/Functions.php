<?php

namespace LightTest\Template;

class Functions
{
	public static function pageStart()
	{
		print <<<HTML
			<!doctype html>
			<html lang="en">
			<head>
				<meta charset="UTF-8">
				<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
				<meta http-equiv="X-UA-Compatible" content="ie=edge">
				<title>PHP Light Test</title>
			</head>
			<body>
		HTML;
	}
	
	public static function pageEnd()
	{
		print <<<HTML
			</body>
			</html>
		HTML;
	}
}
