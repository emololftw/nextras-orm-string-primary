<?php

namespace App\Model\ORM;

use DateTimeImmutable;
use Nextras\Orm\Entity\Entity;


/**
 * First
 *
 * @property string                 $id         {primary}
 * @property int                    $num
 * @property DateTimeImmutable      $anotherOne {default now}
 * @property Second                 $second     {1:m Second::$first}
 */
class First extends Entity
{
}