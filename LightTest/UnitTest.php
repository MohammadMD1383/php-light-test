<?php

namespace LightTest;

use ReflectionClass;
use ReflectionMethod;
use LightTest\Exception\FailedTestException;

abstract class UnitTest
{
	use AssertionUtil;
	
	public function run(): void
	{
		$reflect = new ReflectionClass($this);
		
		$this->sectionStart($reflect->name);
		
		$testMethods = array_filter($reflect->getMethods(), fn($value) => str_starts_with($value->name, "test_"));
		$testsCount = count($testMethods);
		$padLength = (int)log10($testsCount) + 1;
		
		for ($i = 0; $i < $testsCount; $i++) {
			$methodName = $testMethods[$i]->name;
			$testName = substr($methodName, 5);
			$no = str_pad((string)($i + 1), $padLength, "0", STR_PAD_LEFT);
			
			$info = str_replace("\n", "<br>", (new ReflectionMethod($this, "$methodName"))->getDocComment());
			/*if ($info) { # todo: needs more care
				$tmp = explode("\n", $info);
				for ($n = 0; $n < count($tmp); $n++) $tmp[$n] = trim($tmp[$n], "/* ");
				$info = trim(implode("\n", $tmp));
			} else $info = "No Info.";*/
			if (!$info) $info = "No Info.";
			
			try {
				$this->$methodName();
				$this->printResult(true, $no, $testName, $info);
			} catch (FailedTestException $e) {
				$this->printResult(false, $no, $testName, $info, $e->getMessage());
			}
		}
		
		$this->sectionEnd();
	}
	
	private function sectionStart(string $name)
	{
		print <<<HTML
			<section>
				<div class="title">
					<span class="collapsed"></span>
					<div>$name</div>
					<hr />
				</div>
				
				<div class="content" style="height: 0;">
					<table>
		HTML;
	}
	
	private function sectionEnd()
	{
		print <<<HTML
					</table>
				</div>
			</section>
		HTML;
	}
	
	private function printResult(bool $success, string $no, string $name, string $info, string $errInfo = null)
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