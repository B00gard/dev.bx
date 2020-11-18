<?php

// универсальная функция по чтению и анализу директорий и файлов с обязательным тестом.
// принимает один параметр - путь до папки
// результат работы - массив директорий и файлов, содержащий анализ элементов


function getDirectoryStatus(string $pathToDirectory = null):array
{
	if (!is_dir($pathToDirectory))
	{
		return [];
	}

	$filesAndDir = ['dirs'=>[], 'files'=>[],];
	$directory = opendir($pathToDirectory);
	while (True)
	{
		$element = readdir($directory);
		if ($element === false)
		{
			break;
		}

		if (in_array($element, ['.', '..'], true))
		{
			continue;
		}

		$fullPathToElement = $pathToDirectory.'\\'.$element;
		if (is_dir($fullPathToElement))
		{
			$filesAndDir['dirs'][$element] = [
				'is_readable'=> is_readable($fullPathToElement)?'true':'false',
				'is_writable'=>is_writable($fullPathToElement)?'true':'false',
				];
		}
		elseif (is_file($fullPathToElement))
		{
			$filesAndDir['files'][$element] = [
				'is_readable'=> is_readable($fullPathToElement)?'true':'false',
				'is_writable'=>is_writable($fullPathToElement)?'true':'false',
				'size'=>filesize($fullPathToElement),
			];
		}

	}
	closedir($directory);
	return $filesAndDir;
}
