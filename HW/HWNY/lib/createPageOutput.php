<?php

function createPage(array $texts, string $pageName)
{
	$f = fopen($pageName, 'w');

	fwrite($f, Page::header());
	echo Page::header();

	fwrite($f, Page::beforeText());
	echo Page::beforeText();

	$text1 = DiffTool::colorText($texts['text1']);
	echo $text1;

	echo Page::betweenTexts();

	$text2 = DiffTool::colorText($texts['text2']);
	echo $text2;

	echo Page::afterText();

	fwrite($f, "			$text1");
	fwrite($f, Page::betweenTexts());
	fwrite($f, "			$text2");
	fwrite($f, Page::afterText());

	fclose($f);
}

function createPathPage($texts): array
{
	try
	{
		$rand = (string)random_int(1, 100);
	}
	catch (Exception $e)
	{
		$rand = rand(1, 100);
	}

	$pageName = "DBpages/$rand.html";
	$path = "../".$pageName;

	createPage($texts, $path);

	$sha = sha1_file($path);
	$newPageName = "DBpages/$sha$rand.html";
	$newPath = "../".$newPageName;

	rename($path, $newPath);
	return ['pageName'=>$newPageName, 'sha'=>$sha];
}