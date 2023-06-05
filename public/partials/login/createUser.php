<?php

    require('../../../app/init.php');


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

?><!DOCTYPE html>
<html lang="en">
    <?php
        require('../head.php')
    ?>

    <body class="flex flex-col min-h-screen">

        <!-- Global Menu & Logo -->
        <?php
            require('../header.php')
        ?>
        <!--  End: Global Menu & Logo -->

        <!-- Page Content -->
        <div class="">
            <div class="">

                <!-- Create Header -->
                <div class="">
                    <div class="">
                        <div class="">
                            <h1 class="">Sign Up</h1>
                        </div>
                    </div>
                </div>
                <!-- End: Create Header -->

                <!-- Create Form -->
                <div class="grid grid-cols-12 mt-10">
                    <div class="col-span-12">

                        <form id="sign-up" action="<?php /*sets the action to create page*/ echo get_public_url('partials/login/createUser.php'); ?>" method="POST">
                            <div class="mb-4">
                                <label class="block text-sm font-bold mb-2" for="user_name">Name</label>
                                <input class="shadow border rounded w-full py-2 px-3 text-gray-700" id="user_name" name="name" type="text" required>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-bold mb-2" for="user_email">Email</label>
                                <input class="shadow border rounded w-full py-2 px-3 text-gray-700" id="user_email" name="email" type="text" required>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-bold mb-2" for="password">Password</label>
                                <input class="shadow border rounded w-full py-2 px-3 text-gray-700" id="password" name="password" type="password" required>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-bold mb-2" for="confirm_password">Confirm Password</label>
                                <input class="shadow border rounded w-full py-2 px-3 text-gray-700" id="confirm_password" name="confirm_password" type="password" required>
                            </div>
                            <button class="">Sign Up</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>