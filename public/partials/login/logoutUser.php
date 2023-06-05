<?php

  require('../../../app/init.php');

  //checks to see if the user is logged in and currently has a session variable
  $session->loggedIn();

  //if a post request is made execute the following
  if($_SERVER['REQUEST_METHOD'] === "POST"){
    //if the user makes request execute logout method destroying the active session
    $session->logout();
    //redirects to login page
    redirect('/partials/login/loginUser.php');
  }

?>
<!DOCTYPE html>
<html lang="en">
<?php
    require('../head.php')
?>
    <body class="flex flex-col min-h-screen">

    <!-- Global Menu & Logo -->
    <?php 
        @require('../header.php');
    ?>
    <!--  End: Global Menu & Logo -->
    
    <!-- Page Content -->
    <div class="flex-grow">

        <div class="container mx-auto py-20">

            <!-- Delete Header -->
            <div class="grid grid-cols-12 border-b pb-6">
                <div class="col-span-12 flex items-center">
                    <div class="flex-grow">
                        <p class="text-slate-400"><a class="text-purple-500" href="<?php  /*sets breadcrumb link to take back to the home page*/ echo get_public_url('/'); ?>">My Notes</a > / <span>Log Out</span></p>
                        <h1 class="font-bold text-4xl mt-2">Log Out </h1>
                    </div>
                </div>
            </div>
            <!-- End: Delete Header -->

            <!-- Delete Form -->
            <div class="grid grid-cols-12 mt-10">
                <div class="col-span-12">
                    <form action="<?php echo get_public_url('/partials/login/logoutUser.php') ?>" method="POST">
                        <p class="mb-4">Are you sure you want to <strong>Log Out?</strong></p>
                        <button class="bg-red-500 rounded-full py-2 px-4 text-white font-bold" type="submit">Yes, I'm sure</button>
                    </form>
                </div>
            </div>
            <!-- End: Delete Form -->

        </div>
    </div>
    <!-- End: Page Content -->

    <!-- Global Footer -->
    <?php 
        @require('../footer.php');
    ?>
    <!-- End: Global Footer -->

    </body>
</html>