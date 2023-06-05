<?php 

//session class defines session
    class Session {
        //user id variable
        public $user_id;

        //constructor for new session obejcts when user logs in/signs up
        public function __construct($props=[]) {
            //starts a new session
            session_start();
            //sets current session user id
            $this->user_id = $_SESSION['user_id'] ?? null;
        }

        //login method with id parameter passed  in
        public function login($id) {
            //regenerates a new id
            session_regenerate_id();
            //sets user id variable to current id 
            $this->user_id = $id;
            //sets session super gloabl value to id for validation
            $_SESSION['user_id'] = $this->user_id;

            //returns true
            return true;
        }

        public function get_user_id() {
            //returns the value of the current user id
            return $this->user_id;
        }

        public function logout() {
            //removes current session value
            session_destroy();
            //returns true
            return true;
        }

        public function loggedIn() {
            //checks for null value to determine if user is currently logged in

            if(is_null($this->get_user_id())){
                //if user is logged out send em to the login
                redirect('/partials/login/loginUser.php');
            }
            else{
                //if user is logged in return true
                return true;
            }
        }
    }

?>