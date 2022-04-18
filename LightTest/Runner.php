<?php

namespace LightTest;

use LightTest\Template\Functions;

class Runner {
	public static function run(bool $enableAnimations, UnitTest ...$tests): void {
		Functions::pageStart($enableAnimations);
		foreach ($tests as $test) $test->run();
		Functions::pageEnd();
	}
}
