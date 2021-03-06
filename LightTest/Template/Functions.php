<?php

namespace LightTest\Template;

class Functions {
	public static function pageStart(bool $enableAnimations = false): void {
		$css = file_get_contents(dirname(__FILE__) . "/out/style.css");
		$noAnim = $enableAnimations ? "" : "no-anim";
		
		print <<<HTML
			<!doctype html>
			<html lang="en" class="$noAnim">
			<head>
				<meta charset="UTF-8">
				<meta name="viewport" content="width=device-width, initial-scale=1.0">
				<title>PHP Light Test</title>
				<style>$css</style>
			</head>
			
			<body>
				<h1>PHP Light Test Results</h1>
		HTML;
	}
	
	public static function pageEnd(): void {
		$js = file_get_contents(dirname(__FILE__) . "/out/script.js");
		
		print <<<HTML
				<script>$js</script>
			</body>
			</html>
		HTML;
	}
}
