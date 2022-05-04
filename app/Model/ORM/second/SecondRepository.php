<?php

namespace App\Model\ORM;

use Nextras\Orm\Repository\Repository;


class SecondRepository extends Repository
{
	static function getEntityClassNames(): array
	{
		return [Second::class];
	}
}