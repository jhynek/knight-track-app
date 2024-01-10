<?php

declare(strict_types=1);

namespace App\Presenters;


use JHynek\KnightTrack\Field;
use JHynek\KnightTrack\KnightTrackService;
use Nette\Application\UI\Form;
use Nette\Application\UI\Presenter;
use Nette\Utils\ArrayHash;

final class HomePresenter extends Presenter
{

	/** @inject */
	public KnightTrackService $knightTrackService;

	protected function createComponentForm(): Form
	{
		$form = new Form();

		$start = $form->addContainer('startingField');
		$start->addInteger('x', 'Výchozí pozice X')
			->setRequired('Zadejte výchozí souřadnici X')
			->addRule(Form::Min, 'Souřadnice nesmí být menší než %s', 1)
			->addRule(Form::Max, 'Souřadnice nesmí být větší než %s', 8);
		$start->addInteger('y', 'Výchozí pozice Y')
			->setRequired('Zadejte výchozí souřadnici Y')
			->addRule(Form::Min, 'Souřadnice nesmí být menší než %s', 1)
			->addRule(Form::Max, 'Souřadnice nesmí být větší než %s', 8);

		$target = $form->addContainer('targetField');
		$target->addInteger('x', 'Cílová pozice X')
			->setRequired('Zadejte cílovou souřadnici X')
			->addRule(Form::Min, 'Souřadnice nesmí být menší než %s', 1)
			->addRule(Form::Max, 'Souřadnice nesmí být větší než %s', 8);
		$target->addInteger('y', 'Cílová pozice Y')
			->setRequired('Zadejte cílovou souřadnici Y')
			->addRule(Form::Min, 'Souřadnice nesmí být menší než %s', 1)
			->addRule(Form::Max, 'Souřadnice nesmí být větší než %s', 8);

		$form->addSubmit('send', 'Najít cestu');
		$form->onSuccess[] = [$this, 'formSucceeded'];
		return $form;
	}



	public function formSucceeded(Form $form, ArrayHash $data): void
	{
		$startingField = new Field($data->startingField->x, $data->startingField->y);
		$targetField = new Field($data->targetField->x, $data->targetField->y);
		$path = $this->knightTrackService->findShortestTrack($startingField, $targetField);

		$this->template->path = $path;
	}
}
