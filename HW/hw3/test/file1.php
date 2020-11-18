<?php

var_dump(file_exists(null));
var_dump(file_exists(false));
var_dump(file_exists(0));
var_dump(file_exists('null'));
var_dump(file_exists('0'));
var_dump(file_exists('false'));

echo filesize('file1.php').PHP_EOL;
echo filesize('file2.php').PHP_EOL;
echo filesize('null.php').PHP_EOL;