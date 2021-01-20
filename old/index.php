<?php

require './classes/Character.php';

$Bretteur = new Personnage("Joe le Bretteur", Personnage::FORCE_GRANDE, 200, Personnage::RESISTANCE_PETITE);
$Bretteur->afficherStats();
$Barbare = new Personnage("Bob le barbare", Personnage::FORCE_MOYENNE, 200, Personnage::RESISTANCE_MOYENNE);
$Barbare->afficherStats();
$Guerrier = new Personnage("Jean le guerrier", Personnage::FORCE_PETITE, 200, Personnage::RESISTANCE_GRANDE);
$Guerrier->afficherStats();

function frappe($player1, $player2){
    if($player1->vie() <= 0 || $player2->vie() <= 0){
        if($player1->vie() <= 0){
            $player1->isDead();
            $player2->gagnerExperience();
        }else{
            $player2->isDead();
            $player1->gagnerExperience(); 
        }
        
        return true;
    }

    $player1->frapper($player2);
}

function combat($player1, $player2){
    $playerDeath = false;
    while($playerDeath == false) {
        if (frappe($player1, $player2) == true){
            return;
        }
        if (frappe($player2, $player1) == true){
            return;
        }
    }
    
}

echo "<br>" . $Barbare->nom();

echo " entre dans l'arêne !! va t-il réussir à battre ces deux premiers enemies??" . "<br>" . "Il va commencer par affronter : " . $Bretteur->nom();

echo "<br>" . "Que le combat commmmeeeeeeennce !!!" . "<br>";

combat($Barbare, $Bretteur);

echo "<br>" . "C'est une victoire ! Il doit maintenant affronter : " . $Guerrier->nom() . "<br>";

combat($Barbare, $Guerrier);

echo "<br>" . $Barbare->nom() . " est triomphant ! Il est temps de passer à des enemies plus fort !" . "<br>";

$Bretteur2 = new Personnage(" Alfred le maître Bretteur", Personnage::FORCE_GRANDE, 200, Personnage::RESISTANCE_PETITE);
$Bretteur2->gagnerExperience();
echo "<br>";

$Guerrier2 = new Personnage("George le chef des guerriers", Personnage::FORCE_PETITE, 200, Personnage::RESISTANCE_GRANDE);
$Guerrier2->gagnerExperience();
$Guerrier2->gagnerExperience();
echo "<br>";

combat($Barbare, $Bretteur2);

echo "<br>" . "Son deuxième adversaire : " . $Guerrier2->nom() . " s'avance déjà!!" . "<br>";

combat($Barbare, $Guerrier2);

$mageBoss = new Mage("Gandoulf le magifiotte", Personnage::FORCE_PETITE, 400, Personnage::RESISTANCE_GRANDE);

combat($Barbare, $mageBoss);