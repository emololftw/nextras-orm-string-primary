<?php declare(strict_types = 1);

namespace Nextras\Dbal\Drivers\Mysqli;


use mysqli_result;
use Nextras\Dbal\Drivers\IResultAdapter;
use Nextras\Dbal\Exception\InvalidArgumentException;
use Nextras\Dbal\Utils\StrictObjectTrait;


class MysqliResultAdapter implements IResultAdapter
{
	use StrictObjectTrait;


	/** @var array<int, int> */
	protected static $types = [
		MYSQLI_TYPE_TIME => self::TYPE_DRIVER_SPECIFIC,
		MYSQLI_TYPE_DATE => self::TYPE_DATETIME,
		MYSQLI_TYPE_DATETIME => self::TYPE_DATETIME,
		MYSQLI_TYPE_TIMESTAMP => self::TYPE_DRIVER_SPECIFIC | self::TYPE_DATETIME,

		MYSQLI_TYPE_BIT => self::TYPE_INT, // returned as int
		MYSQLI_TYPE_INT24 => self::TYPE_INT,
		MYSQLI_TYPE_INTERVAL => self::TYPE_INT,
		MYSQLI_TYPE_TINY => self::TYPE_INT,
		MYSQLI_TYPE_SHORT => self::TYPE_INT,
		MYSQLI_TYPE_LONG => self::TYPE_INT,
		MYSQLI_TYPE_LONGLONG => self::TYPE_INT,
		MYSQLI_TYPE_YEAR => self::TYPE_INT,

		MYSQLI_TYPE_DECIMAL => self::TYPE_FLOAT,
		MYSQLI_TYPE_NEWDECIMAL => self::TYPE_FLOAT,
		MYSQLI_TYPE_DOUBLE => self::TYPE_FLOAT,
		MYSQLI_TYPE_FLOAT => self::TYPE_FLOAT,

		MYSQLI_TYPE_STRING => self::TYPE_AS_IS,
	];

	/**
	 * @var mysqli_result
	 * @phpstan-var mysqli_result<array<mixed>>
	 */
	private $result;


	/**
	 * @phpstan-param mysqli_result<array<mixed>> $result
	 */
	public function __construct(mysqli_result $result)
	{
		$this->result = $result;
		if (PHP_INT_SIZE < 8) {
			self::$types[MYSQLI_TYPE_LONGLONG] = self::TYPE_DRIVER_SPECIFIC;
		}
	}


	public function __destruct()
	{
		$this->result->free();
	}


	public function seek(int $index): void
	{
		if ($this->result->num_rows !== 0 && !$this->result->data_seek($index)) {
			throw new InvalidArgumentException("Unable to seek in row set to {$index} index.");
		}
	}


	public function fetch(): ?array
	{
		return $this->result->fetch_assoc();
	}


	public function getTypes(): array
	{
		$types = [];
		$count = $this->result->field_count;

		for ($i = 0; $i < $count; $i++) {
			$field = (array) $this->result->fetch_field_direct($i);
			$types[(string) $field['name']] = [
				0 => self::$types[$field['type']] ?? self::TYPE_AS_IS,
				1 => $field['type'],
			];
		}

		return $types;
	}


	public function getRowsCount(): int
	{
		return $this->result->num_rows;
	}
}
