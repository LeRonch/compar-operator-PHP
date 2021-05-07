<?php

class Review{

    private $id,
            $message,
            $author,
            $id_tour_operator;


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

    public function getMessage(){

        return $this->message;

    }

    public function getAuthor(){

        return $this->author;

    }

    public function getId_tour_operator(){

        return $this->id_tour_operator;

    }



    //SETTER


    public function setId($id)
    {
    
        $this->id = $id;

    }

    public function setMessage($message)
    {
    
        $this->message = $message;

    }

    public function setAuthor($author)
    {
    
        $this->author = $author;

    }

    public function setid_tour_operator($id_tour_operator)
    {
    
        $this->id_tour_operator = $id_tour_operator;

    }

}