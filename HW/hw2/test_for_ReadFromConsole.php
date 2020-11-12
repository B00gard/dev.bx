<?php

require_once('TDD_readFromConsole.php');
require_once ('assertEquals.php');

function testReadFromConsole()
{
	$result = readFromConsole('', 'true');
	echo assertEquals(true, $result, 'Test1 "true" = true').PHP_EOL;
	$result = readFromConsole('', 'false');
	echo assertEquals(false, $result, 'Test2 "false" = false').PHP_EOL;
	$result = readFromConsole('', '!stop');
	echo assertEquals(null, $result, 'Test3 "!stop" = null').PHP_EOL;
	$result = readFromConsole('', '1.3');
	echo assertEquals(1.3, $result, 'Test4 "1.3" = 1.3').PHP_EOL;
	$result = readFromConsole('', '1');
	echo assertEquals(1, $result, 'Test5 "1" = 1').PHP_EOL;
	$result = readFromConsole('', 'test');
	echo assertEquals('test', $result, 'Test6 "test" = "test"').PHP_EOL;

	$result = readFromConsole('', 'null');
	echo assertEquals('null', $result, 'Test7 "null" = "null":').PHP_EOL;
	$result = readFromConsole('', '');
	echo assertEquals('', $result, 'Test8 "" = "":').PHP_EOL;
	$result = readFromConsole('', '0');
	echo assertEquals(0, $result, 'Test9 "0" = 0:').PHP_EOL;
	$result = readFromConsole('', '1');
	echo assertEquals(1, $result, 'Test10 "1" = 1:').PHP_EOL;
}

testReadFromConsole();
