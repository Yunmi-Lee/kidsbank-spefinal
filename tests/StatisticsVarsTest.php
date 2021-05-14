<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

	include 'statistics_vars.php';

	class StatisticsVarsTest extends TestCase
	{
		public function testIfGoalVarsWellInitialed()
		{
			$this->assertSame(0, $GLOBALS['comp_total']);
			$this->assertSame(0, $GLOBALS['goal_total']);
			$this->assertSame(0, $GLOBALS['active_total']);
			$this->assertSame(0, $GLOBALS['current_total']);
			$this->assertSame(0, $GLOBALS['left_total']);
			$this->assertSame(0, $GLOBALS['total_amount']);
			$this->assertSame(0, $GLOBALS['saved_total_p_goal']);
			$this->assertSame(1, $GLOBALS['inx']);
		}

        public function testIfTransVarsWellInitialed()
        {
			$this->assertSame(0, $GLOBALS['saved_total']);
			$this->assertSame(0, $GLOBALS['minus_total']);
			$this->assertSame(0, $GLOBALS['trans_total']);
			$this->assertSame(0, $GLOBALS['balance']);
			$this->assertSame(0, $GLOBALS['avg_trans']);
        }
	}
			
?>