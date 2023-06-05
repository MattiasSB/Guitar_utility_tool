<?php

require('../../../app/init.php');


    $currentPageStyles = "../../css/login.css";
    //if a form is submitted as a POST request execute the following
    if($_SERVER['REQUEST_METHOD'] === 'POST') 
    {
        //retrieve the row that the given email is stored
        $user = User::readUserEmail($_POST['email']);

        //if a result is retrieved and the email exists in db
        if($user->num_rows === 1){
            //return a new user object as a associative array
            $new_user = new User($user->fetch_assoc() );

            //check to see if passwords are the same
            if($new_user->validate_password($_POST['password']) ){
                //provide a new session for the user
                $session->login($new_user->id);
                //redirect to the home page
                redirect('/');
            }
        }
        else {
            //if user doesn't exist let em know
            dd('user doesnt exist');
        }

        
    }

?><!DOCTYPE html>
<html lang="en">
    <?php
        require('../head.php')
    ?>

    <body>
        <?php
            require('../header.php')
        ?>
        <div class="loginForm">
            <div class="flex">
                <form class="logIn dropShadow" id="log-in" action="<?php /*sets the action to create page*/ echo get_public_url('/partials/login/loginUser.php'); ?>" method="POST">
                    <div class="upperCase">
                        <h1>LogIn</h1>
                    </div>
                    <label class="name" for="user_email">Email</label>
                    <input id="user_email" name="email" type="email" required placeholder="Email">
                    <label class="name" for="user_email">Password</label>
                    <input id="user_password" name="password" type="password" required placeholder="Password">
                    <!-- End Sample tailwind select -->
                    <p class="">If you don't have an account <a class="" href="createUser.php">Sign Up Now</a></p>
    
                    <!-- Sample tailwind button -->
                    <button class="buttonWhite">Login</button>
                    <!-- End Sample tailwind button -->
                </form>
            </div>

        </div>
        <?php 
            @require('../footer.php');
        ?>
    </body>
</html>