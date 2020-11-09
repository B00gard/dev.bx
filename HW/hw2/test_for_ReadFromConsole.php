<?php

require_once('TDD_readFromConsole.php');

function test_readFromConsole()
{
	$result = readFromConsole('', 'true');
	echo 'Test1 "true" = true:'.(($result === true) ? ' passed':' failed').PHP_EOL;
	$result = readFromConsole('', 'false');
	echo 'Test2 "false" = false:'.(($result === false) ? ' passed':' failed').PHP_EOL;
	$result = readFromConsole('', '!stop');
	echo 'Test3 "!stop" = null:'.(($result === null) ? ' passed':' failed').PHP_EOL;
	$result = readFromConsole('', '1.3');
	echo 'Test4 "1.3" = 1.3:'.(($result === 1.3) ? ' passed':' failed').PHP_EOL;
	$result = readFromConsole('', '1');
	echo 'Test5 "1" = 1:'.(($result === 1) ? ' passed':' failed').PHP_EOL;
	$result = readFromConsole('', 'test');
	echo 'Test6 "test" = "test":'.(($result === 'test') ? ' passed':' failed').PHP_EOL.PHP_EOL;

	$result = readFromConsole('', 'null');
	echo 'Test7 "null" = "null":'.(($result === 'null') ? ' passed':' failed').PHP_EOL;
	$result = readFromConsole('', '');
	echo 'Test8 "" = "":'.(($result === '') ? ' passed':' failed').PHP_EOL;
}

test_readFromConsole();