<?php

namespace LightTest;

use LightTest\Template\Functions;

class Runner
{
    /**
     * @param UnitTest $testClass the test class containing methods for tests derived from `UnitTest`
     */
    public static function withoutAnimation(UnitTest ...$testClasses)
    {
        Functions::pageStart();
        foreach ($testClasses as $testClass) $testClass->run();
        Functions::pageEnd();
    }

    public static function withAnimation(UnitTest ...$testClasses)
    {
        Functions::pageStart(true);
        foreach ($testClasses as $testClass) $testClass->run();
        Functions::pageEnd();
    }
}
