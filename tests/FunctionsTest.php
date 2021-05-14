<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

	include 'functions.php';

	class FunctionsTest extends TestCase
	{
        /**
         * @dataProvider additionProvider
         */
        public function testAdd(int $a, int $b, int $expected): void
        {
            $this->assertSame($expected, addNumbers($a, $b));
        }

        public function additionProvider(): array
        {
            return [
                [0, 0, 0],
                [0, 1, 1],
                [1, 0, 1],
                [1, 2, 3]
            ];
        }

        /**
         * @dataProvider minusProvider
         */
        public function testMinus(int $a, int $b, int $expected): void
        {
            $this->assertSame($expected, minusNumbers($a, $b));
        }

        public function minusProvider(): array
        {
            return [
                [0, 0, 0],
                [0, 1, -1],
                [1, 0, 1],
                [1, 2, -1]
            ];
        }

        /**
         * @dataProvider progressProvider
         */
        public function testProgress(int $a, int $b, float $expected): void
        {
            $this->assertSame($expected, round(getProgress($a, $b)));
        }

        public function progressProvider(): array
        {
            return [
                [10, 100, 10.0],
                [5, 10, 50.0],
                [2, 22, 9.0],
                [4, 400, 1.0]
            ];
        }

	}
			
?>