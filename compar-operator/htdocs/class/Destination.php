<?php

class Destination{

    private $id,
            $location,
            $price,
            $id_tour_operator,
            $image;


    public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }
    
    
    public function hydrate(array $donnees)
    {

        foreach ($donnees as $key => $value)
        {
            $method = 'set'.ucfirst($key);
            
            if(method_exists($this, $method))
            {
                $this->$method($value);
            }
        }

    }


    //GETTER

    public function getId(){

        return $this->id;

    }

    public function getImage(){

        return $this->image;

    }

    public function getLocation(){

        return $this->location;

    }

    public function getPrice(){

        return $this->price;

    }

    public function getId_tour_operator(){

        return $this->id_tour_operator;

    }


    //SETTER


    public function setId($id)
    {
        $id = (int) $id;

        if($id > 0)
        {
          $this->id = $id;
        }

    }


    public function setLocation($location)
    {
      
        $this->location = $location;

    }


    public function setImage($image)
    {
      
        $this->image = $image;

    }


    public function setPrice($price)
    {

        $this->price = $price;

    }


    public function setId_tour_operator($id_tour_operator)
    {

        $this->id_tour_operator = $id_tour_operator;

    }

}