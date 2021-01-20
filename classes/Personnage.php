<?php
class Personnage 
{
    // Liste des attributs
    private $id;
    protected $nom;
    protected $niveau;
    protected $forcePerso;
    protected $experience;
    protected $vieTotale;
    protected $vie;
    protected $resistance;


    const FORCE_PETITE = 10;
    const FORCE_MOYENNE = 15;
    const FORCE_GRANDE = 20;

    const RESISTANCE_PETITE = 5;
    const RESISTANCE_MOYENNE = 6;
    const RESISTANCE_GRANDE = 9;

    private static $textMenance = "Bande de fiottes je vais tous vous butter!!";
    private static $textSalutation = "Salutation étrangé";
    

    // Constructor
    public function __construct($nom, $forcePerso, $vieTotale, $resistance){
        $this->setNom($nom);
        $this->setForce($forcePerso);
        $this->setVie($vieTotale);
        $this->setVieTotale($vieTotale);
        $this->setResistance($resistance);
        $this->experience = 1;
        $this->niveau = 1;
    }

    // Liste des getters
    public function id(){
        return $this->id;
    }
    public function nom(){
        return $this->nom;
    }
    public function niveau(){
        return $this->niveau;
    }
    public function forcePerso(){
        return $this->forcePerso;
    }
    public function experience(){
        return $this->experience;
    }
    public function vie(){
        return $this->vie;
    }
    public function vieTotale(){
        return $this->vieTotale;
    }
    public function resistance(){
        return $this->resistance;
    }

    // Liste des setters
    public function setId($id){
        $id = (int) $id;
        if ($id > 0){
            $this->id = $id;
        }
    }
    public function setNom($nom){
        if (is_string($nom)){
            $this->nom = $nom;
        }else{
            echo "Choisissez un nom ne contenant que des caractères !";
        }
    }
    public function setForce($forcePerso){
        $forcePerso = (int) $forcePerso;
        if($forcePerso >= 1 && $forcePerso <= 100){
            $this->forcePerso = $forcePerso;
        }else{
            echo "La forcePerso doit être comprise en 1 et 100";
        }
    }
    public function setVieTotale($vieTotale){
        $vieTotale = (int) $vieTotale;
        if($vieTotale >= 0 && $vieTotale <= 1000){
            $this->vieTotale = $vieTotale;
        }else{
            echo "La vie totale doit être comprise en 0 et 1000";
        }
    }
    public function setVie($vieTotale){
        $this->vie = $vieTotale;
    }

    public function setResistance($resistance){
        $resistance = (int) $resistance;
        if($resistance >= 0 && $resistance <= 100){
            $this->resistance = $resistance;
        }else{
            echo "La résistance doit être comprise en 0 et 100";
        }
    }
    

    // Liste des Methodes    
    

    public function diceRoll($param1, $param2){
        return rand($param1, $param2);
    }

    public function isDead(){
        echo "<br>" . $this->nom . " est mort..." . "<br>";        
    }

    public function menacer(){
        echo self::$textMenance;
    }

    public function saluer(){
        echo self::$textSalutation;
    }

    public function gagnerExperience($nbr){
        $this->experience = $this->experience + $nbr;
        $this->niveau = $this->niveau + $nbr;
        $this->vieTotale += 50 *$nbr;
        $this->forcePerso += 10 *$nbr;
        $this->resistance += 2 *$nbr;
        $this->vie = $this->vieTotale;
        echo $this->nom . " a gagné un niveau!! il est maintenant niveau : " . $this->niveau;
       
    }

    // public function afficherStats(){
    //     echo "<br>" . "Il a pour stats :" . "<br>" ."nom : " . $this->nom ."<br>" . "experience : " . $this->experience ."<br>" . "forcePerso : " . $this->forcePerso ."<br>" . "Vie : " . $this->vie . " /" . $this->vieTotale . "<br>" . "resistance : " . $this->resistance . "<br>" ;
    // }
    

    
}


