<?php

function assertEquals($expectedResult, $result, string $message) : string
{
	if ($result === $expectedResult)
	{
		return $message.' - passed';
	}
	return $message.' - failed';
}
