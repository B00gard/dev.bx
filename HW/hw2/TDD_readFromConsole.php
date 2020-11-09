<?php

function readFromConsole(string $question, string $test_input = null)
{
	if ($question !== '')
	{
		echo $question.': ';
	}

	$input = $test_input=== null ? trim(fgets(STDIN)): $test_input;

	switch ($input)
	{
		case '':
			return '';

		case '!stop':
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
