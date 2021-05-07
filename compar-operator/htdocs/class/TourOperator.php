<?php

class TourOperator{

    private $id,
            $name,
            $grade,
            $link,
            $is_premium;


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


    //GETTERS

    public function getId(){

        return $this->id;

    }

    public function getName(){
        
        return $this->name;

    }

    public function getGrade(){
        
        return $this->grade;

    }

    public function getLink(){
       
        return $this->link;
        
    }

    public function getIsPremium(){

        return $this->is_premium;
        
    }


    //SETTERS

    public function setId($id)
    {
        $id = (int) $id;

        if($id > 0)
        {
          $this->id = $id;
        }

    }


    public function setName($name)
    {
        if(is_string($name))
        {
        $this->name = $name;
        }

    }


    public function setGrade($grade)
    {

        $this->grade = $grade;

    }


    public function setLink($link)
    {

        $this->link = $link;

    }


    public function setIs_Premium($is_premium)
    {
        $is_premium = (int) $is_premium;
        $this->is_premium = $is_premium;

    }

}