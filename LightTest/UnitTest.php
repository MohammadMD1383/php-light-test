<?php

namespace LightTest;

use ReflectionClass;
use ReflectionMethod;
use LightTest\Exception\FailedTestException;

abstract class UnitTest
{
	use AssertionUtil;
	
	private static int $sectionCount = 0;
	
	public function run(): void
	{
		$reflect = new ReflectionClass($this);
		
		self::sectionStart($reflect->name);
		
		$testMethods = array_filter($reflect->getMethods(), fn($value) => str_starts_with($value->name, "test_"));
		$testsCount = count($testMethods);
		$padLength = (int)log10($testsCount) + 1;
		
		for ($i = 0; $i < $testsCount; $i++) {
			$methodName = $testMethods[$i]->name;
			$testName = substr($methodName, 5);
			$no = str_pad((string)($i + 1), $padLength, "0", STR_PAD_LEFT);
			
			$info = (new ReflectionMethod($this, "$methodName"))->getDocComment();
			if ($info) {
				$info = self::trimPHPDoc($info);
			} else $info = "No Info.";
			
			try {
				$this->$methodName();
				self::printResult(true, $no, $testName, $info);
			} catch (FailedTestException $e) {
				self::printResult(false, $no, $testName, $info, $e->getMessage());
			}
		}
		
		self::sectionEnd();
	}
	
	private static function trimPHPDoc(string $str): string
	{
		$tmp_arr = explode("\n", $str);
		for ($i = 0; $i < count($tmp_arr); $i++) {
			$tmp_str = trim($tmp_arr[$i]);
			$tmp_str = trim($tmp_str, "/* ");
			$tmp_arr[$i] = $tmp_str;
		}
		$tmp_arr = array_filter($tmp_arr, fn($item) => $item !== "");
		return implode("<br>", $tmp_arr);
	}
	
	private static function sectionStart(string $name)
	{
		$c = ++self::$sectionCount;
		
		print <<<HTML
			<section style="animation-delay: ${c}s">
				<div class="title">
					<span class="collapsed"></span>
					<div>$name</div>
					<hr />
				</div>
				
				<div class="content" style="height: 0;">
					<table>
		HTML;
	}
	
	private static function sectionEnd()
	{
		print <<<HTML
					</table>
				</div>
			</section>
		HTML;
	}
	
	private static function printResult(bool $success, string $no, string $name, string $info, string $errInfo = null)
	{
		if ($success) {
			$icon = "&check;";
			$status = "s";
		} else {
			$icon = "&times;";
			$status = "f";
		}
		
		print <<<HTML
			<tr>
				<td class="icon" data-icon="$status" data-info="$errInfo">$icon</td>
				<td class="number">$no</td>
				<td class="name">$name</td>
				<td class="info" data-info="$info">?</td>
			</tr>
		HTML;
	}
}
