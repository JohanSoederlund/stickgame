<?php

namespace model;



class LastStickGame {
	

	public function __construct() {
		$this->ai = new AIPlayer();
		$this->sticks = new PersistantSticks(\view\GameView::StartingNumberOfSticks);
	}

	public function playerSelectsSticks(StickSelection $playerSelection, StickGameObserver $observer) {
		$this->sticks->removeSticks($playerSelection);

		if ($this->isGameOver()) {
			$observer->playerWins();
		} else {
			$this->AIPlayerTurn($observer);
		} 
	}	

	private function AIPlayerTurn(StickGameObserver $observer) {
		$sticksLeft = $this->sticks->getNumberOfSticks();
		$selection = $this->ai->getSelection($sticksLeft);
		
		$this->sticks->removeSticks($selection);
		$observer->aiRemoved($selection);

		if ($this->isGameOver()) {
			$observer->playerLoose();
		}
	}

	/** 
	* @return boolean
	*/
	public function isGameOver() {
		return $this->sticks->getNumberOfSticks() < 2;
	}

	/** 
	* @return int
	*/
	public function getNumberOfSticks() {
		return ;
	}

	public function newGame() {
		$this->sticks->newGame(\view\GameView::StartingNumberOfSticks);
	}
}