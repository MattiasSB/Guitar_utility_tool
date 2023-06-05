<?php

    class User {
        //variable for db connection
        static protected $db;

        //variables for User db fields
        public $id;
        public $name;
        public $email;
        protected $password;


        //sets the db connection within class
        static public function set_db($db_conn) {
            self::$db = $db_conn;
        }

        //constructor for objects to be sent to db
        public function __construct($props = [])
        {
            $this->id = $props['id'] ?? null;
            $this->name = $props['name'] ?? null;
            $this->email = $props['email'] ?? null;
            $this->password = $props['password'] ?? null;
        }

        //create function for new users
        public function create() {

            //stores the password as a hashed password in default encryption language
            $hashed_password = password_hash($this->password, PASSWORD_DEFAULT);


            //inserts into users db columns all entered data
            $sql = "INSERT INTO Users (name, email, password)";
            $sql .= " VALUES ( ";
            $sql .= "'{$this->name}', ";
            $sql .= "'{$this->email}', ";
            $sql .= "'{$hashed_password}')";

 
            //queries db
            $result = self::$db->query($sql);

            //executes the process
            return $result;
        }

        //checls to see if an email exists in the db
        static public function readUserEmail($email) {
            //checks all rows and columns for an email value = to the user input
            $sql = "SELECT * FROM Users WHERE email=";
            $sql .= " '{$email}'";

            //makes db query
            $result = self::$db->query($sql);

            
        

            //executes commands
            return $result;
        }

        //password verification for logins with user inputted password as a parameter
        public function validate_password($provided_password){
            //checks password against hashed password value (checks for match)
            return password_verify($provided_password, $this->password);
        }
    }

    


?>