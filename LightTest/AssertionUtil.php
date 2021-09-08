<?php

namespace LightTest;

use LightTest\Exception\FailedTestException;

trait AssertionUtil
{
	protected static function expect(mixed $input, mixed $expectation): void
	{
		if ($input != $expectation) throw new FailedTestException("$input != $expectation");
	}
	
	protected static function expectExact(mixed $input, mixed $expectation): void
	{
		if ($input !== $expectation) throw new FailedTestException("$input !== $expectation");
	}
}