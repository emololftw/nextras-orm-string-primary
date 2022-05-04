<?php

namespace App\Model\ORM;

use Nextras\Orm\Repository\Repository;


class FirstRepository extends Repository
{
	static function getEntityClassNames(): array
	{
		return [First::class];
	}
}