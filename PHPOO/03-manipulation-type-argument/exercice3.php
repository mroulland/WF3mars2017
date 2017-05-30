<?php

// 03-manipulation-type-argument
    // exercice3.php 

class Vehicule
{
    private $litreEssence; // Nbre litres d'essence dans le véhicule
    private $reservoir; //capacité max du réservoir
    private $essenceManquante; 

    public function setLitreEssence($litre){
        $this -> litreEssence = $litre;
    }

    public function getLitreEssence(){
        return $this -> litreEssence;
    }

    public function setReservoir($res){
        $this -> reservoir = $res;
    }

    public function getReservoir(){
        return $this -> reservoir;
    }

}

//----------------------

class Pompe
{
    public $essenceManquante;
    private $litreEssence;

    public function getLitreEssence(){
        return $this -> litreEssence;
    }

    public function setLitreEssence($litre){
        $this -> litreEssence = $litre;
    }

    public function faireLePlein(Vehicule $voiture){
        $litre_a_mettre = $voiture -> getReservoir() - $voiture -> getLitreEssence();

        $voiture -> setLitreEssence( $voiture -> getLitreEssence() + $litre_a_mettre); 

        $this -> setLitreEssence($this -> getLitreEssence() - $litre_a_mettre);

    }
}


// -----------------------

$voiture = new Vehicule;
$voiture -> setLitreEssence(5);
$voiture -> setReservoir(50);

echo 'La voiture contient actuellement ' . $voiture -> getlitreEssence() . ' litres d\'esssence sur une capacité totale de ' . $voiture -> getReservoir() . ' litres. <br>';

$pompe = new Pompe;
$pompe -> setLitreEssence(800);
echo 'Il y a actuellement ' . $pompe -> getLitreEssence() . ' litres dans la pompe. <br>';

echo 'Il manque ' . $pompe -> faireLePlein($voiture) . ' litres dans la voiture <br>';

echo 'La voiture contient actuellement ' . $voiture -> getlitreEssence() . ' litres d\'esssence sur une capacité totale de ' . $voiture -> getReservoir() . ' litres. <br>';

echo 'Il y a actuellement ' . $pompe -> getLitreEssence() . ' litres dans la pompe. <br>';