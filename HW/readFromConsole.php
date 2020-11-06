<?php

function readFromConsole(string $question)
{
	echo $question.': ';
	$input = trim(fgets(STDIN));

	switch ($input)
	{
		case '':
			return null;

		case 'true':
			return true;

		case 'false':
			return false;

		case is_numeric($input):
			return +$input;

		default:
			return (string)$input;
	}
}