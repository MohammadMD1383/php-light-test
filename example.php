<?php

use LightTest\Runner;
use LightTest\UnitTest;

spl_autoload_register(fn (string $str) => require_once str_replace("\\", "/", $str) . ".php");

class MyTestCase extends UnitTest
{
	/**
	 * Test Information on this method
	 */
	public function test_test_number_1()
	{
		self::assertExactlyEqual(12, 12);
	}
	public function test_test_number_2()
	{
		self::assertExactlyEqual(13, 6);
	}
	public function test_test_number_3()
	{
		self::assertExactlyEqual(14, 14);
	}
	public function test_test_number_4()
	{
		self::assertExactlyEqual(15, 6);
	}
	public function test_test_number_5()
	{
		self::assertExactlyEqual(16, 33);
	}
	public function test_test_number_7()
	{
		self::assertExactlyEqual(18, 18);
	}
	public function test_test_number_10()
	{
		self::assertExactlyEqual(21, 66);
	}
	public function test_test_number_13()
	{
		self::assertExactlyEqual(24, 63);
	}
	public function test_test_number_14()
	{
		self::assertExactlyEqual(25, 23);
	}
	public function test_test_number_15()
	{
		self::assertExactlyEqual(26, 96);
	}
}

Runner::withoutAnimation(
	new MyTestCase(),
	new class extends UnitTest
	{
		public function test_someTest()
		{
			self::assertExactlyEqual(1, 2);
		}
	},
	new class extends UnitTest
	{
		/**
		 * Information
		 * Multiline
		 */
		public function test_someTest()
		{
			self::assertExactlyEqual(2, 4, fn($a, $b) => $a ** 2 === $b, "2^2 !== 5");
		}
	}
);
