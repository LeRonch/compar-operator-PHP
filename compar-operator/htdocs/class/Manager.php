<?php

class Manager{

    private $db;

    public function __construct($db){
    
        $this->setDb($db);

    }

    public function setDb(PDO $db){

        $this->db = $db;

    }


    public function getAllDestination(){

        $allDestinations = [];
        $selectDestination = $this->db->prepare( 

            'SELECT DISTINCT destinations.location, destinations.image
            FROM destinations
            ORDER BY destinations.location');

        $selectDestination->execute();
       
        foreach($selectDestination->fetchAll() as $desti){ 

            array_push($allDestinations, new Destination($desti));

        }

        return $allDestinations;

    }


    public function getOperatorByDestination($location){
        
        $allOperators = [];

        $operatorByDestination = $this->db->prepare( 

            'SELECT *
            FROM tour_operators
            JOIN destinations
                ON tour_operators.id = destinations.id_tour_operator
            WHERE destinations.location = ?
            ORDER BY tour_operators.is_premium DESC' 
        );

        $operatorByDestination->execute([$location]);
        $data = $operatorByDestination->fetchAll(PDO::FETCH_ASSOC);

        foreach($data as $opByDest){
    
            $arrayPeers = [

               'operator' => new TourOperator([
                    'id'=> $opByDest['id_tour_operator'],
                    'name' => $opByDest['name'],
                    'grade' => $opByDest['grade'],
                    'link' => $opByDest['link'],
                    'is_Premium' => intval( $opByDest['is_premium'])
                ]),
               'destination' => new Destination([
                    'id'=> $opByDest['id'],
                    'price'=> $opByDest['price'],
                    'location'=> $opByDest['location'],
                    'id_tour_operator'=> $opByDest['id_tour_operator'],
    
                ])

            ];

            array_push($allOperators,$arrayPeers);

        }

        return $allOperators;

    }


    public function getReviewByoperator($operateur){

        $specsOperateur = [];

        $destinationByOperator = $this->db->prepare( 

            'SELECT *
            FROM tour_operators
            JOIN reviews
                ON tour_operators.id = reviews.id_tour_operator
            WHERE tour_operators.id = ?' 

        );

        $destinationByOperator->execute([$operateur]);
        $data = $destinationByOperator->fetchAll(PDO::FETCH_ASSOC);

        foreach($data as $destByOp){
    
            $arrayPeers = [

               'operator' => new TourOperator([
                    'id'=> $destByOp['id_tour_operator'],
                    'name' => $destByOp['name'],
                    'grade' => $destByOp['grade'],
                    'link' => $destByOp['link'],
                    'isPremium' => intval( $destByOp['is_premium'])
                ]),

                'review' => new Review([
                    'id'=> $destByOp['id'],
                    'message'=> $destByOp['message'],
                    'author'=> $destByOp['author'],
                    'id_tour_operator'=> $destByOp['id_tour_operator']
    
                ])

            ];

            array_push($specsOperateur, $arrayPeers);

        }

        return $specsOperateur;

    }

    public function getDestinationByoperator($operateur){

        $destiOperateur = [];

        $destinationByOperator = $this->db->prepare( 

            'SELECT *
            FROM tour_operators
            JOIN destinations
                ON tour_operators.id = destinations.id_tour_operator
            WHERE tour_operators.id = ?' 

        );

        $destinationByOperator->execute([$operateur]);
        $data = $destinationByOperator->fetchAll(PDO::FETCH_ASSOC);

        foreach($data as $destByOp){
    
            $arrayPeers = [

               'operator' => new TourOperator([
                    'id'=> $destByOp['id_tour_operator'],
                    'name' => $destByOp['name'],
                    'grade' => $destByOp['grade'],
                    'link' => $destByOp['link'],
                    'is_premium' => intval( $destByOp['is_premium'])
                ]),

                'destination' => new Destination([
                    'id'=> $destByOp['id'],
                    'price'=> $destByOp['price'],
                    'location'=> $destByOp['location'],
                    'id_tour_operator'=> $destByOp['id_tour_operator'],
                    'image'=> $destByOp['image']
    
                ])

            ];

            array_push($destiOperateur, $arrayPeers);

        }

        return $destiOperateur;


    }

    public function getEverything(){

        $everything = [];

        $needAll = $this->db->prepare( 

            'SELECT *
            FROM tour_operators
            JOIN destinations
                ON tour_operators.id = destinations.id_tour_operator
            ORDER BY destinations.id ASC'

        );

        $needAll->execute();
        $data = $needAll->fetchAll(PDO::FETCH_ASSOC);

        foreach($data as $fullList){
    
            $arrayPeers = [

               'operator' => new TourOperator([
                    'id'=> $fullList['id_tour_operator'],
                    'name' => $fullList['name'],
                    'grade' => $fullList['grade'],
                    'link' => $fullList['link'],
                    'isPremium' => intval( $fullList['is_premium'])
                ]),
               'destination' => new Destination([
                    'id'=> $fullList['id'],
                    'price'=> $fullList['price'],
                    'location'=> $fullList['location'],
                    'id_tour_operator'=> $fullList['id_tour_operator'],
    
                ])

            ];

            array_push($everything, $arrayPeers);

        }

        return $everything;

    }

    public function getAllOperator(){

        $allOperateurs = [];
        $selectOperateur = $this->db->prepare( 

            'SELECT *
            FROM tour_operators
            ORDER BY tour_operators.is_premium DESC');

        $selectOperateur->execute();
       
        foreach($selectOperateur->fetchAll() as $opera){ 

            array_push($allOperateurs, new TourOperator($opera));

        }
        
        return $allOperateurs;
        
    }

    public function updateOperatorToPremium(TourOperator $tourOperator){

        $q = $this->db->prepare('UPDATE tour_operators SET is_premium = :is_premium WHERE id = :id');
    
        $q->bindValue(':is_premium', $tourOperator->getIsPremium(), PDO::PARAM_INT);
        $q->bindValue(':id', $tourOperator->getId());
        $q->execute();
        
    }

    public function createTourOperator(TourOperator $tourOperator){
        
        $q = $this->db->prepare('INSERT INTO tour_operators(name, grade, link, is_premium) VALUES(:name, :grade, :link, :is_premium)');
        $q->bindValue(':name', $tourOperator->getName());
        $q->bindValue(':grade', $tourOperator->getGrade());
        $q->bindValue(':link', $tourOperator->getLink());
        $q->bindValue(':is_premium', $tourOperator->getIsPremium());
        $q->execute();
        
        $tourOperator->hydrate([

        'id' => $this->db->lastInsertId()

        
        ]);

    }

    public function deleteTourOperator(TourOperator $operator){

        $this->db->exec('DELETE FROM tour_operators WHERE id = '.$operator->getId());

    }

    public function createDestination(Destination $destination){

        $q = $this->db->prepare('INSERT INTO destinations(location, price, id_tour_operator, image) VALUES(:location, :price, :id_tour_operator, :image)');
        $q->bindValue(':location', $destination->getLocation());
        $q->bindValue(':price', $destination->getPrice());
        $q->bindValue(':id_tour_operator', $destination->getId_tour_operator());
        $q->bindValue(':image', $destination->getImage());
        $q->execute();
        
        $destination->hydrate([

        'id' => $this->db->lastInsertId()

        ]);
        
    }

    public function deleteDestination(Destination $destination){

        $this->db->exec('DELETE FROM destinations WHERE id = '.$destination->getId_tour_operator());

    }

    public function createReview(Review $review){
        
        $q = $this->db->prepare('INSERT INTO reviews(message, author, id_tour_operator) VALUES(:message, :author, :id_tour_operator)');
        $q->bindValue(':message', $review->getMessage());
        $q->bindValue(':author', $review->getAuthor());
        $q->bindValue(':id_tour_operator', $review->getId_tour_operator());
        $q->execute();
        
        $review->hydrate([

        'id' => $this->db->lastInsertId()

        ]);

    }

}