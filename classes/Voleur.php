<?php

class Voleur extends Personnage
{
    public $esquive;
    public $aEsquive = false;
    

    public function __construct($nom, $forcePerso, $vieTotale, $resistance) {
        parent::__construct($nom, $forcePerso, $vieTotale, $resistance);
        $this->esquive = 40;
    }

    public function action($target){
        return $this->frapper($target);   
    }



    public function frapper($enemy){
        $degats = $this->forcePerso - $enemy->resistance;
        if($degats > 0){
            $enemy->setHealth($degats);
        }
        echo $this->nom() . " frappe et inflige " . "$degats degats à " . $enemy->nom() . ", il lui reste : " . $enemy->vie() . "hp" . "<br>";
        if($enemy->vie <= 0){
            $enemy->isDead();
            parent::gagnerExperience(1);
        }
    }


    public function setHealth($damage){
        $rand = rand(0, 100);
        if($rand > $this->esquive ){
            $this->vie -= round($damage);
            $this->aEsquive = false;
        }else if($rand <= 30 && !$this->aEsquive){
            echo "$this->nom esquive la prochaine attaque! <br>";
            $this->aEsquive = true;
        }
    }

    public function afficherStats(){
        echo "<br>" . "Il a pour stats :" . "<br>" ."nom : " . $this->nom ."<br>" . "experience : " . $this->experience ."<br>" . "forcePerso : " . $this->forcePerso ."<br>" . "Vie : " . $this->vie . " /" . $this->vieTotale . "<br>" . "resistance : " . $this->resistance . "<br>". "pourcentage d'esquive : " . $this->esquive . "<br>";
    }
}