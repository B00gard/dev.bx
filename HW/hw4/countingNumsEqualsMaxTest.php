<?php

require_once('readFromConsole.php');
require_once('countingNumsEqualsMax.php');
require_once('assertEquals.php');

function testCountingNumsEqualsMax()
{
	# Тесты на передачу невалидных данных:
	$testArray = '';
	echo assertEquals(0, countingNumsEqualsMax(readFromConsole('',$testArray)), 'Передана пустая строка').PHP_EOL;
	$testArray = 'stop';
	echo assertEquals(0, countingNumsEqualsMax(readFromConsole('',$testArray)), 'Не указана последовательность, только слово "stop"').PHP_EOL;
	$testArray = '1 3 -3 1 3';
	echo assertEquals(0, countingNumsEqualsMax(readFromConsole('',$testArray)), 'Не указано слово "stop"').PHP_EOL;
	$testArray = '0 5 1.7 stop';
	echo assertEquals(0, countingNumsEqualsMax(readFromConsole('',$testArray)), 'Передано float число').PHP_EOL;
	$testArray = '5 3 -3 1 3 stop';
	echo assertEquals(0, countingNumsEqualsMax(readFromConsole('',$testArray)), 'Передано отрицательное число').PHP_EOL;
	$testArray = '6 true false stop';
	echo assertEquals(0, countingNumsEqualsMax(readFromConsole('',$testArray)), 'Какой-то из элементов последовательности не число').PHP_EOL;
	$testArray = '1 5 5 7 8 9 5 5 1 2 3 4 5 6 7 8 8 9 4 11 11 stop';
	echo assertEquals(0, countingNumsEqualsMax(readFromConsole('',$testArray)), 'Передано больше чем 20 чисел').PHP_EOL.PHP_EOL;

	# Тесты на правильность работы функции:
	$testArray = '1 7 9 stop';
	echo assertEquals(1, countingNumsEqualsMax(readFromConsole('',$testArray)),
					  'В последовательности 1 7 9 количество элементов равных наибольшему элементу = 1').PHP_EOL;
	$testArray = '1 3 1 3 stop';
	echo assertEquals(2, countingNumsEqualsMax(readFromConsole('',$testArray)),
					  'В последовательности 1 3 1 3 количество элементов равных наибольшему элементу = 2').PHP_EOL;
	$testArray = '3 3 3 1 3 stop';
	echo assertEquals(4, countingNumsEqualsMax(readFromConsole('',$testArray)),
					  'В последовательности 3 3 3 1 3 количество элементов равных наибольшему элементу = 4').PHP_EOL;
}

testCountingNumsEqualsMax();
