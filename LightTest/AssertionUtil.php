<?php

namespace LightTest;

use LightTest\Exception\FailedTestException;

trait AssertionUtil
{
	protected static function expect($input, $expectation): void
	{
		if ($input != $expectation) throw new FailedTestException("$input != $expectation");
	}
	
	protected static function expectExact($input, $expectation): void
	{
		if ($input !== $expectation) throw new FailedTestException("$input !== $expectation");
	}
}