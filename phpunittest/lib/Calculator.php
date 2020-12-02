<?php
//Calculator.php

class Calculator
{
	public function add(int $a, int $b): int
	{
		return $a + $b;
	}

	public function subtract(int $a, int $b): int
	{
		return $a - $b;
	}

	public function multiply(int $a, int $b): int
	{
		return $a * $b;
	}

	public function divide(int $a, int $b): float
	{
		if($b === 0)
		{
			throw new InvalidArgumentException('Divider cant be a zero');
		}

		return $a / $b;
	}

	public function exponentiation(int $base, float $exp): float
	{
		return pow($base, $exp);
	}

	public function squareRoot(int $num): float
	{
		if ($num < 0)
		{
			throw new InvalidArgumentException('Cant calculate square root of negative number');
		}

		return sqrt($num);
	}

}