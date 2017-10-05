<?php

namespace controller;

class GameController {
	/**
	 * @var \model\LastStickGame
	 */
	private $game;
	private $title = "Game of sticks";
	/**
	 * @var \view\GameView
	 */
	private $view;
	/**
	 * @var string
	 */
	private $message = "";
	public function __construct() {
		$this->game = new \model\LastStickGame();
		$this->view = new \view\GameView($this->game);
	}

	public function getTitle(){
		return $this->title;
	}

	/**
	* @return String HTML
	*/
	public function runGame() {
		//Handle input
		if ($this->game->isGameOver()) {
			$this->doGameOver();
		} else {
			$this->playGame();
		}
		//Generate Output
		return $this->view->show($this->message);
	}
	/**
	* Called when game is still running
	*/
	private function playGame() {
		if ($this->playerSelectSticks()) {
			try {
				$sticksDrawnByPlayer = $this->getNumberOfSticks();
				$this->game->playerSelectsSticks($sticksDrawnByPlayer, $this->view);
			} catch(\Exception $e) {
				$this->message = "<h1>Unauthorized input</h1>";
			}
		}
	}
	private function doGameOver() {
		if ($this->playerStartsOver()) {
			$this->game->newGame();
		}		
	}
	/** 
	* @return boolean
	*/
	private function playerSelectSticks() {
		return isset($_GET["draw"]);
	}
	/** 
	* @return boolean
	*/
	private function playerStartsOver() {
		return isset($_GET["startOver"]);
	}
	/** 
	* @return \model\StickSelection
	*/
	private function getNumberOfSticks() {
		switch ($_GET["draw"]) {
			case 1 : return \model\StickSelection::One(); break;
			case 2 : return \model\StickSelection::Two(); break;
			case 3 : return \model\StickSelection::Three(); break;
		}
		throw new \Exception("Invalid input");
	}
}
