<?php

namespace LightTest;

use LightTest\Exception\FailedTestException;

trait AssertionUtil
{
	protected static function assertEqual(
		mixed $input,
		mixed $expectation,
		callable $comparator = null,
		string $message = null
	): void {
		$comparator ??= fn ($a, $b) => $a == $b;
		$message ??= "$input != $expectation";

		if (!$comparator($input, $expectation)) throw new FailedTestException($message);
	}

	protected static function assertExactlyEqual(
		mixed $input,
		mixed $expectation,
		callable $comparator = null,
		string $message = null
	): void {
		$comparator ??= fn ($a, $b) => $a === $b;
		$message ??= "$input !== $expectation";

		if (!$comparator($input, $expectation)) throw new FailedTestException($message);
	}

	protected static function assertTrue(
		bool $result,
		string $message
	) {
		if (!$result) throw new FailedTestException($message);
	}
}
