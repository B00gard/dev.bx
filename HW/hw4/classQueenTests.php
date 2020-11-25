<?php

require_once('assertEquals.php');
require_once('moveQueen.php');

function queenTests()
{
	$coordinate = [7, 8, 4, 5];
	echo assertEquals('YES', canMoveQueen($coordinate),
				 'Перемещение из позиции (7,8) в позицию (4,5) [диагональ]').PHP_EOL;

	$coordinate = [4, 5, 2,7];
	echo assertEquals('YES', canMoveQueen($coordinate),
					  'Перемещение из позиции (4,5) в позицию (2,7) [диагональ]').PHP_EOL;

	$coordinate = [1, 1, 1, 8];
	echo assertEquals('YES', canMoveQueen($coordinate),
					  'Перемещение из позиции (1,1) в позицию (1,8) [вертикаль]').PHP_EOL;

	$coordinate = [1, 1, 8, 1];
	echo assertEquals('YES', canMoveQueen($coordinate),
					  'Перемещение из позиции (1,1) в позицию (8,1) [горизонталь]').PHP_EOL;

	$coordinate = [1, 1, 7, 2];
	echo assertEquals('NO', canMoveQueen($coordinate),
					  'Перемещение из позиции (1,1) в позицию (7,2) [нельзя]').PHP_EOL;

	$coordinate = [1, 1, 0, -7];
	echo assertEquals('Неправильно введены данные для координат, попробуйте еще раз', canMoveQueen($coordinate),
					  'Перемещение из позиции (1,1) в позицию (0,-7) [выведется сообщение, что неверно введены данные]').PHP_EOL;
	$coordinate = [1, 1, 0, -7, 5];
	echo assertEquals('Введено слишком много или мало координат, попробуйте еще раз', canMoveQueen($coordinate),
					  'Перемещение из позиции (1,1) в позицию (0,-7,5) [выведется сообщение, что передано много/мало координат]').PHP_EOL;
}

queenTests();