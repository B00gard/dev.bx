<?php

require_once("../lib/diffToolClass.php");
require_once("../lib/pageClass.php");
require_once("../lib/db_config.php");
require_once ("../lib/createPageOutput.php");

$text1 = $_POST['text1'] ?? '';
$text2 = $_POST['text2'] ?? '';

$t = DiffTool::compareTexts($text1, $text2);

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
