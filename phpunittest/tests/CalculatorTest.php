<?php
//CalculatorTest.php
use \PHPUnit\Framework\TestCase;
require_once (__DIR__ . '/../lib/Calculator.php');

class CalculatorTest extends TestCase
{
	public function addOkProviderData(): array
	{
		return [
			[3, 7, 10],
			[-5, 10, 5],
			[5, -10, -5],
			[-7, -3, -10],
		];
	}
	/**
	 * @dataProvider addOkProviderData
	 *
	 * @param int $a
	 * @param int $b
	 * @param int $result
	 */
	public function testAddOkProvider(int $a, int $b, int $result): void
	{
		$calculator = new Calculator();
		self::assertEquals($result, $calculator->add($a, $b));
	}

	public function subtractOkProviderData(): array
	{
		return [
			[17, 7, 10],
			[10, -5, 15],
			[-10, 5, -15],
			[-10, -5, -5],
		];
	}
	/**
	 * @dataProvider subtractOkProviderData
	 *
	 * @param int $a
	 * @param int $b
	 * @param int $result
	 */
	public function testSubtractOkProvider(int $a, int $b, int $result): void
	{
		$calculator = new Calculator();
		self::assertEquals($result, $calculator->subtract($a, $b));
	}

	public function multiplyOkProviderData(): array
	{
		return [
			[0, -5, 0],
			[5, 3, 15],
			[5, -3, -15],
			[-5, -3, 15],
		];
	}
	/**
	 * @dataProvider multiplyOkProviderData
	 *
	 * @param int $a
	 * @param int $b
	 * @param int $result
	 */
	public function testMultiplyOkProvider(int $a, int $b, int $result): void
	{
		$calculator = new Calculator();
		self::assertEquals($result, $calculator->multiply($a, $b));
	}

	public function divideOkProviderData(): array
	{
		return [
			[4, 2, 2],
			[0, 3, 0],
			[5, 5, 1],
			[5, -5, -1],
			[1, 2, 0.5],
			[1, 100000, 0.00001],
		];
	}
	/**
	 * @dataProvider divideOkProviderData
	 *
	 * @param int $a
	 * @param int $b
	 * @param float $result
	 */
	public function testDivideOkProvider(int $a, int $b, float $result): void
	{
		$calculator = new Calculator();
		self::assertEquals($result, $calculator->divide($a, $b));
	}

	public function exponentiationOkProviderData(): array
	{
		return [
			[0, 0, 1],
			[-7, 0, 1],
			[2, 2, 4],
			[-2, 2, 4],
			[9, 1/2, 3],
			[9, -1/2, 1/3],
		];
	}
	/**
	 * @dataProvider exponentiationOkProviderData
	 *
	 * @param int $a
	 * @param float $b
	 * @param float $result
	 */
	public function testExponentiationOkProvider(int $a, float $b, float $result): void
	{
		$calculator = new Calculator();
		self::assertEquals($result, $calculator->exponentiation($a, $b));
	}

	public function squareRootOkProviderData(): array
	{
		return [
			[4, 2],
			[0, 0],
			[1, 1],
			[19, sqrt(19)],
		];
	}
	/**
	 * @dataProvider squareRootOkProviderData
	 *
	 * @param int $a
	 * @param float $result
	 */
	public function testSquareRootOkProvider(int $a, float $result): void
	{
		$calculator = new Calculator();
		self::assertEquals($result, $calculator->squareRoot($a));
	}


	public function testDivideException(): void
	{
		$calculator = new Calculator();

		$this->expectException(InvalidArgumentException::class);
		$this->expectExceptionMessage('Divider cant be a zero');
		$calculator->divide(5, 0);
	}

	public function testSquareRootException(): void
	{
		$calculator = new Calculator();

		$this->expectException(InvalidArgumentException::class);
		$this->expectExceptionMessage('Cant calculate square root of negative number');
		$calculator->squareRoot(-4);
	}

	public function testExponentiationNAN(): void
	{
		$calculator = new Calculator();
		self::assertNan($calculator->exponentiation(-4, 1/2));
	}
}
