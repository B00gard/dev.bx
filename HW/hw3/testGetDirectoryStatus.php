<?php
include_once('getDirectoryStatus.php');
include_once('assertEquals.php');

function testGetDirectoryStatus()
{

	$testArray = [];
	echo assertEquals($testArray, getDirectoryStatus(),'Test1: не указан путь к директории').PHP_EOL;

	$testArray = [];
	echo assertEquals($testArray, getDirectoryStatus('abc'),'Test2: указан неверный путь к директории').PHP_EOL;

	$testArray = [
		'dirs'=> [],
		'files'=> [],
		];
	echo assertEquals($testArray, getDirectoryStatus('test\test2\empty'),'Test3: вывод содержимого папки empty').PHP_EOL;

	$testArray = [
		'dirs'=>[],
		'files'=>[
			'file5.php'=>['is_readable'=>'true', 'is_writable'=>'true', 'size'=>34,],
		],
		];
	echo assertEquals($testArray, getDirectoryStatus('test\test2\null'),'Test4: вывод содержимого папки null').PHP_EOL;

	$testArray = [
		'dirs'=>[
			'empty'=>['is_readable'=>'true', 'is_writable'=>'true',],
			'null'=>['is_readable'=>'true', 'is_writable'=>'true',],
		],
		'files'=>[
			'file3.php'=>['is_readable'=>'true', 'is_writable'=>'true','size'=>71,],
		]
		];
	echo assertEquals($testArray, getDirectoryStatus('test\test2'),'Test5: вывод содержимого папки test2').PHP_EOL;

	$testArray = [
		'dirs'=>[
			'0'=>['is_readable'=>'true', 'is_writable'=>'true',],
			'false'=>['is_readable'=>'true', 'is_writable'=>'true',],
			'test2'=>['is_readable'=>'true', 'is_writable'=>'true',],
			],
		'files'=>[
			'file1.php'=>['is_readable'=>'true', 'is_writable'=>'true', 'size'=>290,],
			'file2.php'=>['is_readable'=>'true', 'is_writable'=>'true','size'=>114,],
			'null.php'=>['is_readable'=>'true', 'is_writable'=>'true','size'=>62,],
		],
		];
	echo assertEquals($testArray, getDirectoryStatus('test'),'Test6: вывод содержимого папки test').PHP_EOL;

	$testArray = [
		'dirs'=>[
			'test'=>['is_readable'=>'true', 'is_writable'=>'true',],
		],
		'files'=>[
			'assertEquals.php'=>['is_readable'=>'true', 'is_writable'=>'true','size'=>199,],
			'file4.php'=>['is_readable'=>'true', 'is_writable'=>'true','size'=>187,],
			'getDirectoryStatus.php'=>['is_readable'=>'true', 'is_writable'=>'true','size'=>1350,],
			'testGetDirectoryStatus.php'=>['is_readable'=>'true', 'is_writable'=>'true','size'=>2997,],
		],
		];
	echo assertEquals($testArray, getDirectoryStatus('.'),'Test7: вывод содержимого папки hw3').PHP_EOL;

	$testArray = [
		'dirs'=>[
			'hw1'=>['is_readable'=>'true', 'is_writable'=>'true',],
			'hw2'=>['is_readable'=>'true', 'is_writable'=>'true',],
			'hw3'=>['is_readable'=>'true', 'is_writable'=>'true',],
		],
		'files'=>[],
		];
	echo assertEquals($testArray, getDirectoryStatus('..'),'Test8: вывод содержимого папки HW').PHP_EOL;

	$testArray = [];
	echo assertEquals($testArray, getDirectoryStatus('test\file1.php'),'Test9: указан путь к файлу, вместо папки').PHP_EOL;

}

testGetDirectoryStatus();
