<?php

namespace App\Model\ORM;

use DateTimeImmutable;
use Nextras\Orm\Entity\Entity;


/**
 * Second
 *
 * @property int                    $id        {primary}
 * @property int                    $wtf
 * @property First                  $first     {m:1 First::$second}
 */
class Second extends Entity
{
}