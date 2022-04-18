<?php

namespace LightTest;

use LightTest\Error\FailedTestException;
use ReflectionClass;
use ReflectionMethod;

abstract class UnitTest {
	use Assertions;
	
	private static int $sectionCount = 0;
	
	private array $testResults = [];
	
	public function run(): void {
		$reflector = new ReflectionClass($this);
		$testMethods = array_filter($reflector->getMethods(), fn($method) => str_starts_with($method->name, "test_"));
		$testsCount = count($testMethods);
		$succeededTests = 0;
		
		for ($i = 0; $i < $testsCount; $i++) {
			$testMethodName = $testMethods[$i]->name;
			$testName = substr($testMethodName, 5);
			
			/** @noinspection PhpUnhandledExceptionInspection */
			$testInfo = (new ReflectionMethod($this, $testMethodName))->getDocComment();
			if ($testInfo) {
				$testInfo = self::trimPHPDoc($testInfo);
			} else $testInfo = "No comment found for this test.";
			
			/** @var string|null $failInfo */
			$failInfo = null;
			try {
				$this->$testMethodName();
				$succeededTests++;
			} catch (FailedTestException $e) {
				$failInfo = $e->getMessage();
			}
			
			$this->testResults[] = [
				'succeeded' => is_null($failInfo),
				'name' => $testName,
				'comment' => $testInfo,
				'failInfo' => $failInfo
			];
		}
		
		self::sectionStart(self::trimPHPDoc($reflector->getDocComment()) ?? $reflector->name, $succeededTests / $testsCount * 100);
		$this->printResults();
		self::sectionEnd();
	}
	
	private static function trimPHPDoc(string|bool $str): ?string {
		if (!$str) return null;
		
		$lines = explode("\n", $str);
		for ($i = 0; $i < count($lines); $i++) {
			$line = trim($lines[$i]);
			$line = trim($line, "/* ");
			$lines[$i] = $line;
		}
		
		$lines = array_filter($lines, fn($line) => $line !== "");
		return implode("<br>", $lines);
	}
	
	private static function sectionStart(string $name, float $successPercent): void {
		$c = ++self::$sectionCount;
		
		print <<<HTML
			<section style="animation-delay: ${c}s">
				<div class="title">
					<span class="collapsed"></span>
					<div>$name</div>
					<hr />
					<div class="progress" style="--progress-success: $successPercent%;"></div>
				</div>
				
				<div class="content" style="height: 0;">
					<table>
		HTML;
	}
	
	private static function sectionEnd(): void {
		print <<<HTML
					</table>
				</div>
			</section>
		HTML;
	}
	
	private function printResults(): void {
		$testResultsCount = count($this->testResults);
		$padLength = (int)log10($testResultsCount) + 1;
		
		for ($i = 0; $i < $testResultsCount; $i++) {
			$testResult = $this->testResults[$i];
			$testNumber = str_pad((string)($i + 1), $padLength, "0", STR_PAD_LEFT);
			
			if ($testResult['succeeded']) {
				$icon = "&check;";
				$status = "s";
			} else {
				$icon = "&times;";
				$status = "f";
			}
			
			print <<<HTML
			<tr>
				<td class="icon" data-icon="$status" data-info="{$testResult['failInfo']}">$icon</td>
				<td class="number">$testNumber</td>
				<td class="name">{$testResult['name']}</td>
				<td class="info" data-info="{$testResult['comment']}">?</td>
			</tr>
		HTML;
		}
	}
}
