<?php

class Paladin extends Personnage
{
    public $magicPoints;
    public $heal = false;
    

    public function __construct($nom, $forcePerso, $vieTotale, $resistance) {
        parent::__construct($nom, $forcePerso, $vieTotale, $resistance);
        $this->magicPoints = 100;
    }

    public function action($target){
        
        $rand = rand(0, 100);
        if($rand < 35 && !$this->heal && $this->vie < ($this->vieTotale*80)/100){
            if($this->magicPoints >= 30){
                return $this->heal();
            }else{
                return $this->meditate();
            }
        }else{
            return$this->frapper($target);
        }
        
    }

    public function heal() {
        $min = 15 + ( 0.7 * $this->niveau());
        $max = 25 + ( 0.7 * $this->niveau());
        $magicCost = rand($min, $max);
        $healAmount = $magicCost * $this->niveau();
        $this->vie += $healAmount;
        $this->heal = true;
        echo "$this->nom s'est soigné de $healAmount !";
    }

    public function meditate() {
        $this->magicPoints = 100;
        echo "$this->nom médite et reprend la totalité de son mana !";
        $this->heal = false;
    }

    public function magicShield(){
        $this->shield = true; 
    }

    public function frapper($enemy){
        $degats = $this->forcePerso - $enemy->resistance;
        if($degats > 0){
            $enemy->setHealth($degats);
            $this->heal = false;
        }
        echo $this->nom() . " frappe et inflige " . "$degats degats à " . $enemy->nom() . ", il lui reste : " . $enemy->vie() . "hp" . "<br>";
        if($enemy->vie <= 0){
            $enemy->isDead();
            parent::gagnerExperience(1);
        }
    }

    public function setHealth($damage){
        $this->vie -= round($damage);
        if($this->vie < 0 || $this->vie == 0 ){
            $this->vie = 0;
        }
    }

    public function afficherStats(){
        echo "<br>" . "Il a pour stats :" . "<br>" ."nom : " . $this->nom ."<br>" . "experience : " . $this->experience ."<br>" . "forcePerso : " . $this->forcePerso ."<br>" . "Vie : " . $this->vie . " /" . $this->vieTotale . "<br>" . "resistance : " . $this->resistance . "<br>". "Mana : " . $this->magicPoints . "<br>";
    }
}