<?php
    class Author {
        //db stuff
        private $conn;
        private $table = 'authors';

        // author properties
        public $id;
        public $author;

        //constructor with db
        public function __construct($db) {
            $this->conn = $db;
        }
        

        // get authors
        public function read() {
            // careate the query
            $query = 'SELECT 
                *
                FROM ' . $this->table;

            // prepare statments;
            
            $stmt = $this->conn->prepare($query);
            

            // excetute
            $stmt->execute();

            return $stmt;
        }

        // get single author
        public function read_single() {
            // create query
            $query = 'SELECT * FROM 
              ' . $this->table . '  
                WHERE 
                id = ?';

            // prepare statment
            $stmt = $this->conn->prepare($query);

            // bind id

            $stmt->bindParam(1, $this->id);

            //execute query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // set properties

            if(!$row) {
                return;
            } else {
            $this->id = $row['id'];
            $this->author = $row['author'];
            }
            
        }

        //create author

        public function create() {                   
            // create query
            $query = 'INSERT INTO ' . $this->table . '(author)  
                VALUES
                    (:author)';
        

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // clean data
        
        $this->author = htmlspecialchars(strip_tags($this->author));
        
    
        // bind data
        //$stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':author', $this->author);

        // execute query
        if($stmt->execute()) {
            $lastId = $this->conn->lastInsertId();
            
            return $lastId;
        }
        // print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    // update author
    public function update() {
        // create query
        $query = 'UPDATE ' . $this->table . ' 
            SET 
                author = :author 
            WHERE 
                id = :id';
    

    // prepare statement
    $stmt = $this->conn->prepare($query);

    // clean data
    $this->author = htmlspecialchars(strip_tags($this->author));
    $this->id = htmlspecialchars(strip_tags($this->id));


    // bind data
    $stmt->bindParam(':author', $this->author);
    $stmt->bindParam(':id', $this->id);
    

    // execute query
    if($stmt->execute()) {
        return true;
    }
    // print error if something goes wrong
    printf("Error: %s.\n", $stmt->error);

    return false;
}

// deleete author
public function delete() {
    //
    //create query
    $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
    $stmt = $this->conn->prepare($query);

    
    $this->id = htmlspecialchars(strip_tags($this->id));
    $stmt->bindParam(':id', $this->id);
    
    if($stmt->execute()) {
        return true;
    }
    printf("Error: %s.\n", $stmt->error);
    return false;

}


}