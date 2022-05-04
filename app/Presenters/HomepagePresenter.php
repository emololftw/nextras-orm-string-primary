<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Model\ORM\Model;
use Nette;


final class HomepagePresenter extends Nette\Application\UI\Presenter
{
	public function __construct(
		private Model $orm
	) {
	}

	public function actionDefault(): void {

		$allSecond = $this->orm->second->findAll();

		foreach($allSecond as $second) {

			bdump($second->first->num);

		}

	}
}
