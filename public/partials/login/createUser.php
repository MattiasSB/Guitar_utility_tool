<?php

    require('../../../app/init.php');

    $currentPageStyles = "css/login.css";
    //if a form is submitted as a POST request execute the following
    if($_SERVER['REQUEST_METHOD'] === 'POST') 
    {
        //create a new user object out of the post
        $user = new User($_POST);

        //call the create function which enters data values into corresponding db columns
        $user->create();
        //redirect to the login page

        redirect('/partials/login/loginUser.php');

    }

    $currentPageTitle = "Sign Up Now | Guitar Utility Tool"
?><!DOCTYPE html>
<html lang="en">
    <?php
        require('../head.php')
    ?>

    <body class="fixedView">
        <?php
            require('../header.php')
        ?>
        <div class="loginForm">
            <div class="flex">
                <form class="logIn dropShadow" id="sign-up" action="<?php /*sets the action to create page*/ echo get_public_url('partials/login/createUser.php'); ?>" method="POST">
                    <div class="upperCase">
                        <h1>Sign Up</h1>
                    </div>
                    <label class="name" for="user_email">Name</label>
                    <input id="user_name" name="name" type="text" placeholder="Name" required>
                    <label class="name" for="user_email">Email</label>
                    <input id="user_email" name="email" type="text" required placeholder="Email" required>
                    <label class="name" for="user_email">Password</label>
                    <input id="user_password" name="password" type="password" placeholder="Password" required >
                    <!-- End Sample tailwind select -->
                    <p>Already have an account? <a class="" href="loginUser.php">Log In...</a></p>
    
                    <!-- Sample tailwind button -->
                    <button class="buttonWhite">Sign Up</button>
                    <!-- End Sample tailwind button -->
                </form>
            </div>
        </div>
        <div class="logInCircle">
            <img src="../../images/person_login.svg" alt="" width="736" height="480">
        </div>
        <?php 
        @require(get_path('public/partials/footer.php'));
        ?>
    </body>
</html>