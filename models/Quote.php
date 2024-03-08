<?php
    
    class Quote {
        //db stuff
        private $conn;
        private $table = 'quotes';

        // quote properties
        public $id;
        public $quote;
        public $author_id;
        public $category_id;

        //constructor with db
        public function __construct($db) {
            $this->conn = $db;
        }

        // get quotes
        public function read() {
            // create the query

            if (isset($_GET['author_id']) && isset($_GET['category_id'])) {

                $auth_id = ($_GET['author_id']);
                $cat_id = ($_GET['category_id']);


                 $query = 'SELECT 
                 quotes.id, 
                 quotes.quote, 
                 authors.author as author_id, 
                 categories.category as category_id 
                 FROM ' . $this->table . ' 
                 INNER JOIN authors 
                 ON quotes.author_id = authors.id 
                 INNER JOIN categories 
                 ON quotes.category_id = categories.id
                 WHERE author_id = ' . $auth_id . ' 
                 AND category_id = ' . $cat_id;

                // prepare statment
                $stmt = $this->conn->prepare($query);

                //execute query
                $stmt->execute();

                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                // set properties

                if(!$row) {
                    return;
                } else {
                $this->id = $row['id'];
                $this->quote = $row['quote'];
                $this->author_id = $row['author_id'];
                $this->category_id = $row['category_id'];
                }

            } else if (isset($_GET['author_id'])) {
                $auth_id = ($_GET['author_id']);

                $query = 'SELECT 
                quotes.id, 
                quotes.quote, 
                authors.author as author_id, 
                categories.category as category_id 
                FROM ' . $this->table . ' 
                INNER JOIN authors 
                ON quotes.author_id = authors.id 
                INNER JOIN categories 
                ON quotes.category_id = categories.id 
                WHERE author_id = ' . $auth_id;

                // prepare statment
            $stmt = $this->conn->prepare($query);

            //execute query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // set properties

            if(!$row) {
                
                return;
            } else {
            $this->id = $row['id'];
            $this->quote = $row['quote'];
            $this->author_id = $row['author_id'];
            $this->category_id = $row['category_id'];
            }
            } else if (isset($_GET['category_id'])) {
                $cat_id = ($_GET['category_id']);
                

                $query = 'SELECT 
                quotes.id, 
                quotes.quote, 
                authors.author as author_id, 
                categories.category as category_id 
                FROM ' . $this->table . ' 
                INNER JOIN authors 
                ON quotes.author_id = authors.id 
                INNER JOIN categories 
                ON quotes.category_id = categories.id
                WHERE category_id = ' . $cat_id;

                // prepare statment
            $stmt = $this->conn->prepare($query);

            //execute query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // set properties

            if(!$row) {
                
                return;
            } else {
            $this->id = $row['id'];
            $this->quote = $row['quote'];
            $this->author_id = $row['author_id'];
            $this->category_id = $row['category_id'];
            }
            }
            
            else 

            $query = 'SELECT 
                quotes.id, 
                quotes.quote, 
                authors.author as author_id, 
                categories.category as category_id 
                FROM ' . $this->table . ' 
                INNER JOIN authors 
                ON quotes.author_id = authors.id 
                INNER JOIN categories 
                ON quotes.category_id = categories.id';
            

            // prepare statments;
            $stmt = $this->conn->prepare($query);

            // excetute
            $stmt->execute();

            return $stmt;
        }


        // get single Quote
        public function read_single() {
            // create query
            

            $query = 'SELECT 
            quotes.id, 
            quotes.quote, 
            authors.author as author_id, 
            categories.category as category_id 
            FROM ' . $this->table . ' 
            INNER JOIN authors 
            ON quotes.author_id = authors.id 
            INNER JOIN categories 
            ON quotes.category_id = categories.id 
            WHERE 
            quotes.id = ?';

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
            $this->quote = $row['quote'];
            $this->author_id = $row['author_id'];
            $this->category_id = $row['category_id'];
            }
            
        }

        //create author

        public function create() {                   
            // create query
            $query = 'INSERT INTO ' . $this->table . '(quote, author_id, category_id)  
                VALUES
                    (:quote, :author_id, :category_id)';
        

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // clean data
        
        $this->quote = htmlspecialchars(strip_tags($this->quote));
        $this->author_id = htmlspecialchars(strip_tags($this->author_id));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        
    
        // bind data
        //$stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':quote', $this->quote);
        $stmt->bindParam(':author_id', $this->author_id);
        $stmt->bindParam(':category_id', $this->category_id);

        // execute query
        if($stmt->execute()) {
            $lastId = $this->conn->lastInsertId();
            
            return $lastId;
            // return true;
        }
        // print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    // update post
    public function update() {

        // echo $this->author_id . " is the author idddd";
/* 
        $authQuery = ('SELECT id FROM authors WHERE 
         EXISTS(SELECT id FROM authors WHERE id = )' . $this->author_id);
        
        $stmt1 = $this->conn->prepare($authQuery);
        $this->author_id = htmlspecialchars(strip_tags($this->author_id));
        //$stmt1->bindParam(':id', $this->author_id);

        $thevalue = $stmt1->execute();
        echo $thevalue . " is the value"; */


        // create query
        $query = 'UPDATE ' . $this->table . ' 
            SET 
                quote = :quote, 
                author_id = :author_id, 
                category_id = :category_id
            WHERE 
                id = :id';
    

    // prepare statement
    $stmt = $this->conn->prepare($query);

    // clean data
    $this->quote = htmlspecialchars(strip_tags($this->quote));
    $this->id = htmlspecialchars(strip_tags($this->id));
    $this->author_id = htmlspecialchars(strip_tags($this->author_id));
    $this->category_id = htmlspecialchars(strip_tags($this->category_id));


    // bind data
    $stmt->bindParam(':quote', $this->quote);
    $stmt->bindParam(':id', $this->id);
    $stmt->bindParam(':author_id', $this->author_id);
    $stmt->bindParam(':category_id', $this->category_id);

    
    // execute query
    if($stmt->execute()) {
        return true;
    }
    // print error if something goes wrong
    printf("Error: %s.\n", $stmt->error);

    return false;
}

// deleete post
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