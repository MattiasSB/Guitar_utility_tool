<?php

class Music {

    //list of variables available within the class
    //static protected makes it non modifiable outside of class
    static protected $db;

    //public allows complete access
    public $id;
    public $name;
    public $chords;
    public $scale;
    public $status;
    public $timeline;
    public $bpm;
    public $user_id;
    


    //function that linked to class rather then object, takes a connection and adds it to the selected property
    static public function set_db($mysqli_con){
        //sets the object variable of db to the database connection
        self::$db = $mysqli_con;
    }

    //retrieves the single id
    static public function get($id, $user_id){
        //sql selects all values in the music table
        $sql = "SELECT * FROM music WHERE id='{$id}'";
        //checks to make sure user id is present
        $sql .= "AND user_id='{$user_id}'";
        //sets the result to the query into table
        $result = self::$db->query($sql);
        
        //returns the result id
        return $result->fetch_assoc();
    }

    //static function accessed within Music
    static public function get_all($user_id){
        //select all entries available in the music table
        $sql = "SELECT * FROM music WHERE user_id = {$user_id}";

        //sets the result to the query into table
        $result = self::$db->query($sql);

        //returns the result id
        return $result;
    }

    //update function
    public function update() {
        //sql variable updates music table
        $sql = "UPDATE music SET "; 
            //adds the name to the sql update as a column to be affected with the input as the user inputted form data
            $sql .= "name='{$this->name}', "; 
            $sql .= "chords='{$this->chords}', "; 
            $sql .= "scales='{$this->scale}', "; 
            $sql .= "timeline='{$this->timeline}', "; 
            $sql .= "status='{$this->status}', "; 
            $sql .= "bpm='{$this->bpm}' ";
            //requires the post ID to be the same as the selected post ensure the right post is affected
        $sql .= "WHERE id='{$this->id}' ";
        //checks for user id again
        $sql .= "AND user_id = '{$this->user_id}' ";
        //limits the statement to affecting 1 single post
        $sql .= "LIMIT 1";
        //variable that calls the SQL function
        $result = self::$db->query($sql);
        //Calls the function
        return $result;
    }

    //constructor class that defines how new objects are to be created
    public function __construct($prop = []) {
        //references object then variable is given property from array prop
        $this->id = $prop['id'] ?? null;
        $this->name = $prop['name'] ?? null;
        $this->chords = $prop['chords'] ?? null;
        $this->scale = $prop['scales'] ?? null;
        $this->status = $prop['status'] ?? null;
        $this->timeline = $prop['timeline'] ?? null;
        $this->bpm = $prop['bpm'] ?? null;
        $this->user_id = $prop['user_id'] ?? null;

    }

    public function create(){
        //creates new data within the columns inputted into the music table
        $sql = "INSERT INTO music (name, chords, scales, timeline, status, bpm, user_id) VALUES";
        //adds all the user inputted data as property's which will be injected into the table as values within the column
        $sql .= "('{$this->name}', '{$this->chords}', '{$this->scale}', '{$this->timeline}', '{$this->status}', {$this->bpm}, '{$this->user_id}') ";
        //stores the sql query
        $result = self::$db->query($sql);
        //calls the sql query
        return $result;
    }

    public function delete() {
        //deletes from music table with an Id that matches the selected post and limits it to deleting just the selected post
        $sql = "DELETE FROM music WHERE id='{$this->id}' ";
        //checks for user id
        $sql .= "AND user_id='{$this->user_id} '";
        //only deleyes 1
        $sql .= "LIMIT 1";
        //stores the sql query
        $result = self::$db->query($sql);
        //calls the sql query
        return $result;
        
    }

}

