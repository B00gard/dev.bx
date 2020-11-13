<?php

function readFromConsole(string $question, string $test_input = null)
{
	if ($question !== '')
	{
		echo $question.': ';
	}

	$input = $test_input ?? trim(fgets(STDIN));

	switch ($input)
	{
		case '!stop':
			return null;

		case 'true':
			return true;

		case 'false':
			return false;
	}

	if (is_numeric($input))
	{
		return +$input;
	}
	return (string)$input;

}
