<?php 
    
    //start output buffering
    ob_start();

    //defines super global variables
    define('WWW_ROOT', 'http://localhost:8888/');
    define('PROJECT_ROOT', dirname(__DIR__, 1));

    // Add Database Constants
    // ----------

    //defines the Database user, allows access into database
    define('DB_HOST',  'localhost');
    define('DB_USER',  'music_app_user');
    define('DB_PASS',  '!k+y2J');
    define('DB_NAME',  'music_app');

    // Include functions
    require('functions.php');

    // Connect to the database
    // ----------

   $db = connect_db();

   //Requires the class
   require_once(get_path("app/Classes/Note.php"));
   require_once(get_path("app/Classes/User.php"));
   require_once(get_path("app/Classes/Session.php"));

   //Starts a session
   $session = new Session();

   //sets the classs of music's database
   Music::set_db($db);
   User::set_db($db);
