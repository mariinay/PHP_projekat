<?php
class Prijava{
    public $id;   
    public $ime;
    public $prezime;   
    public $lokacija; 
    public $datum;     
    public $vreme;
    
    public function __construct($id=null, $ime=null, $prezime=null,  $lokacija=null, $datum=null, $vreme=null)
    {
        $this->id = $id;
        $this->ime = $ime;
        $this->prezime = $prezime;
        $this->lokacija = $lokacija;
        $this->datum = $datum;
        $this->vreme = $vreme;
    }


    public static function getAll(mysqli $conn)
    {
        $query = "SELECT * FROM prijave";
        return $conn->query($query);
    }



  
    public static function getById($id, mysqli $conn){
        $query = "SELECT * FROM prijave WHERE id=$id";

        $myObj = array();
        if($msqlObj = $conn->query($query)){
            while($red = $msqlObj->fetch_array(1)){
                $myObj[]= $red;
            }
        }

        return $myObj;

    }

  

    public function deleteById(mysqli $conn)
    {
        $query = "DELETE FROM prijave WHERE id=$this->id";
        return $conn->query($query);
    }


    public function update($id, mysqli $conn)
    {
        $query = "UPDATE prijave set ime = $this->ime, prezime = $this->prezime, lokacija = $this->lokacija, datum = $this->datum, vreme = $this->vreme WHERE id=$id";
        return $conn->query($query);
    }


    public static function add(Prijava $prijava, mysqli $conn)
    {
        $query = "INSERT INTO prijave(ime, prezime, lokacija, datum, vreme) VALUES('$prijava->ime', '$prijava->prezime', '$prijava->lokacija','$prijava->datum', '$prijava->vreme')";
        return $conn->query($query);
    }
}

?>