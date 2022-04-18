<?php

require_once 'LightTest/autoload.php';

use LightTest\Runner;
use LightTest\UnitTest;

/** Test Group */
class MyTestCase extends UnitTest {
	/**
	 * Test Information on this method
	 */
	public function test_test_number_1() {
		self::assertExactEquality(12, 12);
	}
	
	public function test_test_number_2() {
		self::assertGreaterThan(13, 6);
	}
	
	public function test_test_number_3() {
		self::assertExactEquality(14, 14);
	}
	
	public function test_test_number_4() {
		self::assertLessThan(15, 6);
	}
	
	public function test_test_number_5() {
		self::assertLessThanOrEqual(16, 33);
	}
	
	public function test_test_number_6() {
		self::assertExactEquality(18, 18);
	}
	
	public function test_test_number_7() {
		self::assertExactEquality(21, 66);
	}
	
	public function test_test_number_8() {
		self::assertExactEquality(24, 63);
	}
	
	public function test_test_number_9() {
		self::assertTrue(false);
	}
	
	public function test_test_number_10() {
		self::assertExactEquality(26, 26);
	}
	
	public function test_test_number_11() {
		self::assertExactEquality(28, '28');
	}
}

Runner::run(
	false,
	new MyTestCase(),
	/** Anonymous Test Group */
	new class extends UnitTest {
		public function test_equality() {
			self::assertExactEquality(1, 2);
		}
		
		/**
		 * some expectations here
		 */
		public function test_greaterThan() {
			self::assertGreaterThan(2, 1);
		}
	},
	new class extends UnitTest {
		/**
		 * Information
		 * Multiline
		 */
		public function test_someTest() {
			self::assertExactEquality(2, 4, comparator: fn($a, $b) => $a ** 2 === $b);
		}
	}
);
