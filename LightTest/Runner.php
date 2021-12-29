<?php

namespace LightTest;

use LightTest\Template\Functions;

class Runner
{
    /**
     * @param UnitTest $testClass the test class containing methods for tests derived from `UnitTest`
     */
    public function __construct(UnitTest ...$testClasses)
    {
        Functions::pageStart();
        foreach ($testClasses as $testClass) $testClass->run();
        Functions::pageEnd();
    }
}
