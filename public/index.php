<?php

require('../app/init.php');

//checks status of session to see if user is logged in
$session->loggedIn();


//sets the user id to the current session user id (if user is logged in)
$user_id = $session->get_user_id();
//retrieves all post under the current user id
$music = Music::get_all($user_id);



?>
<!DOCTYPE html>
<html lang="en">
    <?php
        require('partials/head.php');
    ?>
    <body class="flex flex-col min-h-screen">

        <!-- Global Menu & Logo -->
        <?php
            require('partials/header.php');
        ?>
        <!--  End: Global Menu & Logo -->

        <!-- Page Content -->
        <div class="flex-grow">
            <div class="container mx-auto py-20">

                <!-- Header -->
                <div class="grid grid-cols-12 border-b pb-6">
                    <div class="col-span-12 flex items-center">
                        <h1 class="font-bold text-4xl flex-grow">Compositions</h1>
                        <a class="bg-emerald-500 rounded-full py-2 px-4 text-white font-bold" href="<?php echo get_public_url('/notes/create.php'); ?>">Add New</a>
                    </div>
                </div>
                <!-- End: Header -->

                <!-- Index Loop -->
                <div class="grid gap-6 grid-cols-12 mt-6">
                <?php 
                        //runs as long as condition remain true 
                        // in this instance it will run and return the results from the db as a associative array
                        //returns false and ends loop when results run out
                        while($music_row = $music->fetch_assoc()):
                    
                    ?>
                
                <?php include(get_path('public/partials/card.php')); //the card that is displayed - content comes from yhe while loop and database?>
                
                <?php endwhile;  ?>
                </div>

                                <!-- End: Index Loop -->

            </div>
        </div>
        <!-- End: Page Content -->

        <!-- Global Footer -->
       <?php 
            @require('partials/footer.php');
        ?>
        <!-- End: Global Footer -->

    </body>
</html>