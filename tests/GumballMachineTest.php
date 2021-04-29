<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

	require 'GumballMachine.php';

	class GumballMachineTest extends TestCase
	{
		public $gumballMachineInstance;

		public function setUp() : void
		{
			$this->gumballMachineInstance = new GumballMachine();
		}

		public function testIfWhellWorks()
		{
			$this->gumballMachineInstance->setGumballs(100);

			$this->gumballMachineInstance->turnWheel();

			$this->assertEquals(99, $this->gumballMachineInstance->getGumballs());
		}
	}
			
