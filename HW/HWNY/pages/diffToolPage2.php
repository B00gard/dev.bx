<?php

require_once("../lib/diffToolClass.php");
require_once("../lib/createPageOutput.php");
require_once("../lib/dataBaseFunctions.php");

$text1 = $_POST['text1'] ?? '';
$text2 = $_POST['text2'] ?? '';

$t = DiffTool::compareTexts($text1, $text2);

$pageName = 'DBpages/1.html';
$sha = 'none';
extract(createPathPage($t));

insert($pageName, $sha);
