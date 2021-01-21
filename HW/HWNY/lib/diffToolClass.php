<?php

class DiffTool
{
	private const DELETE = 'red';
	private const ADD = 'green';
	private const CHANGED = 'yellow';
	private const NONE = 'none';
	private const SEPARATORS = '.!?';

	private static function explodeText(string $text): array
	{
		$explodedText = [];
		while ($text != '')
		{
			// длина до разделителя, +1 сам разделитель
			$position = strcspn($text, self::SEPARATORS) + 1;
			if ($text[$position] === ' ')
			{
				$position += 1;
			}
			$explodedText[] = substr($text, 0, $position);
			$text = substr($text, $position);
		}
		return $explodedText;
	}

	private static function reduce(int $beforeKey, array $check): array
	{
		$resultForText2 = [];
		foreach ($check as $key => $sentence)
		{
			if ($key === $beforeKey)
			{
				$resultForText2[] = ['sentence'=> $sentence, 'status'=> self::CHANGED];
				unset($check[$key]);
				break;
			}
			$resultForText2[] = ['sentence'=>$sentence, 'status'=>self::ADD];
			unset($check[$key]);
		}
		return ['for text 2'=>$resultForText2,
				'check'=> $check,
			];
	}

	private static function checkChanges(string $sentence, array $check): array
	{
		foreach ($check as $key => $value)
		{
			similar_text($value, $sentence, $percent);
			if ($percent > 50)
			{
				// если найдено предложение, уменьшить $check, выдав статус ADD всем предложениям до $value
				$t = self::reduce($key, $check);
				return ['check'=>$t['check'],
						'for text 1' => [['sentence'=> $sentence, 'status'=> self::CHANGED]],
						'for text 2' => $t['for text 2'],
				];
			}
		}
		return ['check' => $check,
				'for text 1' => [['sentence'=> $sentence, 'status'=> self::DELETE]],
				'for text 2' => [],
		];
	}

	private static function compareParts(int $keyIn1, array $text1, array $check): array
	{
		$resultForText1 = [];
		$resultForText2 = [];
		foreach ($text1 as $key => $sentence)
		{
			if ($key === $keyIn1)
			{
				$resultForText1[] = ['sentence'=>$sentence,'status'=> self::NONE];
				break;
			}
			// поиск в $check похожего на $sentence предложения
			$t = self::checkChanges($sentence, $check);
			$check = $t['check'];
			$resultForText1 = array_merge($resultForText1, $t['for text 1']);
			$resultForText2 = array_merge($resultForText2, $t['for text 2']);
		}
		return ['for text 1' => $resultForText1,
				'for text 2' => $resultForText2,
				'check' => $check,
		];
	}

	private static function checkText2 (array $text1, array $text2): array
	{
		$resultComparisonText1 = [];
		$resultComparisonText2 = [];
		$checkForChanges = [];

		foreach ($text2 as $checkingSentence)
		{
			$keyIn1 = array_search($checkingSentence, $text1);
			if ($keyIn1 === false)
			{
				$checkForChanges[] = $checkingSentence;
				continue;
			}
			// сравнение куска текста1 до общего предложения($keyIn1), с куском текста2 ($checkForChanges)
			$t = self::compareParts($keyIn1, $text1, $checkForChanges);
			$resultComparisonText1 = array_merge($resultComparisonText1, $t['for text 1']);
			$resultComparisonText2 = array_merge($resultComparisonText2, $t['for text 2']);
			$checkForChanges = $t['check'];

			foreach ($checkForChanges as $key => $sentence)
			{
				$resultComparisonText2[] = ['sentence'=> $sentence, 'status' => self::ADD];
				unset($checkForChanges[$key]);
			}

			$resultComparisonText2[] = ['sentence'=> $checkingSentence, 'status' => self::NONE];
			$text1 = array_slice($text1, $keyIn1+1);
		}

		return [
			'text1'=>$text1,
			'check' => $checkForChanges,
			'for text 1' => $resultComparisonText1,
			'for text 2' => $resultComparisonText2,
		];
	}

	public static function compareTexts(string $text1, string $text2): array
	{
		$text1 = self::explodeText($text1);
		$text2 = self::explodeText($text2);

		// проверка всех предложение текста2 на схожесть с предложениями текста1
		$t = self::checkText2($text1, $text2);
		$text1 = $t['text1'];
		$checkForChanges = $t['check'];
		$resultComparisonText1 = $t['for text 1'];
		$resultComparisonText2 = $t['for text 2'];

		foreach ($text1 as $sentence)
		{
			$t = self::checkChanges($sentence, $checkForChanges);
			$checkForChanges = $t['check'];
			$resultComparisonText1 = array_merge($resultComparisonText1, $t['for text 1']);
			$resultComparisonText2 = array_merge($resultComparisonText2, $t['for text 2']);
		}

		$t = self::reduce(array_key_last($checkForChanges) + 1, $checkForChanges);
		$resultComparisonText2 = array_merge($resultComparisonText2, $t['for text 2']);

		return [
			'text1' => $resultComparisonText1,
			'text2' => $resultComparisonText2,
		];
	}


	private static function colorPart(string $text, string $color): string
	{
		// обертка текста в нужный цвет
		$text = htmlspecialchars($text);
		$text = nl2br($text);
		return "<span class='$color'>$text</span>";
	}

	public static function colorText(array $text):string
	{
		$returnText = [];
		$part = '';
		$status = $text[0]['status'] ?? '';

		foreach ($text as $sentence)
		{
			if ($sentence['status'] !== $status)
			{
				$returnText[] = self::colorPart($part, $status);
				$status = $sentence['status'];
				$part = $sentence['sentence'];
				continue;
			}
			$part .= $sentence['sentence'];
		}

		$returnText[] = $part !== '' ? self::colorPart($part, $status) : '';
		return join('', $returnText);
	}
}