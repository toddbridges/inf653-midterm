<?php
    class Category {
        //db stuff
        private $conn;
        private $table = 'categories';

        // category properties
        public $id;
        public $category;  

        //constructor with db
        public function __construct($db) {
            $this->conn = $db;
        }

        // get the categories
        public function read() {
            // create the query
            $query = 'SELECT 
                *
                FROM ' . $this->table;

            // prepare statments;
            $stmt = $this->conn->prepare($query);

            // excetute
            $stmt->execute();

            return $stmt;
        }

        // get single Category
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
            $this->category = $row['category'];
            }
            
        }

        //create category

        public function create() {                   
            // create query
            $query = 'INSERT INTO ' . $this->table . '(category)  
                VALUES
                    (:category)';
        

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // clean data
        
        $this->category = htmlspecialchars(strip_tags($this->category));
        
    
        // bind data
        //$stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':category', $this->category);

        // execute query
        if($stmt->execute()) {
            $lastId = $this->conn->lastInsertId();
            
            return $lastId;
        }
        // print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    // update category
    public function update() {
        // create query
        $query = 'UPDATE ' . $this->table . ' 
            SET 
                category = :category 
            WHERE 
                id = :id';
    

    // prepare statement
    $stmt = $this->conn->prepare($query);

    // clean data
    $this->category = htmlspecialchars(strip_tags($this->category));
    $this->id = htmlspecialchars(strip_tags($this->id));


    // bind data
    $stmt->bindParam(':category', $this->category);
    $stmt->bindParam(':id', $this->id);
    

    // execute query
    if($stmt->execute()) {
        return true;
    }
    // print error if something goes wrong
    printf("Error: %s.\n", $stmt->error);

    return false;
}

// delete category
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