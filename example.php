<?php

use LightTest\UnitTest;
use LightTest\Template\Functions;

spl_autoload_register();

// @formatter:off
class MyTestCase extends UnitTest
{
	/**
	 * Test Information on this method
	 */
	public function test_test_number_1() { self::expectExact(12, 12); }
	public function test_test_number_2() { self::expectExact(13, 6); }
	public function test_test_number_3() { self::expectExact(14, 14); }
	public function test_test_number_4() { self::expectExact(15, 6); }
	public function test_test_number_5() { self::expectExact(16, 33); }
	public function test_test_number_7() { self::expectExact(18, 18); }
	public function test_test_number_10() { self::expectExact(21, 66); }
	public function test_test_number_13() { self::expectExact(24, 63); }
	public function test_test_number_14() { self::expectExact(25, 23); }
	public function test_test_number_15() { self::expectExact(26, 96); }
}

class MySomeAnotherTest extends MyTestCase {}

class AGoodTestClass extends MyTestCase {}
// @formatter:on

Functions::pageStart();
$test1 = new MyTestCase();
$test2 = new MySomeAnotherTest();
$test3 = new AGoodTestClass();
$test1->run();
$test2->run();
$test3->run();
Functions::pageEnd();
