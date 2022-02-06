<?php
class Prijava
{
    public $id;
    public $teretana;
    public $lokacija;
    public $datum;
    public $vreme;
    public $user;

    public function __construct($id = null, $teretana = null, $lokacija = null, $datum = null, $vreme = null, $user = null)
    {
        $this->id = $id;
        $this->teretana = $teretana;
        $this->lokacija = $lokacija;
        $this->datum = $datum;
        $this->vreme = $vreme;
        $this->user = $user;
    }


    public static function getAll(mysqli $conn)
    {
        $query = "SELECT * FROM prijave";
        return $conn->query($query);
    }




    public static function getById($id, mysqli $conn)
    {
        $query = "SELECT * FROM prijave WHERE id=$id";

        $myObj = array();
        if ($msqlObj = $conn->query($query)) {
            while ($red = $msqlObj->fetch_array(1)) {
                $myObj[] = $red;
            }
        }

        return $myObj;
    }



    public function deleteById(mysqli $conn)
    {
        $query = "DELETE FROM prijave WHERE id=$this->id";
        return $conn->query($query);
    }


    public static function update(Prijava $prijava, mysqli $conn)
    {
        $query = "UPDATE prijave set teretana = '$prijava->teretana', lokacija = '$prijava->lokacija', datum = '$prijava->datum', vreme = '$prijava->vreme' WHERE id='$prijava->id'";
        return $conn->query($query);
    }


    public static function add(Prijava $prijava, mysqli $conn)
    {
        $query = "INSERT INTO prijave(teretana, lokacija, datum, vreme, user) VALUES('$prijava->teretana','$prijava->lokacija','$prijava->datum','$prijava->vreme','$prijava->user')";
        return $conn->query($query);
    }
}
