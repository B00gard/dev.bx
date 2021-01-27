<?php

require_once("../config/db_config.php");

function insert(string $pageName, string $sha)
{
	$mysqli = new mysqli(HOSTNAME, USERNAME, PASSWORD, DATABASE);
	$date = date('Y-n-j');
	$time = date("H:i:s");
	$query = "INSERT INTO diff_tool (LINK, DATE, TIME, SHA_1_FILE) VALUES ('{$pageName}', '{$date}', '{$time}', '{$sha}')";
	$mysqli->query($query);
	$mysqli->close();
}

