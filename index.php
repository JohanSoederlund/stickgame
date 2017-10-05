<?php

session_start();

require_once("controller/GameController.php");
require_once("view/HTMLPage.php");
require_once("model/LastStickGame.php");
require_once("view/GameView.php");
require_once("model/StickSelection.php");
require_once("model/AIPlayer.php");
require_once("model/PersistantSticks.php");

try{
    $controller = new controller\GameController();
    
    $body = $controller->runGame();
    
    $page = new view\HTMLPage();
    echo $page->getPage($controller->getTitle(), $body);
} catch(Exception $e){
    var_dump($e);
}





