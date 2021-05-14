<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

	include 'statistics_vars.php';

	class ChartArrayTest extends TestCase
	{
		public function testChartArraySize()
		{
            $this->assertSame(20, count($GLOBALS['chart']));
		}
        /**
         * @depends testChartArraySize
         */
        public function testChartPush()
        {
            array_push($GLOBALS['chart'], 'foo');
            $this->assertSame('foo', $GLOBALS['chart'][count($GLOBALS['chart'])-1]);
            $this->assertNotEmpty($GLOBALS['chart']);

        }

        /**
         * @depends testChartPush
         */
        public function testChartPop()
        {
            $this->assertSame('foo', array_pop($GLOBALS['chart']));
            $this->assertNotEmpty($GLOBALS['chart']);
        }
	}
			
?>