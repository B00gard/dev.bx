<?php

class Queen
{
	private $column;
	private $row;
	private $color;

	public function __construct(int $column, int $row, string $color)
	{
		if ($column > 0 && $column <= 8 && $row > 0 && $row <= 8)
		{
			$this->column = $column;
			$this->row = $row;
		}
		if (in_array($color, ['w', 'b'], true))
		{
			$this->color = $color;
		}
		else
		{
			$this->color = 'w';
		}
	}

	private function setPosition(int $column, int $row)
	{
		$this->column = $column;
		$this->row = $row;
	}

	public function getPosition(): array
	{
		return ['column'=>$this->column, 'row'=> $this->row];
	}

	public function getColor(): string
	{
		return $this->color;
	}

	public function canMove(int $newColumn, int $newRow): string
	{
		if ($newColumn <= 0 && $newColumn > 8 && $newRow <= 0 && $newRow > 8)
		{
			return 'NO';
		}

		if (abs($this->column - $newColumn) == abs($this->row - $newRow))
		{
			return 'YES';
		}

		if ($newColumn != $this->column && $newRow != $this->row)
		{
			return 'NO';
		}

		return 'YES';
	}

	public function move(int $newColumn, int $newRow)
	{
		if ($this->canMove($newColumn, $newRow) === 'YES')
		{
			$this->setPosition($newColumn, $newRow);
		}
	}

}
