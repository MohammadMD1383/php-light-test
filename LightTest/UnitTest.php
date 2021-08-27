<?php

namespace LightTest;

use ReflectionClass;

abstract class UnitTest
{
	private int $testNumber = 0;
	
	private function printResult($color, $message)
	{
		print "<div>$message</div>";
	}
	
	public function runTests(): void
	{
		$reflect = new ReflectionClass($this);
		$testMethods = array_filter($reflect->getMethods(), function ($value) {
			return str_starts_with($value->name, "test_");
		});
		
		foreach ($testMethods as $testMethod) {
			$this->testNumber++;
			$reason = "";
			$methodName = $testMethod->name;
			$testName = substr($methodName, 5);
			
			try {
				$this->$methodName($reason);
				$this->printResult("green", "#$this->testNumber | Test($testName) Passed!");
			} catch (TestException $e) {
				$this->printResult("red", "#$this->testNumber | Test($testName) Failed: $e->reason");
			}
		}
	}
	
	protected function expect($input, $expectation): void
	{
		if ($input != $expectation) throw new TestException("$input != $expectation");
	}
	
	protected function expectExact($input, $expectation): void
	{
		if ($input !== $expectation) throw new TestException("$input !== $expectation");
	}
}