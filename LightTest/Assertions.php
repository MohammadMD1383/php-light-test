<?php

namespace LightTest;

use LightTest\Error\FailedTestException;

trait Assertions {
	/**
	 * @throws FailedTestException
	 */
	protected static function assertEquality(
		mixed    $actual,
		mixed    $expected,
		string   $message = null,
		callable $comparator = null
	): void {
		$comparator ??= fn($x, $y) => $x == $y;
		$message ??= "$actual != $expected<br>(actual) != (expected)";
		
		if (!$comparator($actual, $expected))
			throw new FailedTestException($message);
	}
	
	/**
	 * @throws FailedTestException
	 */
	protected static function assertExactEquality(
		mixed    $actual,
		mixed    $expected,
		string   $message = null,
		callable $comparator = null
	): void {
		$comparator ??= fn($x, $y) => $x === $y;
		$message ??= "$actual !== $expected<br>(actual) !== (expected)";
		
		if (!$comparator($actual, $expected))
			throw new FailedTestException($message);
	}
	
	/**
	 * @throws FailedTestException
	 */
	protected static function assertGreaterThan(
		int|float $actual,
		int|float $expected,
		string    $message = null
	): void {
		$message ??= "$actual <= $expected<br>(actual) <= (expected)";
		
		if ($actual <= $expected)
			throw new FailedTestException($message);
	}
	
	/**
	 * @throws FailedTestException
	 */
	protected static function assertGreaterThanOrEqual(
		int|float $actual,
		int|float $expected,
		string    $message = null
	): void {
		$message ??= "$actual < $expected<br>(actual) < (expected)";
		
		if ($actual < $expected)
			throw new FailedTestException($message);
	}
	
	/**
	 * @throws FailedTestException
	 */
	protected static function assertLessThan(
		int|float $actual,
		int|float $expected,
		string    $message = null
	): void {
		$message ??= "$actual >= $expected<br>(actual) >= (expected)";
		
		if ($actual >= $expected)
			throw new FailedTestException($message);
	}
	
	/**
	 * @throws FailedTestException
	 */
	protected static function assertLessThanOrEqual(
		int|float $actual,
		int|float $expected,
		string    $message = null
	): void {
		$message ??= "$actual > $expected<br>(actual) > (expected)";
		
		if ($actual > $expected)
			throw new FailedTestException($message);
	}
	
	/**
	 * @throws FailedTestException
	 */
	protected static function assertTrue(
		bool   $actual,
		string $message = null
	): void {
		$message ??= "(actual) is not evaluated to true";
		
		if (!$actual)
			throw new FailedTestException($message);
	}
	
	/**
	 * @throws FailedTestException
	 */
	protected static function assertFalse(
		bool   $actual,
		string $message = null
	): void {
		$message ??= "(actual) is not evaluated to false";
		
		if ($actual)
			throw new FailedTestException($message);
	}
}
