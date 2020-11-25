<?php

require_once('classQueen.php');
require_once('readFromConsole.php');

function canMoveQueen(array $coordinates = null): string
{
	// Чтение данных от пользователя
	if ($coordinates == null)
	{
		$coordinates = readFromConsole("Введите координаты текущего положения Ферзя (номер столбца, номер строки) и положения на которое хотите передвинуть (номер столбца, номер строки)\n");
		$coordinates = explode(' ', $coordinates);
		$coordinates = array_map(function($num){return (int)$num;}, $coordinates);
	}

	// Проверка данных на валидность
	if (count($coordinates) !== 4)
	{
		return 'Введено слишком много или мало координат, попробуйте еще раз'; # .PHP_EOL;
		#return canMoveQueen();
	}
	foreach ($coordinates as $num)
	{
		if($num <=0 || $num > 8)
		{
			return 'Неправильно введены данные для координат, попробуйте еще раз'; # .PHP_EOL;
			#return canMoveQueen();
		}
	}

	// Проверка с помощью класса Queen можно ли переместить Ферзя из первого положения во второе
	$queen = new Queen($coordinates[0], $coordinates[1], '');
	return $queen->canMove($coordinates[2], $coordinates[3]);
}
