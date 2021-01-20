<?php

class Mage extends Personnage
{
    public $magicPoints;
    public $shield = false;
    

    public function __construct($nom, $forcePerso, $vieTotale, $resistance) {
        parent::__construct($nom, $forcePerso, $vieTotale, $resistance);
        $this->magicPoints = 100;
    }
 

    public function action($target){
        $rand = rand(1, 10);
        if($rand > 3 || $this->shield){
            return $this->fireball($target);
        }else{
            return$this->magicShield();
        }
    }

    public function fireball($target) {
        $magicCost = rand(5, 15);
        if ($this->magicPoints == 0) {
            echo "$this->nom n'a plus de mana, il tape avec son baton!";
            $result = $this->frapper($target);
            return $result;
        } else if ($magicCost > $this->magicPoints) {
            $magicCost = $this->magicPoints;
            $this->magicPoints = 0;
            $target->setHealth($magicCost * (2 * $this->niveau));
        } else {
            $this->magicPoints -= $magicCost;
            $target->setHealth($magicCost * (2 * $this->niveau));
        }
        echo "$this->nom a tiré une boule de feu, $target->nom a encore $target->vie hp";
        if($target->vie <= 0){
            $target->isDead();
        }
    }

    public function magicShield(){
        $this->shield = true;
        
    }

    public function frapper($enemy){
        $degats = $this->forcePerso - $enemy->resistance;
        if($degats > 0){
            $enemy->setHealth($degats);
        }
        echo $this->nom() . " frappe " . $enemy->nom() . ", il lui reste : " . $enemy->vie() . "hp" ;
        if($enemy->vie <= 0){
            $enemy->isDead();
            parent::gagnerExperience(1);
        }
    }

    public function setHealth($damage){
        if (!$this->shield){
            $this->vie -= round($damage);
            if($this->vie < 0 || $this->vie == 0 ){
                
                $this->vie = 0;
            }
        }else{
            $this->shield = false;
            echo "$this->nom se protège de la prochaine attaque avec son sort de protection! <br>";
            return;
        }
    }

    public function afficherStats(){
        echo "<br>" . "Il a pour stats :" . "<br>" ."nom : " . $this->nom ."<br>" . "experience : " . $this->experience ."<br>" . "forcePerso : " . $this->forcePerso ."<br>" . "Vie : " . $this->vie . " /" . $this->vieTotale . "<br>" . "resistance : " . $this->resistance . "<br>". "Mana : " . $this->magicPoints . "<br>";
    }
}