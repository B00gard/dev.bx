<?php

# дана последовательность из НАТУРАЛЬНЫХ чисел, заканчивается командой STOP
# вводится НЕ БОЛЕЕ 20 чисел
# определить сколько элементов последовательности равны ее наибольшему элементу

# выход: ответ на задачу - одно число

require_once('readFromConsole.php');

function countingNumsEqualsMax(string $testArray = null):int
{
	$numbers = $testArray ?? readFromConsole('Введите последовательность натуральных чисел (не более 20), разделяя их пробелом.
Закончите ввод словом "stop" и нажмите enter для подтверждения отправки данных');
	$numbers = explode(' ', $numbers);

	if (count($numbers) <= 1 || count($numbers) > 21 || $numbers[count($numbers) - 1] !== 'stop')
	{
		return 0;
	}
	unset($numbers[count($numbers) - 1]);

	$maxNum = -1;
	$countMaxElements = 0;

	foreach($numbers as $num)
	{
		if (!is_numeric($num) || +$num < 0 || is_float(+$num))
		{
			return 0;
		}
		$num = (int)$num;

		if ($num > $maxNum)
		{
			$countMaxElements = 1;
			$maxNum = $num;
		}
		elseif ($num == $maxNum)
		{
			$countMaxElements += 1;
		}
	}
	return $countMaxElements;
}
