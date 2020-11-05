<?php

// считать произвольное количество чисел от пользователя
// сложить их, вывести результат

require_once("readFromConsole.php");

function Sum($sum)
{
	$input = true;

	while ($input !== null)
	{
		$input = readFromConsole('Введите число');
		if (is_numeric($input))
		{
			$sum += $input;
		}
	}
	return $sum;
}

$sum = 0;
echo 'Результат сложения чисел: '.Sum($sum);