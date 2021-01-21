<?php

require_once("../lib/diffToolClass.php");
require_once("../lib/pageClass.php");
require_once("../lib/db_config.php");

$text1 = $_POST['text1'] ?? '';
$text2 = $_POST['text2'] ?? '';

$t = DiffTool::compareTexts($text1, $text2);

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

$pageName = 'DBpages/1.html';
$sha = 'none';
extract(createPathPage($t));

function insert(string $pageName, string $sha)
{
	$mysqli = new mysqli(HOSTNAME, USERNAME, PASSWORD, DATABASE);
	$date = date('Y-n-j');
	$time = date("H:i:s");
	$query = "INSERT INTO diff_tool (LINK, DATE, TIME, SHA_1_FILE) VALUES ('{$pageName}', '{$date}', '{$time}', '{$sha}')";
	$mysqli->query($query);
	$mysqli->close();
}

insert($pageName, $sha);
