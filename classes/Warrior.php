<?php

class Warrior extends Personnage
{
    public $critique;
    public $degatsDesCC;
    public $rage = false;
    

    public function __construct($nom, $forcePerso, $vieTotale, $resistance) {
        parent::__construct($nom, $forcePerso, $vieTotale, $resistance);
        $this->critique = 25;
        $this->degatsDesCC = 45;
    }

    public function action($target){
        $rand = rand(0, 100);
        if($this->critique < (25 + (10 * $this->niveau))){
            $this->critique = $this->critique + (2 * $this->niveau);
        }
        if($rand > $this->critique || $this->rage == true){
            return $this->frapper($target);
        }else{
            return $this->coupCritique($target);
        }
    }

    public function coupCritique($target) {
        $sumDegatsCC = (($this->forcePerso()*$this->degatsDesCC)/100) + 5*$this->niveau;
        $resultatDegats = $this->forcePerso() + $sumDegatsCC ;
        $target->setHealth($resultatDegats);
        if($target->vie <= 0){
            $target->isDead();
            parent::gagnerExperience(1);
        }
        $this->rage = true;
        echo "$this->nom a fait un coup critique et inflige " . " $resultatDegats degats à " . $target->nom . "a encore " . $target->vie . "hp";
    }

    public function frapper($target){
        $degats = $this->forcePerso - $target->resistance;
        if($degats > 0){
            $target->setHealth($degats);

        }
        echo $this->nom() . " frappe et inflige " . "$degats degats à " . $target->nom() . ", il lui reste : " . $target->vie() . "hp" . "<br>";
        if($target->vie <= 0){
            $target->isDead();
            parent::gagnerExperience(1);
        }
        $this->rage = false;
    }

    public function setHealth($damage){
            $this->vie -= round($damage);
            if($this->vie < 0 || $this->vie == 0 ){
                $this->vie = 0;
            }
    }

    public function afficherStats(){
        echo "<br>" . "Il a pour stats :" . "<br>" ."nom : " . $this->nom ."<br>" . "niveau : " . $this->niveau ."<br>" . "force : " . $this->forcePerso ."<br>" . "Vie : " . $this->vie . " /" . $this->vieTotale . "<br>" . "resistance : " . $this->resistance . "<br>" . "chance de coup critique : " . ($this->critique) . "<br>" . "dégats des coups critiques : " . ($this->degatsDesCC + ( 5* $this->niveau)) . "<br>";
    }
}