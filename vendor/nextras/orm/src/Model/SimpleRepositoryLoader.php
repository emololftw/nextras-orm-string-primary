<?php declare(strict_types = 1);

namespace Nextras\Orm\Model;


use Nextras\Orm\Exception\InvalidArgumentException;
use Nextras\Orm\Repository\IRepository;


class SimpleRepositoryLoader implements IRepositoryLoader
{
	/** @var IRepository[] */
	private $repositories;


	/**
	 * @param IRepository[] $repositories
	 */
	public function __construct(array $repositories)
	{
		$this->repositories = [];
		foreach ($repositories as $repository) {
			$this->repositories[get_class($repository)] = $repository;
		}
	}


	public function hasRepository(string $className): bool
	{
		return isset($this->repositories[$className]);
	}


	public function getRepository(string $className): IRepository
	{
		if (!isset($this->repositories[$className])) {
			throw new InvalidArgumentException("Repository '$className' not defined.");
		}
		return $this->repositories[$className];
	}


	public function isCreated(string $className): bool
	{
		return true;
	}
}
